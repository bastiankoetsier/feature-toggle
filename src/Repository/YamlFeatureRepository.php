<?php namespace Bkoetsier\FeatureToggle\Repository;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Parser;

class YamlFeatureRepository implements FeatureRepository
{
    /**
     * @var \Symfony\Component\Yaml\Parser
     */
    private $yaml;
    /**
     * @var \Symfony\Component\Config\Definition\Processor
     */
    private $configProcessor;
    /**
     * @var \Symfony\Component\Config\Definition\ConfigurationInterface
     */
    private $configValidator;
    /**
     * @var \SplFileInfo
     */
    private $file;


    /**
     * @param \SplFileInfo $file
     * @param \Symfony\Component\Yaml\Parser $yaml
     * @param \Symfony\Component\Config\Definition\Processor $configProcessor
     * @param \Symfony\Component\Config\Definition\ConfigurationInterface $configValidator
     */
    public function __construct(
        \SplFileInfo $file,
        Parser $yaml,
        Processor $configProcessor,
        ConfigurationInterface $configValidator
    ) {
        $this->guardFile($file);
        $this->file = $file;
        $this->yaml = $yaml;
        $this->configProcessor = $configProcessor;
        $this->configValidator = $configValidator;
    }

    private function guardFile(\SplFileInfo $fileInfo)
    {
        if (! in_array($fileInfo->getExtension(), ['yml','yaml'])) {
            throw new \InvalidArgumentException("provided file is not a valid .yml");
        }
        return true;
    }

    /**
     * @return array
     */
    public function all()
    {
        $configArray = $this->yaml->parse(file_get_contents($this->file->getRealPath()));
        $result = $this->configProcessor->processConfiguration($this->configValidator, $configArray);
        return $result;
    }
}
