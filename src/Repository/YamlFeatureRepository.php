<?php namespace Bkoetsier\FeatureToggle\Repository;

use Bkoetsier\FeatureToggle\Config\Validator;

use Bkoetsier\FeatureToggle\Features\Collection;
use Bkoetsier\FeatureToggle\Features\Feature;
use Bkoetsier\FeatureToggle\Features\Id;
use Bkoetsier\FeatureToggle\Features\State;
use Symfony\Component\Yaml\Parser;

class YamlFeatureRepository implements FeatureRepository
{
    /**
     * @var \Symfony\Component\Yaml\Parser
     */
    private $yaml;
    /**
     * @var \SplFileInfo
     */
    private $file;

    /**
     * @var \Bkoetsier\FeatureToggle\Config\Validator;
     */
    private $validator;

    /**
     * @param \SplFileInfo $file
     * @param \Symfony\Component\Yaml\Parser $yaml
     * @param \Bkoetsier\FeatureToggle\Config\Validator $configValidator
     */
    public function __construct(
        \SplFileInfo $file,
        Parser $yaml,
        Validator $configValidator
    ) {
        $this->guardFile($file);
        $this->file = $file;
        $this->yaml = $yaml;
        $this->validator = $configValidator;
    }

    /**
     * @param \SplFileInfo $fileInfo
     * @return bool
     * @throws \InvalidArgumentException
     */
    private function guardFile(\SplFileInfo $fileInfo)
    {
        if (! in_array($fileInfo->getExtension(), ['yml','yaml'])) {
            throw new \InvalidArgumentException("provided file is not a valid .yml");
        }
        return true;
    }

    /**
     * @return \Bkoetsier\FeatureToggle\Features\Collection
     */
    public function all()
    {
        $configArray = $this->yaml->parse(file_get_contents($this->file->getRealPath()));
        $config =  $this->validator->validate($configArray);
        return $this->buildCollection($config);
    }

    /**
     * @Todo extract collection building
     * @param array $config
     * @return \Bkoetsier\FeatureToggle\Features\Collection
     */
    private function buildCollection(array $config)
    {
        $collection = new Collection();
        foreach ($config as $feature) {
            $featureId = new Id($feature['id']);
            $keys = $feature['keys'];
            $state = new State((int) $feature['state']);
            $collection->add(new Feature($featureId, $keys, $state));
        }
        return $collection;
    }


}
