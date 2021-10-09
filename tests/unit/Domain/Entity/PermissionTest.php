<?php declare(strict_types=1);
namespace App\Tests\unit\Domain\Entity;

use App\Domain\Entity\Permission;
use Codeception\Test\Unit;

class PermissionTest extends Unit
{
    /**
     * @test
     */
    public function I_can_create_a_permission_with_given_data()
    {
        $id = 1;
        $permissionKey = 'can_generate_tinygraph_image';
        $name = 'Can Generate TinyGraph Image';
        $description = 'Allows the user to generate and retrieve a TinyGraph image.';

        $permission = new Permission($id, $permissionKey, $name, $description);

        expect($permission->getId())->toBe($id);
        expect($permission->getPermissionKey())->toBe($permissionKey);
        expect($permission->getName())->toBe($name);
        expect($permission->getDescription())->toBe($description);
    }

    /**
     * @test
     */
    public function I_can_create_a_permission_with_no_data()
    {
        $permission = new Permission();

        expect($permission->getId())->toBeNull();
        expect($permission->getPermissionKey())->toBeNull();
        expect($permission->getName())->toBeNull();
        expect($permission->getDescription())->toBeNull();
    }

    /**
     * @test
     */
    public function I_can_set_the_key_for_a_permission()
    {
        $permissionKey = 'can_generate_tinygraph_image';

        $permission = new Permission();

        expect($permission->getPermissionKey())->toBeNull();

        $permission->setPermissionKey($permissionKey);

        expect($permission->getPermissionKey())->toBe($permissionKey);
    }

    /**
     * @test
     */
    public function I_can_set_the_name_for_a_permission()
    {
        $name = 'Can Generate TinyGraph Image';

        $permission = new Permission();

        expect($permission->getName())->toBeNull();

        $permission->setName($name);

        expect($permission->getName())->toBe($name);
    }

    /**
     * @test
     */
    public function I_can_set_the_description_for_a_permission()
    {
        $description = 'Allows the user to generate and retrieve a TinyGraph image.';

        $permission = new Permission();

        expect($permission->getDescription())->toBeNull();

        $permission->setDescription($description);

        expect($permission->getDescription())->toBe($description);
    }
}