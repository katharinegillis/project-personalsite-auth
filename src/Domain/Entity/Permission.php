<?php declare(strict_types=1);

namespace App\Domain\Entity;

class Permission
{
    protected ?int $id = null;
    protected ?string $permissionKey = null;
    protected ?string $name = null;
    protected ?string $description = null;

    /**
     * @param int|null $id
     * @param string|null $permissionKey
     * @param string|null $name
     * @param string|null $description
     */
    public function __construct(?int $id = null, ?string $permissionKey = null, ?string $name = null, ?string $description = null)
    {
        if (isset($id)) {
            $this->setId($id);
        }

        if (isset($permissionKey)) {
            $this->setPermissionKey($permissionKey);
        }

        if (isset($name)) {
            $this->setName($name);
        }

        if (isset($description)) {
            $this->setDescription($description);
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
    public function getPermissionKey(): ?string
    {
        return $this->permissionKey;
    }

    /**
     * @param string|null $permissionKey
     */
    public function setPermissionKey(?string $permissionKey): void
    {
        $this->permissionKey = $permissionKey;
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
}