<?php

namespace App\Common;

use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use JetBrains\PhpStorm\Pure;

class Doctrine2ArrayCollection implements ArrayCollectionInterface
{
    protected ArrayCollection $arrayCollection;

    /**
     * @param array $array
     */
    #[Pure] public function __construct(array $array = [])
    {
        $this->arrayCollection = new ArrayCollection($array);
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function contains(mixed $element): bool
    {
        return $this->arrayCollection->contains($element);
    }

    /**
     * @inheritDoc
     */
    public function add(mixed $element): bool
    {
        return $this->arrayCollection->add($element);
    }

    /**
     * @inheritDoc
     */
    public function removeElement(mixed $element): bool
    {
        return $this->arrayCollection->removeElement($element);
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function getValues(): array
    {
        return $this->arrayCollection->getValues();
    }

    /**
     * @inheritDoc
     */
    #[Pure] public function count(): int
    {
        return $this->arrayCollection->count();
    }

    /**
     * @inheritDoc
     */
    public function get(int $index): mixed
    {
        return $this->arrayCollection->get($index);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    #[Pure] public function current()
    {
        return $this->arrayCollection->current();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function next()
    {
        $this->arrayCollection->next();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    #[Pure] public function key(): float|bool|int|string|null
    {
        return $this->arrayCollection->key();
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function valid(): bool
    {
        return $this->arrayCollection->containsKey($this->arrayCollection->key());
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function rewind()
    {
        $this->arrayCollection->first();
    }
}