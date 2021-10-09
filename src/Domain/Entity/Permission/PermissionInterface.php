<?php declare(strict_types=1);

namespace App\Domain\Entity\Permission;

interface PermissionInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string|null
     */
    public function getPermissionKey(): ?string;

    /**
     * @param string|null $permissionKey
     */
    public function setPermissionKey(?string $permissionKey): void;

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
     * @return bool
     */
    public function isNull(): bool;
}