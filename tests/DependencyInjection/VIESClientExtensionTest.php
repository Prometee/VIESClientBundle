<?php

declare(strict_types=1);

namespace Tests\Prometee\VIESClientBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Prometee\VIESClient\Helper\ViesHelper;
use Prometee\VIESClient\Soap\Client\DeferredViesSoapClient;
use Prometee\VIESClient\Soap\Client\ViesSoapClient;
use Prometee\VIESClient\Soap\Factory\ViesSoapClientFactory;
use Prometee\VIESClientBundle\Constraints\VatNumberValidator;
use Prometee\VIESClientBundle\DependencyInjection\VIESClientExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class VIESClientExtensionTest extends TestCase
{
    public function testLoad(): void
    {
        $container = new ContainerBuilder();
        (new VIESClientExtension())->load([], $container);

        $factory = $container->getDefinition(ViesSoapClientFactory::class);
        self::assertSame(ViesSoapClient::class, $factory->getArgument('$className'));
        self::assertFalse($factory->isPublic());

        $alias = $container->getAlias(ViesSoapClient::class);
        self::assertSame(DeferredViesSoapClient::class, (string) $alias);
        self::assertTrue($alias->isPublic());

        $client = $container->getDefinition(DeferredViesSoapClient::class);
        self::assertTrue($client->isPublic());
        self::assertEquals(
            new Reference(ViesSoapClientFactory::class),
            $client->getArgument('$viesSoapClientFactory')
        );

        $helper = $container->getDefinition(ViesHelper::class);
        self::assertTrue($helper->isPublic());
        self::assertEquals(
            new Reference(DeferredViesSoapClient::class),
            $helper->getArgument('$soapClient')
        );

        $validator = $container->getDefinition(VatNumberValidator::class);
        self::assertFalse($validator->isPublic());
        self::assertEquals(new Reference(ViesHelper::class), $validator->getArgument('$helper'));
        self::assertSame([[]], $validator->getTag('validator.constraint_validator'));

        $container->compile();

        self::assertInstanceOf(ViesHelper::class, $container->get(ViesHelper::class));
        self::assertInstanceOf(DeferredViesSoapClient::class, $container->get(DeferredViesSoapClient::class));
        self::assertSame(
            $container->get(DeferredViesSoapClient::class),
            $container->get(ViesSoapClient::class)
        );
    }
}
