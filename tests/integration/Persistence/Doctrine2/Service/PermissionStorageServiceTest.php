<?php declare(strict_types=1);

namespace App\Tests\integration\Persistence\Doctrine2\Service;

use App\Domain\Entity\Permission\PermissionInterface;
use App\Persistence\Doctrine2\Entity\Permission as Doctrine2Permission;
use App\Persistence\Doctrine2\Entity\Role;
use App\Persistence\Doctrine2\Service\PermissionStorageService;
use App\Tests\_support\Helper\Doctrine2DataTrait\CreateRoleTrait;
use App\Tests\IntegrationTester;
use Codeception\Test\Unit;

class PermissionStorageServiceTest extends Unit
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
        /** @var Role $publicRole */
        list(
            'publicRole' => $publicRole,
            ) = $this->createDefaultRoles($this->tester);

        /** @var PermissionStorageService $permissionStorageService */
        $permissionStorageService = $this->tester->grabService(PermissionStorageService::class);

        $permissions = $permissionStorageService->findByRoleId($publicRole->getId());

        expect($permissions)->arrayToHaveCount($publicRole->getPermissions()->count());
        foreach ($permissions as $index => $permission) {
            expect($permission)->toBeInstanceOf(PermissionInterface::class);

            /** @var Doctrine2Permission $doctrine2Permission */
            $doctrine2Permission = $publicRole->getPermissions()->get($index);

            expect($permission->getId())->toEqual($doctrine2Permission->getId());
            expect($permission->getPermissionKey())->toEqual($doctrine2Permission->getPermissionKey());
            expect($permission->getName())->toEqual($doctrine2Permission->getName());
            expect($permission->getDescription())->toEqual($doctrine2Permission->getDescription());
        }
    }

    /**
     * @test
     */
    public function I_get_an_empty_list_when_finding_a_list_of_permissions_by_a_non_existent_role_id()
    {
        /** @var PermissionStorageService $permissionStorageService */
        $permissionStorageService = $this->tester->grabService(PermissionStorageService::class);

        $permissions = $permissionStorageService->findByRoleId(1);

        expect($permissions)->arrayToHaveCount(0);
    }
}
