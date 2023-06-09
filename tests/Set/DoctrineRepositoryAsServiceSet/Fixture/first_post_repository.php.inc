<?php

namespace Rector\Doctrine\Tests\Set\DoctrineRepositoryAsServiceSet\Fixture;

use Rector\Doctrine\Tests\Set\DoctrineRepositoryAsServiceSet\Source\Entity\Post;
use Doctrine\ORM\EntityRepository;

final class FirstPostRepository extends EntityRepository
{
    /**
     * @return Post[]
     */
    public function findPostsByAuthor(int $authorId): array
    {
        return $this->findBy([
            'author' => $authorId
        ]);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineRepositoryAsServiceSet\Fixture;

use Rector\Doctrine\Tests\Set\DoctrineRepositoryAsServiceSet\Source\Entity\Post;
use Doctrine\ORM\EntityRepository;

final class FirstPostRepository
{
    /**
     * @var \Doctrine\ORM\EntityRepository<\Rector\Doctrine\Tests\Set\DoctrineRepositoryAsServiceSet\Source\Entity\Post>
     */
    private \Doctrine\ORM\EntityRepository $repository;
    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(\Rector\Doctrine\Tests\Set\DoctrineRepositoryAsServiceSet\Source\Entity\Post::class);
    }
    /**
     * @return Post[]
     */
    public function findPostsByAuthor(int $authorId): array
    {
        return $this->repository->findBy([
            'author' => $authorId
        ]);
    }
}

?>
