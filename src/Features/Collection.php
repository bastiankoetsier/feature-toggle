<?php namespace Bkoetsier\FeatureToggle\Features;

use Bkoetsier\FeatureToggle\Exceptions\FeatureIdExistsException;
use Bkoetsier\FeatureToggle\FeatureCollection;

class Collection implements FeatureCollection
{

    private $features = [];

    /**
     * @param \Bkoetsier\FeatureToggle\Features\Feature $feature
     * @return bool
     * @throws \Bkoetsier\FeatureToggle\Exceptions\FeatureIdExistsException
     */
    public function add(Feature $feature)
    {
        $this->guard($feature);
        $this->features[] = $feature;
        return true;
    }

    /**
     * @param \Bkoetsier\FeatureToggle\Features\Feature $feature
     * @return bool
     * @throws \Bkoetsier\FeatureToggle\Exceptions\FeatureIdExistsException
     */
    protected function guard(Feature $feature)
    {
        if ($this->has($feature->getId())) {
            throw new FeatureIdExistsException("Feature-ID already exists in collection");
        }
        return true;
    }

    /**
     * @param \Bkoetsier\FeatureToggle\Features\Id $id
     * @return bool
     */
    public function remove(Id $id)
    {
        /**
         * @var Feature $f
         */
        foreach ($this->features as $index => $f) {
            if ($f->getId()->get() == $id->get()) {
                unset($this->features[$index]);
                return true;
            }
        }
        return false;
    }

    /**
     * @param \Bkoetsier\FeatureToggle\Features\Id $id
     * @return bool
     */
    public function has(Id $id)
    {
        foreach ($this->features as $f) {
            /** @var Feature $f */
            if ($f->getId()->get() == $id->get()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->features;
    }

    /**
     * Count elements of an object
     * @return int The custom count as an integer.
     * The return value is cast to an integer.
     */
    public function count()
    {
        return (int) count($this->features);
    }
}
