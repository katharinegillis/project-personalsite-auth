<?php
namespace App\Tests\unit\Domain;

use App\Domain\Permission;
use App\Domain\Role;
use App\Tests\_support\UnitTester;
use Codeception\Test\Unit;

class RoleTest extends Unit
{
    /**
     * @test
     */
    public function I_can_create_a_role_with_given_data()
    {
        $id = 1;
        $name = 'Public';
        $description = 'A role that defines what functionality an unauthenticated user can access.';
        $permissions = [
            new Permission(
                1,
                'can_generate_tinygraph_image',
                'Can Generate TinyGraph Image',
                'Allows the user to generate and retrieve a TinyGraph image.'
            ),
            new Permission(
                2,
                'can_view_github_repositories',
                'Can View GitHub Repositories',
                'Allows the user to view the GitHub repositories.'
            ),
        ];

        $role = new Role($id, $name, $description, $permissions);

        expect($role->getId())->toBe($id);
        expect($role->getName())->toBe($name);
        expect($role->getDescription())->toBe($description);
        expect($role->getPermissions())->toBeArray();
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toBe($permissions[$index]);
        }
    }

    /**
     * @test
     */
    public function I_can_create_a_role_with_no_data()
    {
        $role = new Role();

        expect($role->getId())->toBeNull();
        expect($role->getName())->toBeNull();
        expect($role->getDescription())->toBeNull();
        expect($role->getPermissions())->toBeNull();
    }

    /**
     * @test
     */
    public function I_can_set_the_name_for_a_role()
    {
        $name = 'Public';

        $role = new Role();

        expect($role->getName())->toBeNull();

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

        expect($role->getName())->toBeNull();

        $role->setDescription($description);

        expect($role->getDescription())->toBe($description);
    }

    /**
     * @test
     */
    public function I_can_set_the_permissions_for_a_role()
    {
        $permissions = [
            new Permission(
                1,
                'can_generate_tinygraph_image',
                'Can Generate TinyGraph Image',
                'Allows the user to generate and retrieve a TinyGraph image.'
            ),
            new Permission(
                2,
                'can_view_github_repositories',
                'Can View GitHub Repositories',
                'Allows the user to view the GitHub repositories.'
            ),
        ];

        $role = new Role();

        expect($role->getPermissions())->toBeNull();

        $role->setPermissions($permissions);

        expect($role->getPermissions())->toBeArray();
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toBe($permissions[$index]);
        }
    }
}