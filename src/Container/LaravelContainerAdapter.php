<?php namespace Bkoetsier\FeatureToggle\Container;

use Bkoetsier\FeatureToggle\Exceptions\ServiceKeyMissingException;
use Illuminate\Contracts\Container\Container;

class LaravelContainerAdapter implements Adapter
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $id
     * @param $serviceInstance
     * @return bool
     */
    public function set($id, $serviceInstance)
    {
        $this->container->instance($id, $serviceInstance);
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function has($id)
    {
        return $this->container->bound($id);
    }

    /**
     * @param $id
     * @return object
     * @throws \Bkoetsier\FeatureToggle\Exceptions\ServiceKeyMissingException
     */
    public function get($id)
    {
        if (! $this->has($id)) {
            throw new ServiceKeyMissingException("Service with id ".$id." is not set in container");
        }
        return $this->container->make($id);
    }

    /**
     * returns the di-container-instance
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }
}