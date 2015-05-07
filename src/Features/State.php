<?php namespace Bkoetsier\FeatureToggle\Features;

class State {

    const ON = 1;
    const OFF = 0;

    private $state;

     function __construct($state)
     {
        if( ! in_array($state,[self::ON,self::OFF]))
        {
            throw new \InvalidArgumentException("Feature-State has to be 1 or 0");
        }
         $this->state = $state;
     }

    public function get()
    {
        return $this->state;
    }



}