<?php declare(strict_types=1);

namespace App\Common\NullEntity;

trait NullableTrait
{
    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return false;
    }
}