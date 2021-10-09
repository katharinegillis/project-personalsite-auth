<?php declare(strict_types=1);

namespace App\Tests\unit\Domain\Factory;

use App\Domain\Factory\PermissionFactory;
use App\Tests\_support\Helper\AssertionTrait\CheckPermissionTrait;
use Codeception\Test\Unit;

class PermissionFactoryTest extends Unit
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

        $permissionFactory = new PermissionFactory();

        $permission = $permissionFactory->create($id, $permissionKey, $name, $description);

        $this->checkPermission($permission, $id, $permissionKey, $name, $description);
    }

    /**
     * @test
     */
    public function I_can_create_a_permission_with_no_data()
    {
        $permissionFactory = new PermissionFactory();

        $permission = $permissionFactory->create();

        $this->checkPermission($permission, null, null, null, null);
    }

    /**
     * @test
     */
    public function I_can_create_a_null_permission()
    {
        $permissionFactory = new PermissionFactory();

        $nullPermission = $permissionFactory->createNull();

        $this->checkNullPermission($nullPermission);
    }
}