<?php namespace Bkoetsier\FeatureToggle\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Builder implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('features');
        $rootNode
                ->prototype('array')
                    ->children()
                           ->scalarNode('id')
                                ->isRequired()
                            ->end()
                            ->arrayNode('serviceIds')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('idOld')->isRequired()->end()
                                        ->scalarNode('idNew')->isRequired()->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->booleanNode('state')
                                ->isRequired()
                                ->defaultFalse()
                            ->end()
                    ->end()
                ->end()
            ->end();
        return $treeBuilder;
    }
}
