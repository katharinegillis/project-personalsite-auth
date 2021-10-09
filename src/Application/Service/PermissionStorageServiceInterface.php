<?php

namespace App\Application\Service;

use App\Domain\Entity\Permission;

interface PermissionStorageServiceInterface
{
    /**
     * @param int $roleId
     * @return Permission[]
     */
    public function findByRoleId(int $roleId): array;
}