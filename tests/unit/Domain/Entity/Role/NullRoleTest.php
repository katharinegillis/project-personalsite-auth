<?php declare(strict_types=1);

namespace App\Tests\unit\Domain\Entity\Role;

use App\Common\ArrayCollection\ArrayCollectionInterface;
use App\Domain\Entity\Permission\Permission;
use App\Domain\Entity\Role\NullRole;
use App\Domain\Entity\Role\Role;
use App\Tests\_support\Helper\AssertionTrait\CheckRoleTrait;
use App\Tests\_support\Helper\DependencyTrait\CreateArrayCollectionFactoryInterfaceTrait;
use App\Tests\_support\Helper\DomainTrait\DefaultPermissionsTrait;
use Codeception\Test\Unit;
use Exception;

class NullRoleTest extends Unit
{
    use CreateArrayCollectionFactoryInterfaceTrait;
    use DefaultPermissionsTrait;
    use CheckRoleTrait;

    /**
     * @test
     * @throws Exception
     */
    public function I_can_create_a_null_role()
    {
        $nullRole = new NullRole($this->createArrayCollectionFactoryInterface());

        $this->checkNullRole($nullRole);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_cannot_create_a_null_role_with_data()
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

        $nullRole = new NullRole($arrayCollectionFactory, $id, $name, $description, $permissions);

        $this->checkNullRole($nullRole);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_cannot_set_the_name_of_a_null_role()
    {
        $nullRole = new NullRole($this->createArrayCollectionFactoryInterface());

        $nullRole->setName('Some Name');

        expect($nullRole->getName())->toBeNull();
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_cannot_set_the_description_of_a_null_role()
    {
        $nullRole = new NullRole($this->createArrayCollectionFactoryInterface());

        $nullRole->setDescription('Some description');

        expect($nullRole->getDescription())->toBeNull();
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_cannot_set_the_permissions_of_a_null_role()
    {
        list(
            'tinyGraphPermission' => $tinyGraphPermission
            ) = $this->getDefaultPermissions();

        $nullRole = new NullRole($this->createArrayCollectionFactoryInterface());

        $nullRole->setPermissions([ $tinyGraphPermission ]);

        expect($nullRole->getPermissions()->count())->toBe(0);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_cannot_add_a_permission_to_a_null_role()
    {
        list(
            'tinyGraphPermission' => $tinyGraphPermission
            ) = $this->getDefaultPermissions();

        $nullRole = new NullRole($this->createArrayCollectionFactoryInterface());

        $nullRole->addPermission($tinyGraphPermission);

        expect($nullRole->getPermissions()->count())->toBe(0);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_cannot_remove_a_permission_from_a_null_role()
    {
        list(
            'tinyGraphPermission' => $tinyGraphPermission
            ) = $this->getDefaultPermissions();

        $nullRole = new NullRole($this->createArrayCollectionFactoryInterface());

        $nullRole->removePermission($tinyGraphPermission);

        expect($nullRole->getPermissions()->count())->toBe(0);
    }
}
