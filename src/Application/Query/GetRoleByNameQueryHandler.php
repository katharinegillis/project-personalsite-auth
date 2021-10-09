<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Service\RoleStorageServiceInterface;
use App\Common\CQRS\Query\QueryHandlerInterface;
use App\Domain\Entity\Role\RoleInterface;

class GetRoleByNameQueryHandler implements QueryHandlerInterface
{
    /**
     * @var RoleStorageServiceInterface
     */
    protected RoleStorageServiceInterface $roleStorageService;

    /**
     * @param RoleStorageServiceInterface $roleStorageService
     */
    public function __construct(RoleStorageServiceInterface $roleStorageService)
    {
        $this->roleStorageService = $roleStorageService;
    }

    /**
     * @param GetRoleByNameQuery $query
     * @return RoleInterface
     */
    public function __invoke(GetRoleByNameQuery $query): RoleInterface
    {
        return $this->roleStorageService->findByName($query->getName());
    }
}