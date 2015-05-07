<?php
use Bkoetsier\FeatureToggle\Repository\YamlFeatureRepository;

require_once('vendor/autoload.php');






$parser = new \Symfony\Component\Yaml\Parser();

$processor = new \Symfony\Component\Config\Definition\Processor();
$configuration = new \Bkoetsier\FeatureToggle\Config\Builder();

$repo = new YamlFeatureRepository(new \SplFileInfo('features.yml'), $parser, $processor, $configuration);
$result = $repo->all();






dump($result);
