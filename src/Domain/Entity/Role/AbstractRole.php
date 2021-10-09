<?php declare(strict_types=1);

namespace App\Domain\Entity\Role;

use App\Common\ArrayCollection\ArrayCollectionFactoryInterface;
use App\Common\ArrayCollection\ArrayCollectionInterface;
use App\Common\NullEntity\NullableTrait;
use App\Domain\Entity\Permission\PermissionInterface;
use Closure;

abstract class AbstractRole implements RoleInterface
{
    use NullableTrait;

    /**
     * @var Closure|null
     */
    protected ?Closure $permissionLoader = null;

    /**
     * @var ArrayCollectionInterface|null
     */
    protected ?ArrayCollectionInterface $permissions = null;

    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @var ArrayCollectionFactoryInterface
     */
    protected ArrayCollectionFactoryInterface $arrayCollectionFactory;

    /**
     * @var int|null
     */
    protected ?int $id = null;

    /**
     * @param ArrayCollectionFactoryInterface $arrayCollectionFactory
     * @param int|null $id
     * @param string|null $name
     * @param string|null $description
     * @param array|ArrayCollectionInterface|null $permissions
     */
    public function __construct(ArrayCollectionFactoryInterface $arrayCollectionFactory, ?int $id = null, ?string $name = null, ?string $description = null, array|ArrayCollectionInterface|null $permissions = null)
    {
        $this->arrayCollectionFactory = $arrayCollectionFactory;

        if (isset($id)) {
            $this->setId($id);
        }

        if (isset($name)) {
            $this->setName($name);
        }

        if (isset($description)) {
            $this->setDescription($description);
        }

        if (isset($permissions)) {
            $this->setPermissions($permissions);
        }
    }

    /**
     * @inheritDoc
     */
    public function getPermissions(): ArrayCollectionInterface
    {
        $this->loadPermissions();

        return $this->permissions;
    }

    /**
     * @inheritDoc
     */
    public function setPermissionLoader(Closure $permissionLoader): void
    {
        $this->permissionLoader = $permissionLoader;
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function addPermission(PermissionInterface $permission): void
    {
        $this->loadPermissions();

        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
        }
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    protected function loadPermissions(): void
    {
        if (null !== $this->permissions) {
            return;
        }

        if (null !== $this->permissionLoader) {
            $closure = $this->permissionLoader;
            $this->setPermissions($closure());
        } else {
            $this->setPermissions([]);
        }
    }

    /**
     * @inheritDoc
     */
    public function setPermissions(array|ArrayCollectionInterface $permissions): void
    {
        if ($permissions instanceof ArrayCollectionInterface) {
            $this->permissions = $permissions;
        } else {
            $this->permissions = $this->arrayCollectionFactory->create($permissions);
        }
    }

    /**
     * @param int|null $id
     */
    protected function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function removePermission(PermissionInterface $permission): void
    {
        $this->loadPermissions();

        $this->permissions->removeElement($permission);
        $this->permissions = $this->arrayCollectionFactory->create($this->permissions->getValues());
    }
}