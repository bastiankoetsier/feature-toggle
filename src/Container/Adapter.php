<?php namespace Bkoetsier\FeatureToggle\Container;

interface Adapter
{
    /**
     * @param $id
     * @param $serviceInstance
     * @return bool
     */
    public function set($id, $serviceInstance);

    /**
     * @param $id
     * @return bool
     */
    public function has($id);

    /**
     * @param $id
     * @return object
     * @throws \Bkoetsier\FeatureToggle\Exceptions\ServiceKeyMissingException
     */
    public function get($id);

    /**
     * returns the di-container-instance
     * @return mixed
     */
    public function getContainer();
}
