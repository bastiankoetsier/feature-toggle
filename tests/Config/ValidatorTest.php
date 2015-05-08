<?php namespace Bkoetsier\FeatureToggle\Tests\Config;
// @codingStandardsIgnoreStart
use Bkoetsier\FeatureToggle\Config\Builder;
use Bkoetsier\FeatureToggle\Config\Validator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * i know this is not a "clear" unit-test, but it does its job :)
     * @test
     */
     public function it_throws_an_exception_if_given_config_doesnt_match_required_schema()
     {
         $this->setExpectedException(InvalidConfigurationException::class);
         $mockedParsedFeatures = [
             [
                 'id' => 'Feature-1',
                 'keys' => 'INVALID',
                 'state' => false
             ]
         ];
         $processor = new Processor();
         $builder = new Builder();
         $validator = new Validator($processor,$builder);
         $validator->validate($mockedParsedFeatures);
     }
}
