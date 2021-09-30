<?php
namespace App\Tests\unit;

use App\Domain\Permission;
use App\Tests\_support\UnitTester;
use Codeception\Test\Unit;

class PermissionTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected UnitTester $tester;

    /**
     * @test
     */
    public function I_can_create_a_permission_with_given_data()
    {
        $id = 1;
        $key = 'can_generate_tinygraph_image';
        $name = 'Can Generate TinyGraph Image';
        $description = 'Allows the user to generate and retrieve a TinyGraph image.';

        $permission = new Permission($id, $key, $name, $description);

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
        $permission = new Permission();

        expect($permission->getId())->toBeNull();
        expect($permission->getKey())->toBeNull();
        expect($permission->getName())->toBeNull();
        expect($permission->getDescription())->toBeNull();
    }

    /**
     * @test
     */
    public function I_can_set_the_key_for_a_permission()
    {
        $key = 'can_generate_tinygraph_image';

        $permission = new Permission();

        expect($permission->getKey())->toBeNull();

        $permission->setKey($key);

        expect($permission->getKey())->toBe($key);
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