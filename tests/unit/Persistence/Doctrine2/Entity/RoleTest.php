<?php
namespace App\Tests\unit\Persistence\Doctrine2\Entity;

use App\Persistence\Doctrine2\Entity\Permission;
use App\Persistence\Doctrine2\Entity\Role;
use Codeception\Test\Unit;
use Doctrine\Common\Collections\ArrayCollection;

class RoleTest extends Unit
{
    /**
     * @return Permission[]
     */
    protected function createPermissions(): array
    {
        $permission1 = new Permission();
        $permission1->setKey('can_generate_tinygraph_image');
        $permission1->setName('Can Generate TinyGraph Image');
        $permission1->setDescription('Allows the user to generate and retrieve a TinyGraph image.');

        $permission2 = new Permission();
        $permission2->setKey('can_view_github_repositories');
        $permission2->setName('Can View GitHub Repositories');
        $permission2->setDescription('Allows the user to view the GitHub repositories.');

        return [
            $permission1,
            $permission2,
        ];
    }

    /**
     * @test
     */
    public function I_can_set_the_name_for_a_role()
    {
        $name = 'Public';

        $role = new Role();

        $role->setName($name);

        expect($role->getName())->toBe($name);
    }

    /**
     * @test
     */
    public function I_can_set_the_description_for_a_role()
    {
        $description = 'A role that defines what functionality an unauthenticated user can access.';

        $role = new Role();

        $role->setDescription($description);

        expect($role->getDescription())->toBe($description);
    }

    /**
     * @test
     */
    public function I_can_set_the_permissions_for_a_role()
    {
        $permissions = $this->createPermissions();

        $role = new Role();

        $role->setPermissions($permissions);

        expect($role->getPermissions())->toBeInstanceOf(ArrayCollection::class);
        expect($role->getPermissions()->count())->toBe(count($permissions));
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toEqual($permissions[$index]);
        }
    }

    /**
     * @test
     */
    public function I_can_add_a_permission_to_a_role()
    {
        $permissions = $this->createPermissions();

        $role = new Role();

        $role->setPermissions([$permissions[0]]);

        expect($role->getPermissions())->toBeInstanceOf(ArrayCollection::class);
        expect($role->getPermissions()->count())->toBe(1);
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toEqual($permissions[$index]);
        }

        $role->addPermission($permissions[1]);

        expect($role->getPermissions()->count())->toBe(2);
        expect($role->getPermissions()->get(1))->toEqual($permissions[1]);
    }

    /**
     * @test
     */
    public function I_cannot_add_a_permission_to_a_role_that_is_already_associated_with_that_permission()
    {
        $permissions = $this->createPermissions();

        $role = new Role();

        $role->setPermissions($permissions);
        $role->addPermission($permissions[1]);

        expect($role->getPermissions()->count())->toBe(2);
        expect($role->getPermissions()->get(1))->toEqual($permissions[1]);
    }

    /**
     * @test
     */
    public function I_can_remove_a_permission_from_a_role()
    {
        $permissions = $this->createPermissions();

        $role = new Role();

        $role->setPermissions($permissions);

        $role->removePermission($permissions[0]);
        expect($role->getPermissions()->count())->toBe(count($permissions) - 1);
        expect($role->getPermissions()->get(0))->toEqual($permissions[1]);
    }
}