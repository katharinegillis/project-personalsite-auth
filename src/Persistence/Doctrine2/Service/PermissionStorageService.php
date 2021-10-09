<?php

namespace App\Persistence\Doctrine2\Service;

use App\Application\Service\PermissionStorageServiceInterface;
use App\Domain\Entity\Permission;
use App\Domain\Factory\PermissionFactory;
use App\Persistence\Doctrine2\Entity\Permission as Doctrine2Permission;
use App\Persistence\Doctrine2\Repository\PermissionRepository;

class PermissionStorageService implements PermissionStorageServiceInterface
{
    protected PermissionRepository $permissionRepository;
    protected PermissionFactory $permissionFactory;

    /**
     * @param PermissionRepository $permissionRepository
     * @param PermissionFactory $permissionFactory
     */
    public function __construct(PermissionRepository $permissionRepository, PermissionFactory $permissionFactory)
    {
        $this->permissionRepository = $permissionRepository;
        $this->permissionFactory = $permissionFactory;
    }

    /**
     * @param int $roleId
     * @return Permission[]
     */
    public function findByRoleId(int $roleId): array
    {
        $doctrine2Permissions = $this->permissionRepository->findByRoleId($roleId);

        $permissions = [];

        foreach ($doctrine2Permissions as $doctrine2Permission) {
            $permissions[] = $this->convertToDomain($doctrine2Permission);
        }

        return $permissions;
    }

    /**
     * @param Doctrine2Permission $doctrine2Permission
     * @return Permission
     */
    public function convertToDomain(Doctrine2Permission $doctrine2Permission): Permission
    {
        return $this->permissionFactory->create(
            $doctrine2Permission->getId(),
            $doctrine2Permission->getPermissionKey(),
            $doctrine2Permission->getName(),
            $doctrine2Permission->getDescription(),
        );
    }
}