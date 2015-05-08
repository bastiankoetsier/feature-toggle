<?php namespace Bkoetsier\FeatureToggle\Features;

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

    public function __construct(Id $id, array $keys, State $state)
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
        return $this->keys;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->state->get() === State::ON;
    }

    /**
     * @return \Bkoetsier\FeatureToggle\Features\State
     */
    public function getState()
    {
        return $this->state;
    }
}
