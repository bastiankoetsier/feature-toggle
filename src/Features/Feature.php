<?php namespace Bkoetsier\FeatureToggle\Features;

use Bkoetsier\FeatureToggle\FeatureCollection;

class Feature
{

    /**
     * @var \Bkoetsier\FeatureToggle\Features\Id
     */
    private $id;
    /**
     * @var
     */
    private $keys;
    /**
     * @var \Bkoetsier\FeatureToggle\Features\State
     */
    private $state;

    public function __construct(Id $id, FeatureCollection $keys, State $state)
    {
        $this->id = $id;
        $this->keys = $keys;
        $this->state = $state;
    }

    /**
     * @return \Bkoetsier\FeatureToggle\Features\Id
     */
    public function getId()
    {
        return $this->id;
    }

    public function getKeys()
    {
        return $this->keys->all();
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->state === State::ON;
    }
}
