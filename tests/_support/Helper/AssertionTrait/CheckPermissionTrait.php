<?php declare(strict_types=1);

namespace App\Tests\_support\Helper\AssertionTrait;

use App\Domain\Entity\Permission\NullPermission;
use App\Domain\Entity\Permission\Permission;
use App\Domain\Entity\Permission\PermissionInterface;

trait CheckPermissionTrait
{
    /**
     * @param PermissionInterface $permission
     * @param int|null $id
     * @param string|null $permissionKey
     * @param string|null $name
     * @param string|null $description
     */
    public function checkPermission(PermissionInterface $permission, ?int $id, ?string $permissionKey, ?string $name, ?string $description): void
    {
        expect($permission)->toBeInstanceOf(Permission::class);
        expect($permission->getId())->toBe($id);
        expect($permission->getPermissionKey())->toBe($permissionKey);
        expect($permission->getName())->toBe($name);
        expect($permission->getDescription())->toBe($description);
        expect($permission->isNull())->toBeFalse();
    }

    /**
     * @param PermissionInterface $permission
     */
    public function checkNullPermission(PermissionInterface $permission): void
    {
        expect($permission)->toBeInstanceOf(NullPermission::class);
        expect($permission->getId())->toBeNull();
        expect($permission->getPermissionKey())->toBeNull();
        expect($permission->getName())->toBeNull();
        expect($permission->getDescription())->toBeNull();
        expect($permission->isNull())->toBeTrue();
    }
}