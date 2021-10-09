<?php
namespace App\Tests\integration\Persistence\Doctrine2\Service;

use App\Domain\Entity\Permission;
use App\Persistence\Doctrine2\Entity\Permission as Doctrine2Permission;
use App\Persistence\Doctrine2\Entity\Role;
use App\Persistence\Doctrine2\Service\RoleStorageService;
use App\Tests\_support\Helper\Doctrine2DataTrait\CreateRoleTrait;
use App\Tests\IntegrationTester;
use Codeception\Test\Unit;

class RoleStorageServiceTest extends Unit
{
    use CreateRoleTrait;

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

        expect($role->getId())->toBe($publicRole->getId());
        expect($role->getDescription())->toBe($publicRole->getDescription());
        expect($role->getPermissions()->count())->toBe($publicRole->getPermissions()->count());

        /**
         * @var int $index
         * @var Permission $permission
         */
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toBeInstanceOf(Permission::class);

            /** @var Doctrine2Permission $doctrine2Permission */
            $doctrine2Permission = $publicRole->getPermissions()->get($index);

            expect($permission->getId())->toBe($doctrine2Permission->getId());
            expect($permission->getPermissionKey())->toBe($doctrine2Permission->getPermissionKey());
            expect($permission->getName())->toBe($doctrine2Permission->getName());
            expect($permission->getDescription())->toBe($doctrine2Permission->getDescription());
        }
    }

    public function I_get_a_null_role_when_I_look_for_a_role_name_that_doesnt_exist(IntegrationTester $I)
    {

    }
}
