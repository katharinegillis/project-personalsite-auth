<?php declare(strict_types=1);
namespace App\Tests\integration\Common;

use App\Common\ArrayCollection\Doctrine2\Doctrine2ArrayCollection;
use App\Common\ArrayCollection\Doctrine2\Doctrine2ArrayCollectionFactory;
use Codeception\Test\Unit;

class Doctrine2ArrayCollectionFactoryTest extends Unit
{
    /**
     * @test
     */
    public function I_can_create_an_array_collection_with_data()
    {
        $data = [1, 2, 3];

        $arrayCollectionFactory = new Doctrine2ArrayCollectionFactory();

        $arrayCollection = $arrayCollectionFactory->create($data);

        expect($arrayCollection)->toBeInstanceOf(Doctrine2ArrayCollection::class);
        expect($arrayCollection->count())->toBe(3);
        foreach ($arrayCollection as $index => $element) {
          expect($element)->toEqual($data[$index]);
        }
    }

    /**
     * @test
     */
    public function I_can_create_an_array_collection_with_no_data()
    {
        $arrayCollectionFactory = new Doctrine2ArrayCollectionFactory();

        $arrayCollection = $arrayCollectionFactory->create();

        expect($arrayCollection)->toBeInstanceOf(Doctrine2ArrayCollection::class);
        expect($arrayCollection->count())->toBe(0);
    }
}