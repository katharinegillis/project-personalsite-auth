<?php

namespace App\Tests\integration\Persistence\Doctrine2\Repository;

use App\Persistence\Doctrine2\Repository\PermissionRepository;
use App\Tests\_support\Helper\Doctrine2DataTrait\CreateRoleTrait;
use App\Tests\IntegrationTester;
use Codeception\Test\Unit;

class PermissionRepositoryTest extends Unit
{
    use CreateRoleTrait;

    /**
     * @var IntegrationTester $tester
     */
    protected IntegrationTester $tester;

    /**
     * @test
     */
    public function I_can_find_a_list_of_permissions_by_role_id()
    {
        list(
            'publicRole' => $publicRole,
            ) = $this->createDefaultRoles($this->tester);

        /** @var PermissionRepository $permissionRepository */
        $permissionRepository = $this->tester->grabService(PermissionRepository::class);

        $permissions = $permissionRepository->findByRoleId($publicRole->getId());

        expect($permissions)->arrayToHaveCount($publicRole->getPermissions()->count());
        foreach ($permissions as $index => $permission) {
            expect($permission)->toEqual($publicRole->getPermissions()->get($index));
        }
    }

    /**
     * @test
     */
    public function I_get_an_empty_list_when_finding_a_list_of_permissions_by_a_non_existent_role_id()
    {
        /** @var PermissionRepository $permissionRepository */
        $permissionRepository = $this->tester->grabService(PermissionRepository::class);

        $permissions = $permissionRepository->findByRoleId(1);

        expect($permissions)->arrayToHaveCount(0);
    }
}
