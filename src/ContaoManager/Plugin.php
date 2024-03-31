<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Inndividuell\HideAdminActions\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerBundle\ContaoManagerBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use HWI\Bundle\OAuthBundle\HWIOAuthBundle;
use Inndividuell\HideAdminActions\InndividuellHideAdminActionsBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(InndividuellHideAdminActionsBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    ContaoManagerBundle::class,
                    HWIOAuthBundle::class,
                ]),
        ];
    }
}
