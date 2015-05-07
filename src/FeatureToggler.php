<?php namespace Bkoetsier\FeatureToggle;

use Bkoetsier\FeatureToggle\Features\Id;

interface FeatureToggler
{

    public function disable(Id $id);

    public function enable(Id $id);

}