<?php

namespace App\Common;

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