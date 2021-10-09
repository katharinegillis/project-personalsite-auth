<?php declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Permission\Permission;

interface PermissionStorageServiceInterface
{
    /**
     * @param int $roleId
     * @return Permission[]
     */
    public function findByRoleId(int $roleId): array;
}