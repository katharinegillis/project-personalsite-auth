<?php declare(strict_types=1);

namespace App\Common\ArrayCollection;

interface ArrayCollectionFactoryInterface
{
    /**
     * @param array $array
     * @return ArrayCollectionInterface
     */
    public function create(array $array = []): ArrayCollectionInterface;
}