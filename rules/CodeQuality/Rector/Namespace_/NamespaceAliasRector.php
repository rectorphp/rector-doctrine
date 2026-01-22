<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Namespace_;

use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\GroupUse;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\Node\UseItem;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Doctrine\CodeQuality\ValueObject\NamespaceAlias;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see \Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\NamespaceAliasRectorTest
 */
final class NamespaceAliasRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var NamespaceAlias[]
     */
    private array $namespaceAliases = [];

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Alias namespaces (e.g. ORM\ODM) and prefix usages accordingly.',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ODM\MongoDB\Mapping\Attribute\Document;

#[Entity]
final class PostEntity
{
}

#[Document]
final class PostDocument
{
}
CODE_SAMPLE,
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ODM\MongoDB\Mapping\Attribute as ODM;

#[ORM\Entity]
final class PostEntity
{
}

#[ODM\Document]
final class PostDocument
{
}
CODE_SAMPLE
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [Namespace_::class];
    }

    public function refactor(Node $node): ?Node
    {
        if (! $node instanceof Namespace_) {
            return null;
        }

        $aliasMaps = [];

        foreach ($this->namespaceAliases as $namespaceAlias) {
            $aliasAlreadyPresent = $this->hasAliasImport($node, $namespaceAlias);

            $aliasToShort = $this->collectAndRemoveUses($node, $namespaceAlias);

            if ($aliasToShort === []) {
                continue;
            }

            if (! $aliasAlreadyPresent) {
                $this->addAliasImport($node, $namespaceAlias);
            }

            $aliasMaps[] = [$namespaceAlias, $aliasToShort];
        }

        if ($aliasMaps === []) {
            return null;
        }

        $this->replaceNamesWithAlias($node, $aliasMaps);

        return $node;
    }

    public function configure(array $configuration): void
    {
        Assert::allIsInstanceOf($configuration, NamespaceAlias::class);

        $this->namespaceAliases = $configuration;
    }

    private function hasAliasImport(Namespace_ $namespace, NamespaceAlias $namespaceAlias): bool
    {
        foreach ($namespace->stmts as $stmt) {
            if (! $stmt instanceof Use_) {
                continue;
            }

            foreach ($stmt->uses as $useItem) {
                if (! $this->isName($useItem->name, $namespaceAlias->getNamespace())) {
                    continue;
                }

                if ($useItem->alias?->toString() === $namespaceAlias->getAlias()) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @return array<string, string> Alias/imported-name to short class name map
     */
    private function collectAndRemoveUses(
        Namespace_ $namespace,
        NamespaceAlias $namespaceAlias
    ): array {
        $aliasToShort = [];
        $newStmts = [];

        foreach ($namespace->stmts as $stmt) {
            if ($stmt instanceof Use_) {
                $result = $this->filterUse($stmt, $namespaceAlias);
                if ($result['use'] !== null) {
                    $newStmts[] = $result['use'];
                }

                $aliasToShort = array_merge($aliasToShort, $result['aliases']);

                continue;
            }

            if ($stmt instanceof GroupUse && $this->isName($stmt->prefix, $namespaceAlias->getNamespace())) {
                foreach ($stmt->uses as $useUse) {
                    $shortName = $useUse->name->getLast();
                    $alias = $useUse->alias?->toString() ?? $shortName;

                    $aliasToShort[$alias] = $shortName;
                }

                continue;
            }

            $newStmts[] = $stmt;
        }

        $namespace->stmts = $newStmts;

        return $aliasToShort;
    }

    /**
     * @param array{NamespaceAlias,array<string,string>}[] $aliasMaps
     */
    private function replaceNamesWithAlias(Namespace_ $namespace, array $aliasMaps): void
    {
        $this->traverseNodesWithCallable($namespace, function (Node $node) use ($aliasMaps): ?Name {
            if (! $node instanceof Name) {
                return null;
            }

            foreach ($aliasMaps as [$namespaceAlias, $aliasToShort]) {
                foreach ($aliasToShort as $alias => $shortName) {
                    $targetFqn = $namespaceAlias->getNamespace() . '\\' . $shortName;

                    if ($this->isName($node, $targetFqn) || $this->isName($node, $alias)) {
                        return new Name($namespaceAlias->getAlias() . '\\' . $shortName);
                    }
                }
            }

            return null;
        });
    }

    /**
     * @return array{use: ?Use_, aliases: array<string, string>}
     */
    private function filterUse(Use_ $use, NamespaceAlias $namespaceAlias): array
    {
        $newUses = [];
        $aliases = [];

        foreach ($use->uses as $useUse) {
            $useName = $useUse->name->toString();

            if (! str_starts_with($useName, $namespaceAlias->getNamespace() . '\\')) {
                $newUses[] = $useUse;
                continue;
            }

            $shortName = $useUse->name->getLast();
            $alias = $useUse->alias?->toString() ?? $shortName;

            $aliases[$alias] = $shortName;
        }

        if ($newUses === []) {
            return [
                'use' => null,
                'aliases' => $aliases,
            ];
        }

        $use->uses = $newUses;

        return [
            'use' => $use,
            'aliases' => $aliases,
        ];
    }

    private function addAliasImport(Namespace_ $namespace, NamespaceAlias $namespaceAlias): void
    {
        $aliasUse = new Use_([
            new UseItem(new Name($namespaceAlias->getNamespace()), new Identifier(
                $namespaceAlias->getAlias()
            )),
        ]);

        $useInserted = false;
        $newStmts = [];

        foreach ($namespace->stmts as $stmt) {
            if (! $useInserted && ($stmt instanceof Use_ || $stmt instanceof GroupUse)) {
                $newStmts[] = $aliasUse;
                $useInserted = true;
            }

            if (! $useInserted && ! $stmt instanceof Use_ && ! $stmt instanceof GroupUse) {
                $newStmts[] = $aliasUse;
                $useInserted = true;
            }

            $newStmts[] = $stmt;
        }

        if (! $useInserted) {
            $newStmts[] = $aliasUse;
        }

        $namespace->stmts = $newStmts;
    }
}
