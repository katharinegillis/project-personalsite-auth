<?php declare(strict_types=1);
namespace App\Tests\integration\Persistence\Doctrine2\Service;

use App\Persistence\Doctrine2\Entity\Role;
use App\Persistence\Doctrine2\Service\RoleStorageService;
use App\Tests\_support\Helper\AssertionTrait\CheckRoleTrait;
use App\Tests\_support\Helper\Doctrine2DataTrait\CreateRoleTrait;
use App\Tests\IntegrationTester;
use Codeception\Test\Unit;

class RoleStorageServiceTest extends Unit
{
    use CreateRoleTrait;
    use CheckRoleTrait;

    /**
     * @var IntegrationTester $tester
     */
    protected IntegrationTester $tester;

    /**
     * @test
     */
    public function I_can_find_a_role_by_name()
    {
        /** @var Role $publicRole */
        list(
            'publicRole' => $publicRole
            ) = $this->createDefaultRoles($this->tester);

        $roleStorageService = $this->tester->grabService(RoleStorageService::class);

        $role = $roleStorageService->findByName($publicRole->getName());

        $this->checkRole($role, $publicRole->getId(), $publicRole->getName(), $publicRole->getDescription(), $publicRole->getPermissions()->getValues());
    }

    /**
     * @test
     */
    public function I_get_a_null_role_when_I_look_for_a_role_name_that_doesnt_exist()
    {
        $roleStorageService = $this->tester->grabService(RoleStorageService::class);

        $role = $roleStorageService->findByName('Non-existent Role Name');

        $this->checkNullRole($role);
    }
}
