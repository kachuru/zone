<?php

declare(strict_types=1);

namespace Kachuru\Zone\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ZoneExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $locator = new FileLocator(__DIR__.'/../../../../config');

        $loader = new YamlFileLoader($container, $locator);
        $loader->load('services.yaml');
    }
}
