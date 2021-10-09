<?php declare(strict_types=1);

namespace App\Persistence\Doctrine2\Entity;

use App\Persistence\Doctrine2\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PermissionRepository::class)
 */
class Permission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected string $permissionKey;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var string|null
     */
    protected ?string $description = null;

    /**
     * @param string|null $permissionKey
     * @param string|null $name
     * @param string|null $description
     */
    public function __construct(?string $permissionKey = null, ?string $name = null, ?string $description = null)
    {
        if (null !== $permissionKey) {
            $this->setPermissionKey($permissionKey);
        }

        if (null !== $name) {
            $this->setName($name);
        }

        if (null !== $description) {
            $this->setDescription($description);
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPermissionKey(): string
    {
        return $this->permissionKey;
    }

    /**
     * @param string $permissionKey
     */
    public function setPermissionKey(string $permissionKey): void
    {
        $this->permissionKey = $permissionKey;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
