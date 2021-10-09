<?php declare(strict_types=1);

namespace App\Tests\_support\Helper\DomainTrait;

use App\Domain\Entity\Permission\Permission;
use JetBrains\PhpStorm\ArrayShape;

trait DefaultPermissionsTrait
{
    /**
     * @return Permission[]
     */
    #[ArrayShape([
        'tinyGraphPermission' => "\App\Domain\Entity\Permission",
        'gitHubPermission' => "\App\Domain\Entity\Permission"
    ])] public function getDefaultPermissions(): array
    {
        return [
            'tinyGraphPermission' => new Permission(
                1,
                'can_generate_tinygraph_image',
                'Can Generate TinyGraph Image',
                'Allows the user to generate and retrieve a TinyGraph image.'
            ),
            'gitHubPermission' => new Permission(
                2,
                'can_view_github_repositories',
                'Can View GitHub Repositories',
                'Allows the user to view the GitHub repositories.'
            ),
        ];
    }
}