<?php namespace Bkoetsier\FeatureToggle\Repository;

interface FeatureRepository
{
    /**
     * @return \Bkoetsier\FeatureToggle\Features\Collection
     */
    public function all();
}
