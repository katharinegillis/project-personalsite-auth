<?php declare(strict_types=1);

namespace App\Tests\_support\Helper\AssertionTrait;

use App\Common\ArrayCollection\ArrayCollectionInterface;
use App\Domain\Entity\Permission\PermissionInterface;
use App\Domain\Entity\Role\NullRole;
use App\Domain\Entity\Role\Role;
use App\Domain\Entity\Role\RoleInterface;

trait CheckRoleTrait
{
    use CheckPermissionTrait;

    public function checkRole(RoleInterface $role, ?int $id, ?string $name, ?string $description, array $permissions): void
    {
        expect($role)->toBeInstanceOf(Role::class);
        expect($role->getId())->toBe($id);
        expect($role->getName())->toBe($name);
        expect($role->getDescription())->toBe($description);
        expect($role->getPermissions())->toBeInstanceOf(ArrayCollectionInterface::class);
        /**
         * @var int $index
         * @var PermissionInterface $permission
         */
        foreach ($role->getPermissions() as $index => $permission) {
            /** @var PermissionInterface $expectedPermission */
            $expectedPermission = $permissions[$index];
            $this->checkPermission($permission, $expectedPermission->getId(), $expectedPermission->getPermissionKey(), $expectedPermission->getName(), $expectedPermission->getDescription());
        }
        expect($role->isNull())->toBeFalse();
    }

    public function checkNullRole(RoleInterface $role)
    {
        expect($role)->toBeInstanceOf(NullRole::class);
        expect($role->getId())->toBeNull();
        expect($role->getName())->toBeNull();
        expect($role->getDescription())->toBeNull();
        expect($role->getPermissions()->count())->toBe(0);
        expect($role->isNull())->toBeTrue();
    }
}