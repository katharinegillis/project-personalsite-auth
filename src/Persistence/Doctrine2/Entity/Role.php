<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace App\Persistence\Doctrine2\Entity;

use App\Persistence\Doctrine2\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 */
class Role
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @var ?string
     */
    private ?string $description = null;

    /**
     * @ORM\ManyToMany(targetEntity="Permission")
     * @ORM\JoinTable(name="role_permission",
     *     joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="permission_id", referencedColumnName="id")}
     * )
     */
    private Collection $permissions;

    /**
     * @param string|null $name
     * @param string|null $description
     * @param array $permissions
     */
    public function __construct(?string $name = null, ?string $description = null, array $permissions = [])
    {
        if (null !== $name) {
            $this->setName($name);
        }

        if (null !== $description) {
            $this->setDescription($description);
        }

        $this->setPermissions($permissions);
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
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    /**
     * @param array|Collection $permissions
     */
    public function setPermissions(array|Collection $permissions): void
    {
        if ($permissions instanceof Collection) {
            $this->permissions = $permissions;
            return;
        }

        $this->permissions = new ArrayCollection($permissions);
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
        $this->permissions = new ArrayCollection($this->permissions->getValues());
    }
}