<?php namespace Bkoetsier\FeatureToggle;

use Bkoetsier\FeatureToggle\Features\Feature;
use Bkoetsier\FeatureToggle\Features\Id;

interface FeatureCollection extends \Countable
{

    public function add(Feature $feature);

    public function remove(Id $id);

    public function all();
}
