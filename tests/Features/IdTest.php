<?php namespace Bkoetsier\FeatureToggle\Tests\Features;
// @codingStandardsIgnoreStart
use Bkoetsier\FeatureToggle\Features\Id;

class IdTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function it_throws_an_invalid_argument_exception_during_construct_given_a_non_string()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        $id = new Id(5);
    }

    /**
     * @test
     */
    public function it_returns_given_id()
    {
        $identifier = 'feature-1';
        $id = new Id($identifier);
        $this->assertEquals($identifier,$id->get());
    }

}
