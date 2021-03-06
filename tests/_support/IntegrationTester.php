<?php declare(strict_types=1); /** @noinspection PhpIllegalPsrClassPathInspection */
namespace App\Tests;

use App\Tests\_generated\IntegrationTesterActions;
use App\Tests\_support\Doctrine2TesterInterface;
use Codeception\Actor;

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
}
