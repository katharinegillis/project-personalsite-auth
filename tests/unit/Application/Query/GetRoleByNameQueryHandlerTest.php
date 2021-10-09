<?php declare(strict_types=1);

namespace App\Tests\unit\Application\Query;

use App\Application\Query\GetRoleByNameQuery;
use App\Application\Query\GetRoleByNameQueryHandler;
use App\Domain\Entity\Permission\Permission;
use App\Domain\Entity\Role\NullRole;
use App\Domain\Entity\Role\Role;
use App\Domain\Entity\Role\RoleInterface;
use App\Tests\_support\Helper\AssertionTrait\CheckRoleTrait;
use App\Tests\_support\Helper\DependencyTrait\CreateArrayCollectionFactoryInterfaceTrait;
use App\Tests\_support\Helper\DependencyTrait\CreateRoleStorageServiceInterfaceTrait;
use Codeception\Test\Unit;
use Exception;

class GetRoleByNameQueryHandlerTest extends Unit
{
    use CreateArrayCollectionFactoryInterfaceTrait;
    use CreateRoleStorageServiceInterfaceTrait;
    use CheckRoleTrait;

    /**
     * @test
     * @throws Exception
     */
    public function I_can_get_a_role_by_name_from_a_GetRoleByNameQueryHandler()
    {
        /** @var RoleInterface $publicRole */
        list(
            'publicRole' => $publicRole
            ) = $this->getDefaultRoles();
        $getRoleByNameQuery = new GetRoleByNameQuery($publicRole->getName());

        $getRoleByNameQueryHandler = new GetRoleByNameQueryHandler($this->createRoleStorageServiceInterface());

        $role = $getRoleByNameQueryHandler->__invoke($getRoleByNameQuery);

        $this->checkRole($role, $publicRole->getId(), $publicRole->getName(), $publicRole->getDescription(), $publicRole->getPermissions()->getValues());
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_get_a_null_role_from_a_GetRoleByNameQueryHandler_if_I_give_a_non_existent_role_name()
    {
        $getRoleByNameQuery = new GetRoleByNameQuery('Non-existent Role Name');

        $getRoleByNameQueryHandler = new GetRoleByNameQueryHandler($this->createRoleStorageServiceInterface());

        $role = $getRoleByNameQueryHandler->__invoke($getRoleByNameQuery);

        $this->checkNullRole($role);
    }
}
