<?php

namespace App\Tests\_support\Helper;

use App\Common\ArrayCollectionFactoryInterface;
use App\Common\ArrayCollectionInterface;
use App\Domain\Entity\Role;
use App\Domain\Factory\RoleFactory;
use Codeception\Stub;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

trait CreateRoleFactory
{
    use CreateArrayCollectionFactoryInterface;

    /**
     * @param array|null $roleFactoryParams
     * @param array|null $arrayCollectionFactoryInterfaceParams
     * @return RoleFactory
     * @throws Exception
     */
    protected function createRoleFactory(?array $roleFactoryParams = null, ?array $arrayCollectionFactoryInterfaceParams = null): RoleFactory
    {
        if (null === $arrayCollectionFactoryInterfaceParams) {
            $arrayCollectionFactoryInterfaceParams = $this->getDefaultArrayCollectionFactoryInterfaceParams();
        }

        if (null === $roleFactoryParams) {
            $roleFactoryParams = $this->getDefaultRoleFactoryParams($arrayCollectionFactoryInterfaceParams);
        }

        return Stub::makeEmpty(RoleFactory::class, $roleFactoryParams);
    }

    /**
     * @param array $arrayCollectionFactoryInterfaceParams
     * @return array
     */
    #[ArrayShape(['create' => "\Closure"])] protected function getDefaultRoleFactoryParams(array $arrayCollectionFactoryInterfaceParams): array
    {
        return [
            'create' => function (
                ?int $id = null,
                ?string $name = null,
                ?string $description = null,
                array|ArrayCollectionInterface|null $permissions = null
            ) use ($arrayCollectionFactoryInterfaceParams) {
                return new Role(
                    $this->createArrayCollectionFactoryInterface($arrayCollectionFactoryInterfaceParams),
                    $id,
                    $name,
                    $description,
                    $permissions
                );
            }
        ];
    }
}