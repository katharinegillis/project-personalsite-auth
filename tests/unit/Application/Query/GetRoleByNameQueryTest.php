<?php declare(strict_types=1);

namespace App\Tests\unit\Application\Query;

use App\Application\Query\GetRoleByNameQuery;
use Codeception\Test\Unit;

class GetRoleByNameQueryTest extends Unit
{
    /**
     * @test
     */
    public function I_can_create_a_GetRoleByNameQuery_with_the_given_data()
    {
        $name = 'Public';

        $getRoleByNameQuery = new GetRoleByNameQuery($name);

        expect($getRoleByNameQuery->getName())->toBe($name);
    }
}
