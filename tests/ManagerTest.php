<?php namespace Bkoetsier\FeatureToggle\Tests;

// @codingStandardsIgnoreStart
use Bkoetsier\FeatureToggle\Config\Builder;
use Bkoetsier\FeatureToggle\Config\Validator;
use Bkoetsier\FeatureToggle\Container\SymfonyContainerAdapter;
use Bkoetsier\FeatureToggle\Features\Collection;
use Bkoetsier\FeatureToggle\Features\Id;
use Bkoetsier\FeatureToggle\Features\State;
use Bkoetsier\FeatureToggle\Manager;
use Bkoetsier\FeatureToggle\Repository\YamlFeatureRepository;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Yaml\Parser;

class ManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Bkoetsier\FeatureToggle\Manager
     */
    private $manager;

    public function setUp()
    {
        $testYaml = new \SplFileInfo(__DIR__.'/fixtures/test-features.yml');
        $repo = $this->buildRepo($testYaml);
        $this->manager = new Manager($repo);
    }

    /**
     * @test
     */
     public function it_returns_all_active_features()
     {
         $activeFeatures = $this->manager->getActiveFeatures();
         $this->assertInstanceOf(Collection::class,$activeFeatures);
         $this->assertCount(1,$activeFeatures);
         $featureArray = $activeFeatures->all();
         $feature = array_pop($featureArray);
         $this->assertEquals(State::ON,$feature->getState()->get());
         $this->assertEquals((new Id('Enabled-Feature'))->get(),$feature->getId()->get());
     }

    /**
     * @test
     */
     public function it_returns_all_disabled_features()
     {
         $activeFeatures = $this->manager->getDisabledFeatures();
         $this->assertInstanceOf(Collection::class,$activeFeatures);
         $this->assertCount(1,$activeFeatures);
         $featureArray = $activeFeatures->all();
         $feature = array_pop($featureArray);
         $this->assertEquals(State::OFF,$feature->getState()->get());
         $this->assertEquals((new Id('Disabled-Feature'))->get(),$feature->getId()->get());
     }

    /**
     * @test
     */
     public function it_replaces_enabled_feature_keys_in_symfony_container()
     {
         $symfonyContainer = new Container();

         $oldService = new ServiceStub('oldService');
         $symfonyContainer->set('old.service',$oldService);
         $newFancyService = new ServiceStub('newFancyService');
         $symfonyContainer->set('new.service',$newFancyService);





         $adapter = new SymfonyContainerAdapter($symfonyContainer);
         $this->manager->setContainer($adapter);
         $this->manager->apply();

         $container = $this->manager->getAdapter()->getContainer();
         $replacedService = $container->get('old.service');
         $this->assertEquals($newFancyService,$replacedService);
         $this->assertEquals('newFancyService',$replacedService->name);
     }

    protected function buildRepo(\SplFileInfo $file)
    {
        $repo = new YamlFeatureRepository($file,new Parser(),new Validator(new Processor(),new Builder()));
        return $repo;
    }
}
