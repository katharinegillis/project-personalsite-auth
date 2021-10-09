<?php declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Role\RoleInterface;

interface RoleStorageServiceInterface
{
    /**
     * @param string $name
     * @return RoleInterface
     */
    public function findByName(string $name): RoleInterface;
}