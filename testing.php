<?php
use Bkoetsier\FeatureToggle\Features\State;
use Bkoetsier\FeatureToggle\Repository\YamlFeatureRepository;

require_once('vendor/autoload.php');


$featureId = new \Bkoetsier\FeatureToggle\Features\Id('Feature-1');
$feature1 = new \Bkoetsier\FeatureToggle\Features\Feature($featureId,[],new State(State::ON));
$feature2 = new \Bkoetsier\FeatureToggle\Features\Feature($featureId,[],new State(State::ON));

$collection = new \Bkoetsier\FeatureToggle\Features\Collection();
$collection->add($feature1);
dump($collection->all());
$collection->add($feature2);
dump($collection->all());




$parser = new \Symfony\Component\Yaml\Parser();

$processor = new \Symfony\Component\Config\Definition\Processor();
$configuration = new \Bkoetsier\FeatureToggle\Config\Builder();

$repo = new YamlFeatureRepository(new \SplFileInfo('features.yml'), $parser, $processor, $configuration);
$result = $repo->all();






dump($result);
