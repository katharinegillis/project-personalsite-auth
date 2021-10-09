<?php declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\Role;

use App\Common\ArrayCollection\ArrayCollectionInterface;
use App\Domain\Entity\Permission\Permission;
use App\Domain\Entity\Role\Role;
use App\Tests\_support\Helper\AssertionTrait\CheckRoleTrait;
use App\Tests\_support\Helper\DependencyTrait\CreateArrayCollectionFactoryInterfaceTrait;
use Codeception\Test\Unit;
use Exception;

class RoleTest extends Unit
{
    use CreateArrayCollectionFactoryInterfaceTrait;
    use CheckRoleTrait;

    /**
     * @test
     * @throws Exception
     */
    public function I_can_create_a_role_with_given_data()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
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

        $role = new Role($arrayCollectionFactory, $id, $name, $description, $permissions);

        $this->checkRole($role, $id, $name, $description, $permissions);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_create_a_role_with_no_data()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();

        $role = new Role($arrayCollectionFactory);

        $this->checkRole($role, null, null, null, []);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_set_the_name_for_a_role()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
        $name = 'Public';

        $role = new Role($arrayCollectionFactory);

        expect($role->getName())->toBeNull();

        $role->setName($name);

        expect($role->getName())->toBe($name);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_set_the_description_for_a_role()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
        $description = 'A role that defines what functionality an unauthenticated user can access.';

        $role = new Role($arrayCollectionFactory);

        expect($role->getName())->toBeNull();

        $role->setDescription($description);

        expect($role->getDescription())->toBe($description);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_set_the_permissions_as_an_array_for_a_role()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
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

        $role = new Role($arrayCollectionFactory);

        expect($role->getPermissions())->toBeInstanceOf(ArrayCollectionInterface::class);
        expect($role->getPermissions()->count())->toBe(0);

        $role->setPermissions($permissions);

        expect($role->getPermissions())->toBeInstanceOf(ArrayCollectionInterface::class);
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toEqual($permissions[$index]);
        }
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_set_the_permissions_as_an_arraycollectioninterface_for_a_role()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
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
        $arrayCollection = $arrayCollectionFactory->create($permissions);

        $role = new Role($arrayCollectionFactory);

        $role->setPermissions($arrayCollection);

        expect($role->getPermissions())->toBeInstanceOf(ArrayCollectionInterface::class);
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toEqual($permissions[$index]);
        }
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_add_a_permission_to_a_role()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
        $permissions = [
            new Permission(
                1,
                'can_generate_tinygraph_image',
                'Can Generate TinyGraph Image',
                'Allows the user to generate and retrieve a TinyGraph image.'
            ),
        ];

        $permission2 = new Permission(
            2,
            'can_view_github_repositories',
            'Can View GitHub Repositories',
            'Allows the user to view the GitHub repositories.'
        );

        $role = new Role(arrayCollectionFactory:  $arrayCollectionFactory, permissions: $permissions);

        $role->addPermission($permission2);

        expect($role->getPermissions()->count())->toBe(2);
        expect($role->getPermissions()->get(1))->toEqual($permission2);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_cannot_add_a_permission_to_a_role_that_is_already_associated_with_that_permission()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
        $permissions = [
            new Permission(
                1,
                'can_generate_tinygraph_image',
                'Can Generate TinyGraph Image',
                'Allows the user to generate and retrieve a TinyGraph image.'
            ),
        ];

        $role = new Role(arrayCollectionFactory:  $arrayCollectionFactory, permissions: $permissions);

        $role->addPermission($permissions[0]);

        expect($role->getPermissions()->count())->toBe(1);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_remove_a_permission_from_a_role()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();
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

        $role = new Role(arrayCollectionFactory:  $arrayCollectionFactory, permissions: $permissions);

        $role->removePermission($permissions[0]);

        expect($role->getPermissions()->count())->toBe(1);
        expect($role->getPermissions()->get(0))->toEqual($permissions[1]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_lazy_load_permissions_from_a_closure_for_a_role()
    {
        $arrayCollectionFactory = $this->createArrayCollectionFactoryInterface();

        $role = new Role($arrayCollectionFactory);

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

        $role->setPermissionLoader(function () use ($permissions) {
            return $permissions;
        });

        expect($role->getPermissions()->count())->toBe(count($permissions));
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toEqual($permissions[$index]);
        }
    }
}