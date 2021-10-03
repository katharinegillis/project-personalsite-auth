<?php
namespace App\Tests\unit\Domain\Factory;

use App\Domain\Entity\Permission;
use App\Domain\Factory\PermissionFactory;
use Codeception\Test\Unit;

class PermissionFactoryTest extends Unit
{
    /**
     * @test
     */
    public function I_can_create_a_permission_with_given_data()
    {
        $id = 1;
        $key = 'can_generate_tinygraph_image';
        $name = 'Can Generate TinyGraph Image';
        $description = 'Allows the user to generate and retrieve a TinyGraph image.';

        $permissionFactory = new PermissionFactory();

        $permission = $permissionFactory->create($id, $key, $name, $description);

        expect($permission->getId())->toBe($id);
        expect($permission->getKey())->toBe($key);
        expect($permission->getName())->toBe($name);
        expect($permission->getDescription())->toBe($description);
    }

    /**
     * @test
     */
    public function I_can_create_a_permission_with_no_data()
    {
        $permissionFactory = new PermissionFactory();

        $permission = $permissionFactory->create();

        expect($permission->getId())->toBeNull();
        expect($permission->getKey())->toBeNull();
        expect($permission->getName())->toBeNull();
        expect($permission->getDescription())->toBeNull();
    }
}