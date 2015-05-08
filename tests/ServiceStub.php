<?php namespace Bkoetsier\FeatureToggle\Tests;

class ServiceStub
{

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}