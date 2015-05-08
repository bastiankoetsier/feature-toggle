<?php namespace Bkoetsier\FeatureToggle\Container;

use Bkoetsier\FeatureToggle\Exceptions\ServiceKeyMissingException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SymfonyContainerAdapter implements Adapter
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param $id
     * @param $serviceInstance
     * @return bool
     * @throws \Bkoetsier\FeatureToggle\Exceptions\ServiceKeyMissingException
     */
    public function set($id, $serviceInstance)
    {
        return $this->container->set($id, $serviceInstance);
    }

    /**
     * @param $id
     * @return bool
     */
    public function has($id)
    {
        return $this->container->has($id);
    }

    /**
     * @param $id
     * @return object
     * @throws \Bkoetsier\FeatureToggle\Exceptions\ServiceKeyMissingException
     */
    public function get($id)
    {
        if (! $this->container->has($id)) {
            throw new ServiceKeyMissingException("Service with id ".$id." is not set in container");
        }
        return $this->container->get($id);
    }
}
