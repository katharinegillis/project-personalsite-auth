<?php declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\Permission;

use App\Domain\Entity\Permission\NullPermission;
use App\Tests\_support\Helper\AssertionTrait\CheckPermissionTrait;
use Codeception\Test\Unit;

class NullPermissionTest extends Unit
{
    use CheckPermissionTrait;

    /**
     * @test
     */
    public function I_can_create_a_null_permission()
    {
        $nullPermission = new NullPermission();

        $this->checkNullPermission($nullPermission);
    }

    /**
     * @test
     */
    public function I_cannot_create_a_null_permission_with_data()
    {
        $id = 1;
        $permissionKey = 'can_generate_tinygraph_image';
        $name = 'Can Generate TinyGraph Image';
        $description = 'Allows the user to generate and retrieve a TinyGraph image.';

        $nullPermission = new NullPermission($id, $permissionKey, $name, $description);

        $this->checkNullPermission($nullPermission);
    }

    /**
     * @test
     */
    public function I_cannot_set_the_permission_key_of_a_null_permission()
    {
        $nullPermission = new NullPermission();

        $nullPermission->setPermissionKey('some_permission_key');

        expect($nullPermission->getPermissionKey())->toBeNull();
    }

    /**
     * @test
     */
    public function I_cannot_set_the_name_of_a_null_permission()
    {
        $nullPermission = new NullPermission();

        $nullPermission->setName('Some Permission Name');

        expect($nullPermission->getName())->toBeNull();
    }

    /**
     * @test
     */
    public function I_cannot_set_the_description_of_a_null_permission()
    {
        $nullPermission = new NullPermission();

        $nullPermission->setDescription('Some description');

        expect($nullPermission->getDescription())->toBeNull();
    }
}
