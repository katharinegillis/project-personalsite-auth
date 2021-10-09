<?php declare(strict_types=1);

namespace App\Domain\Entity\Permission;

class NullPermission extends AbstractPermission
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function isNull(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function setPermissionKey(?string $permissionKey): void
    {
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name): void
    {
    }

    /**
     * @inheritDoc
     */
    public function setDescription(?string $description): void
    {
    }
}