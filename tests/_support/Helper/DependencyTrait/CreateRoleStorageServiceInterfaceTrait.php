<?php declare(strict_types=1);

namespace App\Tests\_support\Helper\DependencyTrait;

use App\Application\Service\RoleStorageServiceInterface;
use App\Domain\Entity\Role\NullRole;
use App\Tests\_support\Helper\DomainTrait\DefaultRolesTrait;
use Codeception\Stub;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

trait CreateRoleStorageServiceInterfaceTrait
{
    use DefaultRolesTrait;

    /**
     * @param array|null $roleStorageServiceInterfaceParams
     * @return RoleStorageServiceInterface
     * @throws Exception
     */
    public function createRoleStorageServiceInterface(?array $roleStorageServiceInterfaceParams = null): RoleStorageServiceInterface
    {
        if (null == $roleStorageServiceInterfaceParams) {
            $roleStorageServiceInterfaceParams = $this->getDefaultRoleStorageServiceInterfaceParams();
        }

        return Stub::makeEmpty(RoleStorageServiceInterface::class, $roleStorageServiceInterfaceParams);
    }

    /**
     * @param array|null $rolesByName
     * @return array
     * @throws Exception
     */
    #[ArrayShape([
        'findByName' => "\Closure"
    ])] public function getDefaultRoleStorageServiceInterfaceParams(?array $rolesByName = null): array
    {
        if (null === $rolesByName) {
            $roles = $this->getDefaultRoles();
            $rolesByName = [];
            foreach ($roles as $role) {
                $rolesByName[$role->getName()] = $role;
            }
        }

        return [
            'findByName' => function (string $name) use ($rolesByName) {
                if (isset($rolesByName[$name])) {
                    return $rolesByName[$name];
                }

                return new NullRole($this->createArrayCollectionFactoryInterface());
            },
        ];
    }
}