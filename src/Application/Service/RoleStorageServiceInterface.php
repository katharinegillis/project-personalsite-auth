<?php declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Role;

interface RoleStorageServiceInterface
{
    /**
     * @param string $name
     * @return Role
     */
    public function findByName(string $name): Role;
}