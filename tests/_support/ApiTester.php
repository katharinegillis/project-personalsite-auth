<?php /** @noinspection PhpIllegalPsrClassPathInspection */

namespace App\Tests;

use App\Tests\_generated\ApiTesterActions;
use Codeception\Actor;
use Codeception\Verify\Verifiers\VerifyAny;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class ApiTester extends Actor
{
    use ApiTesterActions;

    /**
     * @param mixed $actual
     * @return VerifyAny
     */
    public function canVerify(mixed $actual): VerifyAny
    {
        return verify($actual);
    }
}
