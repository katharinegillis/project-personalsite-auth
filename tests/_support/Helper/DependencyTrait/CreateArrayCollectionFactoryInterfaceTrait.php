<?php declare(strict_types=1);

namespace App\Tests\_support\Helper\DependencyTrait;

use App\Common\ArrayCollection\ArrayCollectionFactoryInterface;
use Codeception\Stub;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

trait CreateArrayCollectionFactoryInterfaceTrait
{
    use CreateArrayCollectionInterfaceTrait;

    /**
     * @param array|null $arrayCollectionFactoryInterfaceParams
     * @return ArrayCollectionFactoryInterface
     * @throws Exception
     */
    protected function createArrayCollectionFactoryInterface(?array $arrayCollectionFactoryInterfaceParams = null): ArrayCollectionFactoryInterface
    {
        if (null === $arrayCollectionFactoryInterfaceParams) {
            $arrayCollectionFactoryInterfaceParams = $this->getDefaultArrayCollectionFactoryInterfaceParams();
        }

        return Stub::makeEmpty(ArrayCollectionFactoryInterface::class, $arrayCollectionFactoryInterfaceParams);
    }

    /**
     * @return array
     */
    #[ArrayShape(['create' => "\Closure"])] protected function getDefaultArrayCollectionFactoryInterfaceParams(): array
    {
        return [
            'create' => function (array $array = []) {
                return $this->createArrayCollectionInterface($array);
            }
        ];
    }
}