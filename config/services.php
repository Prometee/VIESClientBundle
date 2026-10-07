<?php

declare(strict_types=1);

use Prometee\VIESClient\Helper\ViesHelper;
use Prometee\VIESClient\Soap\Client\DeferredViesSoapClient;
use Prometee\VIESClient\Soap\Client\ViesSoapClient;
use Prometee\VIESClient\Soap\Factory\ViesSoapClientFactory;
use Prometee\VIESClientBundle\Constraints\VatNumberValidator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(ViesSoapClientFactory::class)
        ->arg('$className', ViesSoapClient::class);

    $services->alias(ViesSoapClient::class, DeferredViesSoapClient::class)
        ->public();

    $services->set(DeferredViesSoapClient::class)
        ->public()
        ->arg('$viesSoapClientFactory', service(ViesSoapClientFactory::class));

    $services->set(ViesHelper::class)
        ->public()
        ->arg('$soapClient', service(DeferredViesSoapClient::class));

    $services->set(VatNumberValidator::class)
        ->arg('$helper', service(ViesHelper::class))
        ->tag('validator.constraint_validator');
};
