<?php

declare(strict_types=1);

namespace Inndividuell\HideAdminActions;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HideAdminActionsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
