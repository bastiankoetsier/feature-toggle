<?php namespace Bkoetsier\FeatureToggle\Tests\Features;
// @codingStandardsIgnoreStart
use Bkoetsier\FeatureToggle\Features\State;

class StateTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function it_throws_an_exception_when_instantiated_with_no_boolean_value()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        $state = new State('test');
    }

    /**
     * @test
     */
    public function it_returns_given_state()
    {
        $on = 1;
        $state = new State($on);
        $this->assertEquals($on,$state->get());
    }
}
