<?php declare(strict_types=1);

namespace App\Tests\_support\Helper\DependencyTrait;

use App\Common\ArrayCollectionInterface;
use Codeception\Stub;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

trait CreateArrayCollectionInterfaceTrait
{
    /**
     * @param array $array
     * @param array|null $arrayCollectionInterfaceParams
     * @return ArrayCollectionInterface
     * @throws Exception
     */
    protected function createArrayCollectionInterface(array $array = [], ?array $arrayCollectionInterfaceParams = null): ArrayCollectionInterface
    {
        if (null === $arrayCollectionInterfaceParams) {
            $arrayCollectionInterfaceParams = $this->getDefaultArrayCollectionInterfaceParams($array);
        }

        return Stub::makeEmpty(ArrayCollectionInterface::class, $arrayCollectionInterfaceParams);
    }

    /**
     * @param array $array
     * @return array
     */
    #[ArrayShape([
        'current' => '\Closure',
        'key' => '\Closure',
        'next' => '\Closure',
        'valid' => '\Closure',
        'rewind' => '\Closure',
        'count' => '\Closure',
        'add' => '\Closure',
        'get' => '\Closure',
        'contains' => '\Closure',
        'removeElement' => '\Closure',
        'getValues' => '\Closure',
    ])] protected function getDefaultArrayCollectionInterfaceParams(array $array = []): array
    {
        $position = 0;

        return [
            'current' => function () use (&$array, &$position) {
                return $array[$position];
            },
            'key' => function () use (&$position) {
                return $position;
            },
            'next' => function () use (&$position) {
                $position += 1;
            },
            'valid' => function () use (&$array, &$position) {
                return isset($array[$position]);
            },
            'rewind' => function () use (&$position) {
                $position = 0;
            },
            'count' => function () use (&$array) {
                return count($array);
            },
            'add' => function ($element) use (&$array) {
                $array[] = $element;
                return true;
            },
            'get' => function ($index) use (&$array) {
                return $array[$index];
            },
            'contains' => function ($element) use (&$array) {
                return in_array($element, $array);
            },
            'removeElement' => function ($element) use (&$array) {
                $index = array_search($element, $array);
                unset($array[$index]);
                return true;
            },
            'getValues' => function () use (&$array) {
                return array_values($array);
            }
        ];
    }
}