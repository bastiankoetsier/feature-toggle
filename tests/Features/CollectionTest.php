<?php namespace Bkoetsier\FeatureToggle\Tests\Features;
// @codingStandardsIgnoreStart
use Bkoetsier\FeatureToggle\Exceptions\FeatureIdExistsException;
use Bkoetsier\FeatureToggle\Features\Collection;
use Bkoetsier\FeatureToggle\Features\Feature;
use Bkoetsier\FeatureToggle\Features\Id;

class CollectionTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
     public function it_returns_an_empty_array_after_initialization()
     {
         $collection = new Collection();
         $this->assertEmpty($collection->all());
     }

    /**
     * @test
     */
     public function it_adds_a_new_feature()
     {
         $feature = $this->buildFeatureMock();
         $collection = new Collection();
         $collection->add($feature->reveal());
         $this->assertCount(1,$collection->all());
     }

    /**
     * @test
     */
     public function it_throws_an_exception_when_feature_id_already_in_collection()
     {
         $this->setExpectedException(FeatureIdExistsException::class);
         $feature = $this->buildFeatureMock();
         $sameFeature = $this->buildFeatureMock();
         $collection = new Collection();

         $collection->add($feature->reveal());
         $collection->add($sameFeature->reveal());

     }

    /**
     * @test
     */
     public function it_returns_true_if_feature_id_exists_in_collection()
     {
         $feature = $this->buildFeatureMock();
         $collection = new Collection();
         $collection->add($feature->reveal());
         $this->assertTrue($collection->has($feature->reveal()->getId()));
     }

    /**
     * @test
     */
     public function it_removes_a_feature_by_feature_id()
     {
         $feature = $this->buildFeatureMock();
         $collection = new Collection();
         $collection->add($feature->reveal());
         $collection->remove($feature->reveal()->getId());
         $this->assertCount(0,$collection->all());
     }

    /**
     * @return \Prophecy\Prophecy\ObjectProphecy
     */
    protected function buildFeatureMock()
    {
        $feature = $this->prophesize(Feature::class);
        $featureId = $this->prophesize(Id::class);
        $featureId->get()->willReturn('Feature-1');
        $feature->getId()->willReturn($featureId->reveal());

        return $feature;
    }



}
