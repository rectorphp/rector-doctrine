<?php

declare(strict_types=1);

namespace Rector\Doctrine\RepositoryService\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\ObjectType;
use Rector\Doctrine\RepositoryService\NodeAnalyzer\EntityObjectTypeResolver;
use Rector\Doctrine\RepositoryService\NodeFactory\RepositoryAssignFactory;
use Rector\NodeManipulator\ClassDependencyManipulator;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\Set\RepositoryService\RepositoryServiceTest
 */
final class MoveRepositoryFromParentToConstructorRector extends AbstractRector
{
    /**
     * @var string
     */
    private const ENTITY_REPOSITORY_CLASS = 'Doctrine\ORM\EntityRepository';

    /**
     * @var string
     */
    private const ENTITY_MANAGER_INTERFACE = 'Doctrine\ORM\EntityManagerInterface';

    public function __construct(
        private readonly ClassDependencyManipulator $classDependencyManipulator,
        private readonly RepositoryAssignFactory $repositoryAssignFactory,
        private readonly EntityObjectTypeResolver $entityObjectTypeResolver
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns parent EntityRepository class to constructor dependency',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
namespace App\Repository;

use Doctrine\ORM\EntityRepository;

final class PostRepository extends EntityRepository
{
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
namespace App\Repository;

use App\Entity\Post;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

final class PostRepository
{
    /**
     * @var \Doctrine\ORM\EntityRepository<Post>
     */
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Post::class);
    }
}
CODE_SAMPLE
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isObjectType($node, new ObjectType(self::ENTITY_REPOSITORY_CLASS))) {
            return null;
        }

        if (! $node->extends instanceof Name) {
            return null;
        }

        // remove parent class
        $node->extends = null;

        $subtractableType = $this->entityObjectTypeResolver->resolveFromRepositoryClass($node);
        $genericObjectType = new GenericObjectType(self::ENTITY_REPOSITORY_CLASS, [$subtractableType]);

        // add $repository property
        $repositoryProperty = $node->getProperty('repository');
        if (! $repositoryProperty instanceof Property) {
            $repositoryProperty = $this->nodeFactory->createPrivatePropertyFromNameAndType(
                'repository',
                $genericObjectType
            );
            $node->stmts = array_merge([$repositoryProperty], $node->stmts);
        }

        // add $entityManager and assign to constuctor
        $repositoryAssign = $this->repositoryAssignFactory->create($node);

        $this->classDependencyManipulator->addConstructorDependencyWithCustomAssign(
            $node,
            'entityManager',
            new ObjectType(self::ENTITY_MANAGER_INTERFACE),
            $repositoryAssign
        );

        return $node;
    }
}
