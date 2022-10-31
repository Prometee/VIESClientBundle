<?php

declare(strict_types=1);

namespace Prometee\VIESClientBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VIESClientBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname($this->path);
    }
}
