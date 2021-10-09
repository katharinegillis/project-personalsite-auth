<?php /** @noinspection PhpIllegalPsrClassPathInspection */
namespace App\Tests;

use App\Tests\_generated\IntegrationTesterActions;
use App\Tests\_support\Doctrine2TesterInterface;
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
class IntegrationTester extends Actor implements Doctrine2TesterInterface
{
    use IntegrationTesterActions;

    /**
     * @param mixed $actual
     * @return VerifyAny
     */
    public function canVerify(mixed $actual): VerifyAny
    {
        return verify($actual);
    }
}
