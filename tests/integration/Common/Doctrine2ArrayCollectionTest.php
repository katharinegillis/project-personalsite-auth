<?php
namespace App\Tests\integration\Common;

use App\Common\Doctrine2ArrayCollection;
use Codeception\Test\Unit;
use Exception;

class Doctrine2ArrayCollectionTest extends Unit
{
    /**
     * @test
     */
    public function I_can_create_an_array_collection_with_data()
    {
        $data = [ 1, 2, 3 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->count())->toBe(count($data));
        foreach ($arrayCollection as $index => $element) {
            expect($element)->toEqual($data[$index]);
        }
    }

    /**
     * @test
     */
    public function I_can_create_an_array_collection_with_no_data()
    {
        $arrayCollection = new Doctrine2ArrayCollection();

        expect($arrayCollection->count())->toBe(0);
    }

    /**
     * @test
     */
    public function I_can_check_that_an_array_collection_contains_a_simple_element()
    {
        $data = [ 1, 2, 3 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->contains(2))->toBeTrue();
    }

    /**
     * @test
     */
    public function I_can_check_that_an_array_collection_contains_a_complex_element()
    {
        $element = new Doctrine2ArrayCollection([ 1, 2, 3 ]);

        $arrayCollection = new Doctrine2ArrayCollection([ $element ]);

        expect($arrayCollection->contains($element))->toBeTrue();
    }

    /**
     * @test
     */
    public function I_can_add_an_element_to_an_array_collection()
    {
        $data = [ 1, 2, 3 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        $arrayCollection->add(4);

        expect($arrayCollection->count())->toBe(4);
        expect($arrayCollection->get(3))->toEqual(4);
    }

    /**
     * @test
     */
    public function I_can_remove_an_element_from_an_array_collection()
    {
        $data = [ 1, 2, 3 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        $arrayCollection->removeElement(1);

        expect($arrayCollection->count())->toBe(2);
        expect($arrayCollection->get(0))->toBeNull();
    }

    /**
     * @test
     */
    public function I_can_get_the_elements_of_an_array_collection_as_a_simple_array()
    {
        $data = [ 1, 2, 3 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection)->notToBeArray();

        $elements = $arrayCollection->getValues();

        expect($elements)->toBeArray();
        foreach ($elements as $index => $element) {
            expect($element)->toEqual($data[$index]);
        }
    }

    /**
     * @test
     */
    public function I_can_get_a_count_of_the_number_of_elements_in_an_array_collection()
    {
        $data = [ 1, 2, 3 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->count())->toBe(count($data));
    }

    /**
     * @test
     */
    public function I_can_get_an_element_from_the_array_collection_by_its_key()
    {
        $data = [ 1, 2, 3 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->get(2))->toEqual(3);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_get_the_element_at_the_current_iterator_position_for_the_array_collection()
    {
        $data = [ 'a' => 10, 'b' => 20, 'c' => 30 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->current())->toBe(10);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_advance_the_current_iterator_position_for_the_array_collection()
    {
        $data = [ 'a' => 10, 'b' => 20, 'c' => 30 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        $arrayCollection->next();

        expect($arrayCollection->current())->toBe(20);
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_get_the_key_of_the_element_at_the_current_iterator_position_for_the_array_collection()
    {
        $data = [ 'a' => 10, 'b' => 20, 'c' => 30 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->key())->toBe('a');
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_check_that_the_current_iterator_position_of_the_array_collection_contains_a_valid_element()
    {
        $data = [ 'a' => 10, 'b' => 20, 'c' => 30 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->valid())->toBeTrue();

        $arrayCollection->next();
        $arrayCollection->next();
        $arrayCollection->next();

        expect($arrayCollection->valid())->toBeFalse();
    }

    /**
     * @test
     * @throws Exception
     */
    public function I_can_rewind_the_iterator_position_to_the_start_of_the_array_collection()
    {
        $data = [ 'a' => 10, 'b' => 20, 'c' => 30 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        $arrayCollection->next();

        expect($arrayCollection->current())->toEqual(20);

        $arrayCollection->rewind();

        expect($arrayCollection->current())->toEqual(10);
    }

    /**
     * @test
     */
    public function I_can_check_that_the_array_collection_contains_a_particular_key()
    {
        $data = [ 'a' => 10, 'b' => 20, 'c' => 30 ];

        $arrayCollection = new Doctrine2ArrayCollection($data);

        expect($arrayCollection->containsKey('a'))->toBeTrue();
        expect($arrayCollection->containsKey(0))->toBeFalse();
    }
}