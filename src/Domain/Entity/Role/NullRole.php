<?php declare(strict_types=1);

namespace App\Domain\Entity\Role;

use App\Common\ArrayCollection\ArrayCollectionFactoryInterface;
use App\Common\ArrayCollection\ArrayCollectionInterface;
use App\Domain\Entity\Permission\PermissionInterface;
use Closure;

class NullRole extends AbstractRole
{
    /**
     * @param ArrayCollectionFactoryInterface $arrayCollectionFactory
     */
    public function __construct(ArrayCollectionFactoryInterface $arrayCollectionFactory)
    {
        parent::__construct($arrayCollectionFactory);

        $this->permissions = $arrayCollectionFactory->create([]);
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
    public function setName(?string $name): void
    {
    }

    /**
     * @inheritDoc
     */
    public function setDescription(?string $description): void
    {
    }

    /**
     * @inheritDoc
     */
    public function setPermissions(array|ArrayCollectionInterface $permissions): void
    {
    }

    /**
     * @inheritDoc
     */
    public function addPermission(PermissionInterface $permission): void
    {
    }

    /**
     * @inheritDoc
     */
    public function setPermissionLoader(Closure $permissionLoader): void
    {
    }
}