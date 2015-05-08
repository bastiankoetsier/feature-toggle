<?php namespace Bkoetsier\FeatureToggle;

use Bkoetsier\FeatureToggle\Container\Adapter;
use Bkoetsier\FeatureToggle\Features\Collection;
use Bkoetsier\FeatureToggle\Features\State;
use Bkoetsier\FeatureToggle\Repository\FeatureRepository;

class Manager
{
    /**
     * @var \Bkoetsier\FeatureToggle\Repository\FeatureRepository
     */
    private $repo;
    /**
     * @var \Bkoetsier\FeatureToggle\Container\Adapter
     */
    private $container;
    /**
     * @var \Bkoetsier\FeatureToggle\Features\FeatureCollection
     */
    private $features;

    public function __construct(FeatureRepository $repo, Adapter $container = null)
    {
        $this->repo = $repo;
        $this->container = $container;
        $this->importFeatures();
    }

    public function setContainer(Adapter $container)
    {
        $this->container = $container;
    }

    public function getAdapter()
    {
        return $this->container;
    }

    /**
     * @return bool
     */
    protected function importFeatures()
    {
        $this->features = $this->repo->all();
        return true;
    }

    /**
     * @return \Bkoetsier\FeatureToggle\Features\FeatureCollection
     */
    public function getAllFeatures()
    {
        return $this->features;
    }

    /**
     * @return \Bkoetsier\FeatureToggle\Features\Collection
     */
    public function getActiveFeatures()
    {
        $active = $this->getFeaturesByState(new State(State::ON));
        $collection = new Collection;
        array_map([$collection,'add'], $active);
        return $collection;
    }

    public function getDisabledFeatures()
    {
        $disabled = $this->getFeaturesByState(new State(State::OFF));
        $collection = new Collection;
        array_map([$collection, 'add'], $disabled);
        return $collection;
    }

    protected function getFeaturesByState(State $state)
    {
        $filtered = array_filter($this->features->all(), function ($element) use ($state) {
            /** @var \Bkoetsier\FeatureToggle\Features\Feature $element */
            return $element->getState()->get() == $state->get();
        });
        return $filtered;
    }

    /**
     * Replaces all services in the given container
     * @return int replaced services
     */
    public function apply()
    {
        $replaced = 0;
        /** @var \Bkoetsier\FeatureToggle\Features\Feature $feature */
        foreach ($this->getActiveFeatures()->all() as $feature) {
            foreach ($feature->getKeys() as $serviceKey) {
                $oldKey = $serviceKey['idOld'];
                $newKey = $serviceKey['idNew'];
                $newService = $this->container->get($newKey);
                $this->container->set($oldKey, $newService);
                $replaced++;
            }
        }
        return $replaced;
    }
}