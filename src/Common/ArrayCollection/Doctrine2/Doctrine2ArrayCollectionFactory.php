<?php declare(strict_types=1);

namespace App\Common\ArrayCollection\Doctrine2;

use App\Common\ArrayCollection\ArrayCollectionFactoryInterface;
use App\Common\ArrayCollection\ArrayCollectionInterface;
use JetBrains\PhpStorm\Pure;

class Doctrine2ArrayCollectionFactory implements ArrayCollectionFactoryInterface
{
    /**
     * @inheritDoc
     */
    #[Pure] public function create(array $array = []): ArrayCollectionInterface
    {
        return new Doctrine2ArrayCollection($array);
    }
}