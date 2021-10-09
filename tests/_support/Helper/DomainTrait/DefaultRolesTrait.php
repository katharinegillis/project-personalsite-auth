<?php declare(strict_types=1);

namespace App\Tests\_support\Helper\DomainTrait;

use App\Domain\Entity\Role\Role;
use App\Tests\_support\Helper\DependencyTrait\CreateArrayCollectionFactoryInterfaceTrait;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

trait DefaultRolesTrait
{
    use CreateArrayCollectionFactoryInterfaceTrait;
    use DefaultPermissionsTrait;

    /**
     * @return Role[]
     * @throws Exception
     */
    #[ArrayShape([
        'publicRole' => "\App\Domain\Entity\Role"
    ])] public function getDefaultRoles(): array
    {
        list(
            'tinyGraphPermission' => $tinyGraphPermission,
            'gitHubPermission' => $gitHubPermission,
            ) = $this->getDefaultPermissions();

        return [
            'publicRole' => new Role(
                $this->createArrayCollectionFactoryInterface(),
                1,
                'Public',
                'A role that defines what functionality an unauthenticated user can access.',
                [ $tinyGraphPermission, $gitHubPermission ]
            ),
        ];
    }
}