<?php

namespace App\Domain\Entity;

use App\Common\ArrayCollectionFactoryInterface;
use App\Common\ArrayCollectionInterface;

class Role
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ArrayCollectionInterface $permissions;

    protected ArrayCollectionFactoryInterface $arrayCollectionFactory;

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
        } else {
            $this->permissions = $this->arrayCollectionFactory->create();
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    protected function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return ArrayCollectionInterface
     */
    public function getPermissions(): ArrayCollectionInterface
    {
        return $this->permissions;
    }

    /**
     * @param ArrayCollectionInterface|array $permissions
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
     * @param Permission $permission
     */
    public function addPermission(Permission $permission): void
    {
        if (! $this->permissions->contains($permission)) {
            $this->permissions->add($permission);
        }
    }

    /**
     * @param Permission $permission
     */
    public function removePermission(Permission $permission): void
    {
        $this->permissions->removeElement($permission);
        $this->permissions = $this->arrayCollectionFactory->create($this->permissions->getValues());
    }
}