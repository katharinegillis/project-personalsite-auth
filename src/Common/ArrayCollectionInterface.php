<?php

namespace App\Common;

use Iterator;

interface ArrayCollectionInterface extends Iterator
{
    /**
     * @param mixed $element
     * @return bool
     */
    public function contains(mixed $element): bool;

    /**
     * @param mixed $element
     */
    public function add(mixed $element): bool;

    /**
     * @param mixed $element
     * @return bool
     */
    public function removeElement(mixed $element): bool;

    /**
     * @return array
     */
    public function getValues(): array;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @param int $index
     * @return mixed
     */
    public function get(int $index): mixed;
}