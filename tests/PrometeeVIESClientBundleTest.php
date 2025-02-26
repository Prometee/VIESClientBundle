<?php

namespace Tests\Prometee\VIESClientBundle;

use PHPUnit\Framework\TestCase;
use Prometee\VIESClientBundle\VIESClientBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class PrometeeVIESClientBundleTest extends TestCase
{
    public function test__construct(): void
    {
        $bundle = new VIESClientBundle();

        $this->assertInstanceOf(Bundle::class, $bundle);
    }

    public function testGetPath(): void
    {
        $bundle = new VIESClientBundle();
        $this->assertEquals(dirname(__DIR__), $bundle->getPath());
    }
}
