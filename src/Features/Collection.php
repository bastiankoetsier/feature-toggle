<?php namespace Bkoetsier\FeatureToggle\Features;

use Bkoetsier\FeatureToggle\Exceptions\FeatureIdExistsException;

class Collection {

    private $features = [];

    /**
     * @param \Bkoetsier\FeatureToggle\Features\Feature $feature
     * @throws \Bkoetsier\FeatureToggle\Exceptions\FeatureIdExistsException
     */
    public function add(Feature $feature)
    {
        $this->guard($feature);
        $this->features[] = $feature;
    }

    /**
     * @param \Bkoetsier\FeatureToggle\Features\Feature $feature
     * @return bool
     * @throws \Bkoetsier\FeatureToggle\Exceptions\FeatureIdExistsException
     */
    protected function guard(Feature $feature)
    {
        /** @var Feature $f */
        foreach($this->features as $f){
            if($f->getId() == $feature->getId()){
                throw new FeatureIdExistsException("Feature-ID already exists in collection");
            }
        }
        return true;
    }

}