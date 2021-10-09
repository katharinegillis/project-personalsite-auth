<?php declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\Permission;

use App\Domain\Entity\Permission\Permission;
use App\Tests\_support\Helper\AssertionTrait\CheckPermissionTrait;
use Codeception\Test\Unit;

class PermissionTest extends Unit
{
    use CheckPermissionTrait;

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

        $this->checkPermission($permission, $id, $permissionKey, $name, $description);
    }

    /**
     * @test
     */
    public function I_can_create_a_permission_with_no_data()
    {
        $permission = new Permission();

        $this->checkPermission($permission, null, null, null, null);
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