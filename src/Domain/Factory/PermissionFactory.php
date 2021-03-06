<?php declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Permission\NullPermission;
use App\Domain\Entity\Permission\Permission;

class PermissionFactory
{
    /**
     * @param int|null $id
     * @param string|null $permissionKey
     * @param string|null $name
     * @param string|null $description
     * @return Permission
     */
    public function create(?int $id = null, ?string $permissionKey = null, ?string $name = null, ?string $description = null): Permission
    {
        return new Permission($id, $permissionKey, $name, $description);
    }

    /**
     * @return NullPermission
     */
    public function createNull(): NullPermission
    {
        return new NullPermission();
    }
}