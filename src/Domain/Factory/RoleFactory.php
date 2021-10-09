<?php

namespace App\Domain\Factory;

use App\Application\Service\PermissionStorageServiceInterface;
use App\Common\ArrayCollectionFactoryInterface;
use App\Common\ArrayCollectionInterface;
use App\Domain\Entity\Role;

class RoleFactory
{
    protected ArrayCollectionFactoryInterface $arrayCollectionFactory;
    protected PermissionStorageServiceInterface $permissionStorageService;

    /**
     * @param ArrayCollectionFactoryInterface $arrayCollectionFactory
     * @param PermissionStorageServiceInterface $permissionStorageService
     */
    public function __construct(ArrayCollectionFactoryInterface $arrayCollectionFactory, PermissionStorageServiceInterface $permissionStorageService)
    {
        $this->arrayCollectionFactory = $arrayCollectionFactory;
        $this->permissionStorageService = $permissionStorageService;
    }

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $description
     * @param array|ArrayCollectionInterface|null $permissions
     * @return Role
     */
    public function create(?int $id = null, ?string $name = null, ?string $description = null, array|ArrayCollectionInterface|null $permissions = null): Role
    {
        $role = new Role($this->arrayCollectionFactory, $id, $name, $description);

        if (null !== $permissions) {
            $role->setPermissions($permissions);

            return $role;
        }

        if (null === $id) {
            $role->setPermissionLoader(function () {
                return [];
            });
        } else {
            $permissionStorageService = $this->permissionStorageService;
            $role->setPermissionLoader(function () use ($id, $permissionStorageService) {
                return $permissionStorageService->findByRoleId($id);
            });
        }

        return $role;
    }
}