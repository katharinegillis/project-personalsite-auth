<?php

namespace App\Tests\_support\Helper\Doctrine2DataTrait;

use App\Persistence\Doctrine2\Entity\Permission;
use App\Tests\_support\Doctrine2TesterInterface;
use JetBrains\PhpStorm\ArrayShape;

trait CreatePermissionTrait
{
    /**
     * @param Doctrine2TesterInterface $I
     * @param string|null $permissionKey
     * @param string|null $name
     * @param string|null $description
     * @return Permission
     */
    protected function createPermission(Doctrine2TesterInterface $I, ?string $permissionKey = null, ?string $name = null, ?string $description = null): Permission
    {
        $permission = new Permission($permissionKey, $name, $description);

        $I->haveInRepository($permission);

        return $permission;
    }

    /**
     * @param Doctrine2TesterInterface $I
     * @return array
     */
    #[ArrayShape([
        'tinyGraphPermission' => "\App\Persistence\Doctrine2\Entity\Permission",
        'gitHubPermission' => "\App\Persistence\Doctrine2\Entity\Permission"
    ])] protected function createDefaultPermissions(Doctrine2TesterInterface $I): array
    {
        $tinyGraphPermission = $this->createPermission(
            $I,
            'can_generate_tinygraph_image',
            'Can Generate TinyGraph Image',
            'Allows the user to generate and retrieve a TinyGraph image.'
        );

        $gitHubPermission = $this->createPermission(
            $I,
            'can_view_github_repositories',
            'Can View GitHub Repositories',
            'Allows the user to view the GitHub repositories.'
        );

        return [
            'tinyGraphPermission' => $tinyGraphPermission,
            'gitHubPermission' => $gitHubPermission,
        ];
    }
}