<?php
use Bkoetsier\FeatureToggle\Features\State;
use Bkoetsier\FeatureToggle\Repository\YamlFeatureRepository;

require_once('vendor/autoload.php');


$featureId = new \Bkoetsier\FeatureToggle\Features\Id('Feature-1');
$feature1 = new \Bkoetsier\FeatureToggle\Features\Feature($featureId,[],new State(State::ON));
$feature2 = new \Bkoetsier\FeatureToggle\Features\Feature($featureId,[],new State(State::ON));






$parser = new \Symfony\Component\Yaml\Parser();

$processor = new \Symfony\Component\Config\Definition\Processor();
$configuration = new \Bkoetsier\FeatureToggle\Config\Builder();
$validator = new \Bkoetsier\FeatureToggle\Config\Validator($processor,$configuration);


$repo = new YamlFeatureRepository(new \SplFileInfo('features-example.yml'), $parser, $validator);
$result = $repo->all();


$manager = new \Bkoetsier\FeatureToggle\Manager($repo);
dump($manager->getActiveFeatures());exit;





dump($result);
