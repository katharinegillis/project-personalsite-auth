<?php

namespace App\Domain\Factory;

use App\Domain\Entity\Permission;

class PermissionFactory
{
    /**
     * @param int|null $id
     * @param string|null $key
     * @param string|null $name
     * @param string|null $description
     * @return Permission
     */
    public function create(?int $id = null, ?string $key = null, ?string $name = null, ?string $description = null): Permission
    {
        return new Permission($id, $key, $name, $description);
    }
}