<?php

declare(strict_types=1);

namespace Prometee\VIESClientBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class VIESClientExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(dirname(__DIR__) . '/Resources/config')
        );
        $loader->load('services.yaml');
    }
}
