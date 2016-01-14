<?php

namespace Timiki\Bundle\GeonamesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('geonames');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->variableNode('entity_manager')
                    ->defaultValue('default_entity_manager')
                ->end()
                ->variableNode('cities_population')
                    ->defaultValue('15000')
                ->end()
                ->variableNode('alternate_name_historic')
                    ->defaultValue(false)
                ->end()
            ->end()
        ;



        return $treeBuilder;
    }
}
