<?php namespace Bkoetsier\FeatureToggle\Features;

interface FeatureCollection extends \Countable
{

    public function add(Feature $feature);

    public function remove(Id $id);

    public function all();
}
