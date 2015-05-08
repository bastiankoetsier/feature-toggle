<?php namespace Bkoetsier\FeatureToggle\Config;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;

class Validator
{
    /**
     * @var \Symfony\Component\Config\Definition\Processor
     */
    private $configProcessor;
    /**
     * @var \Symfony\Component\Config\Definition\ConfigurationInterface
     */
    private $configValidator;

    public function __construct(Processor $configProcessor, ConfigurationInterface $configBuilder)
    {
        $this->configProcessor = $configProcessor;
        $this->configValidator = $configBuilder;
    }

    /**
     * @param array $parsedResult
     * @return array
     * @throws \Symfony\Component\Yaml\Exception\ParseException;
     */
    public function validate(array $parsedResult)
    {
        $result = $this->configProcessor->processConfiguration($this->configValidator, $parsedResult);
        return $result;
    }
}
