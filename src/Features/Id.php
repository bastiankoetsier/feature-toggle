<?php namespace Bkoetsier\FeatureToggle\Features;

class Id
{

    /**
     * @var string
     */
    private $id;

    public function __construct($id)
    {
        if (! is_string($id)) {
            throw new \InvalidArgumentException("Feature-ID has to be a string");
        }
        $this->id = $id;
    }

    public function get()
    {
        return $this->id;
    }
}
