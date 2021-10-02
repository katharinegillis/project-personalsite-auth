<?php

namespace App\Domain;

class Role
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?array $permissions = null;

    public function __construct(?int $id = null, ?string $name = null, ?string $description = null, ?array $permissions = null)
    {
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
     * @return array|null
     */
    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    /**
     * @param ?array $permissions
     */
    public function setPermissions(array|null $permissions): void
    {
        $this->permissions = $permissions;
    }
}