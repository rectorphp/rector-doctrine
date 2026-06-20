<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\NodeAnalyzer\DoctrineEntityDetector;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Doctrine\NodeAnalyzer\DoctrineEntityDetector;
use Rector\Testing\PHPUnit\AbstractLazyTestCase;

final class DoctrineEntityDetectorTest extends AbstractLazyTestCase
{
    private DoctrineEntityDetector $doctrineEntityDetector;

    protected function setUp(): void
    {
        parent::setUp();

        $this->doctrineEntityDetector = $this->make(DoctrineEntityDetector::class);
    }

    public function testDetectStaticFunctionMapping(): void
    {
        $class = new Class_('SomeEntity');
        $class->stmts[] = new ClassMethod('loadMetadata');

        $this->assertTrue($this->doctrineEntityDetector->detect($class));
    }
}
