<?php

namespace App\Tests\_support\Helper\Doctrine2DataTrait;

use App\Persistence\Doctrine2\Entity\Role;
use App\Tests\_support\Doctrine2TesterInterface;
use JetBrains\PhpStorm\ArrayShape;

trait CreateRoleTrait
{
    use CreatePermissionTrait;

    /**
     * @param Doctrine2TesterInterface $I
     * @param string|null $name
     * @param string|null $description
     * @param array|null $permissions
     * @return Role
     */
    protected function createRole(Doctrine2TesterInterface $I, ?string $name, ?string $description, ?array $permissions): Role
    {
        $role = new Role($name, $description, $permissions);

        $I->persistEntity($role);

        return $role;
    }

    /**
     * @param Doctrine2TesterInterface $I
     * @return array
     */
    #[ArrayShape([
        'publicRole' => "\App\Persistence\Doctrine2\Entity\Role"
    ])] protected function createDefaultRoles(Doctrine2TesterInterface $I): array
    {
        list(
            'tinyGraphPermission' => $tinyGraphPermission,
            'gitHubPermission' => $gitHubPermission
            ) = $this->createDefaultPermissions($I);

        $publicRole = $this->createRole(
            $I,
            'Public',
            'A role that defines what functionality an unauthenticated user can access.',
            [ $tinyGraphPermission, $gitHubPermission ]
        );

        return [
            'publicRole' => $publicRole,
        ];
    }
}