<?php
namespace App\Tests\unit\Persistence\Doctrine2\Entity;

use App\Persistence\Doctrine2\Entity\Permission;
use Codeception\Test\Unit;

class PermissionTest extends Unit
{
    /**
     * @test
     */
    public function I_can_set_the_key_for_a_permission()
    {
        $key = 'can_generate_tinygraph_image';

        $permission = new Permission();

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