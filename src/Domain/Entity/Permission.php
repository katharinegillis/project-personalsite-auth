<?php

namespace App\Domain\Entity;

class Permission
{
    protected ?int $id = null;
    protected ?string $key = null;
    protected ?string $name = null;
    protected ?string $description = null;

    /**
     * @param int|null $id
     * @param string|null $key
     * @param string|null $name
     * @param string|null $description
     */
    public function __construct(?int $id = null, ?string $key = null, ?string $name = null, ?string $description = null)
    {
        if (isset($id)) {
            $this->setId($id);
        }

        if (isset($key)) {
            $this->setKey($key);
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
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     */
    public function setKey(?string $key): void
    {
        $this->key = $key;
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