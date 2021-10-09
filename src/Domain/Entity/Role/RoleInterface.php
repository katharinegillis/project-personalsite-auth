<?php declare(strict_types=1);

namespace App\Domain\Entity\Role;

use App\Common\ArrayCollection\ArrayCollectionInterface;
use App\Domain\Entity\Permission\PermissionInterface;
use Closure;

interface RoleInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void;

    /**
     * @return ArrayCollectionInterface
     */
    public function getPermissions(): ArrayCollectionInterface;

    /**
     * @param ArrayCollectionInterface|array $permissions
     */
    public function setPermissions(array|ArrayCollectionInterface $permissions): void;

    /**
     * @param PermissionInterface $permission
     */
    public function addPermission(PermissionInterface $permission): void;

    /**
     * @param PermissionInterface $permission
     */
    public function removePermission(PermissionInterface $permission): void;

    /**
     * @param Closure $permissionLoader
     */
    public function setPermissionLoader(Closure $permissionLoader): void;

    /**
     * @return bool
     */
    public function isNull(): bool;
}