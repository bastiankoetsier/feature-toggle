<?php namespace Bkoetsier\FeatureToggle\Features;

class State
{
    const ON = 1;
    const OFF = 0;

    /**
     * @var int
     */
    private $state;

    public function __construct($state)
    {
        if ($state !== self::ON && $state !== self::OFF) {
            throw new \InvalidArgumentException("Feature-State has to be 1 or 0");
        }
        $this->state = $state;
    }

    public function get()
    {
        return $this->state;
    }
}
