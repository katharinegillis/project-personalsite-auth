<?php

namespace App\Domain\Factory;

use App\Common\ArrayCollectionFactoryInterface;
use App\Common\ArrayCollectionInterface;
use App\Domain\Entity\Role;

class RoleFactory
{
    protected ArrayCollectionFactoryInterface $arrayCollectionFactory;

    /**
     * @param ArrayCollectionFactoryInterface $arrayCollectionFactory
     */
    public function __construct(ArrayCollectionFactoryInterface $arrayCollectionFactory)
    {
        $this->arrayCollectionFactory = $arrayCollectionFactory;
    }

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $description
     * @param array|ArrayCollectionInterface|null $permissions
     * @return Role
     */
    public function create(?int $id = null, ?string $name = null, ?string $description = null, array|ArrayCollectionInterface|null $permissions = null): Role
    {
        return new Role($this->arrayCollectionFactory, $id, $name, $description, $permissions);
    }
}