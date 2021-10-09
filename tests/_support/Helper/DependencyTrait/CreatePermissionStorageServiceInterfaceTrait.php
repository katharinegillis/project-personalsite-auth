<?php

namespace App\Tests\_support\Helper\DependencyTrait;

use App\Application\Service\PermissionStorageServiceInterface;
use Codeception\Stub;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

trait CreatePermissionStorageServiceInterfaceTrait
{
    /**
     * @param array|null $permissionStorageServiceInterfaceParams
     * @return PermissionStorageServiceInterface
     * @throws Exception
     */
    protected function createPermissionStorageServiceInterface(?array $permissionStorageServiceInterfaceParams = null): PermissionStorageServiceInterface
    {
        if (null === $permissionStorageServiceInterfaceParams) {
            $permissionStorageServiceInterfaceParams = $this->getDefaultPermissionStorageServiceInterfaceParams();
        }

        return Stub::makeEmpty(PermissionStorageServiceInterface::class, $permissionStorageServiceInterfaceParams);
    }

    /**
     * @return array
     */
    #[ArrayShape([
        'findByRoleId' => "\Closure"
    ])] protected function getDefaultPermissionStorageServiceInterfaceParams(): array
    {
        return [
            'findByRoleId' => function () {
                return [];
            },
        ];
    }
}