<?php
namespace App\Tests\unit\Domain\Factory;

use App\Common\ArrayCollectionInterface;
use App\Domain\Entity\Permission;
use App\Domain\Entity\Role;
use App\Domain\Factory\RoleFactory;
use App\Tests\_support\Helper\CreateArrayCollectionFactoryInterface;
use Codeception\Test\Unit;
use Exception;

class RoleFactoryTest extends Unit
{
    use CreateArrayCollectionFactoryInterface;

    /**
     * @test
     * @throws Exception
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

        $roleFactory = new RoleFactory($this->createArrayCollectionFactoryInterface());

        $role = $roleFactory->create($id, $name, $description, $permissions);

        expect($role->getId())->toBe($id);
        expect($role->getName())->toBe($name);
        expect($role->getDescription())->toBe($description);
        expect($role->getPermissions())->toBeInstanceOf(ArrayCollectionInterface::class);
        foreach ($role->getPermissions() as $index => $permission) {
            expect($permission)->toEqual($permissions[$index]);
        }
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_create_a_role_with_no_data()
    {
        $roleFactory = new RoleFactory($this->createArrayCollectionFactoryInterface());

        $role = $roleFactory->create();

        expect($role->getId())->toBeNull();
        expect($role->getName())->toBeNull();
        expect($role->getDescription())->toBeNull();
        expect($role->getPermissions())->toBeInstanceOf(ArrayCollectionInterface::class);
        expect($role->getPermissions()->count())->toBe(0);
    }
}