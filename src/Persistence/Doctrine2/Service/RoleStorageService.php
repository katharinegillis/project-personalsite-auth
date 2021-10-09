<?php declare(strict_types=1);

namespace App\Persistence\Doctrine2\Service;

use App\Application\Service\RoleStorageServiceInterface;
use App\Domain\Entity\Role;
use App\Domain\Factory\RoleFactory;
use App\Persistence\Doctrine2\Entity\Role as Doctrine2Role;
use App\Persistence\Doctrine2\Repository\RoleRepository;

class RoleStorageService implements RoleStorageServiceInterface
{
    protected RoleRepository $roleRepository;
    protected RoleFactory $roleFactory;

    /**
     * @param RoleRepository $roleRepository
     * @param RoleFactory $roleFactory
     */
    public function __construct(RoleRepository $roleRepository, RoleFactory $roleFactory)
    {
        $this->roleRepository = $roleRepository;
        $this->roleFactory = $roleFactory;
    }

    /**
     * @inheritDoc
     */
    public function findByName(string $name): Role
    {
        $doctrine2Role = $this->roleRepository->findOneBy([ 'name' => $name ]);

        return $this->convertToDomain($doctrine2Role);
    }

    /**
     * @param Doctrine2Role $doctrine2Role
     * @return Role
     */
    public function convertToDomain(Doctrine2Role $doctrine2Role): Role
    {
        return $this->roleFactory->create(
            $doctrine2Role->getId(),
            $doctrine2Role->getName(),
            $doctrine2Role->getDescription(),
        );
    }
}