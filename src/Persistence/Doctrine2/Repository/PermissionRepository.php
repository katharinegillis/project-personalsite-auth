<?php declare(strict_types=1);

namespace App\Persistence\Doctrine2\Repository;

use App\Persistence\Doctrine2\Entity\Permission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Permission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Permission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Permission[]    findAll()
 * @method Permission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }

    /**
     * @param int $roleId
     * @return Permission[]
     */
    public function findByRoleId(int $roleId): array
    {
        $entityManager = $this->getEntityManager();

        $dql = <<<DQL
SELECT
    p
FROM
    App\Persistence\Doctrine2\Entity\Permission p
WHERE
    p.id IN (
        SELECT
            p2.id
        FROM
            App\Persistence\Doctrine2\Entity\Role r
        JOIN
            r.permissions p2
        WHERE
            r.id = :roleId
    )
DQL;


        $query = $entityManager->createQuery($dql)
            ->setParameter('roleId', $roleId);

        return $query->getResult();
    }
}
