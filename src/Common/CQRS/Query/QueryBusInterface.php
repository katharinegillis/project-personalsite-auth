<?php declare(strict_types=1);

namespace App\Common\CQRS\Query;

interface QueryBusInterface
{
    /**
     * @param QueryInterface $message
     * @return mixed
     */
    public function handle(QueryInterface $message): mixed;
}