<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Common\CQRS\Query\QueryInterface;

class GetRoleByNameQuery implements QueryInterface
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}