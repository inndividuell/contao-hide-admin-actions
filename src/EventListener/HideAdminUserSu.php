<?php

declare(strict_types=1);

namespace Inndividuell\HideAdminActions\EventListener;

use Contao\Backend;
use Contao\BackendUser;
use Contao\CoreBundle\Exception\AccessDeniedException;
use Contao\DataContainer;
use Contao\Image;
use Contao\StringUtil;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;


class HideAdminUserSu
{
    public function __construct(
        private readonly Security $security
    ) {
    }

    public function __invoke(
        array $row,
        ?string $href,
        string $label,
        string $title,
        ?string $icon,
        string $attributes,
        string $table,
        array $rootRecordIds,
        ?array $childRecordIds,
        bool $circularReference,
        ?string $previous,
        ?string $next,
        DataContainer $dc
    ): string {
        if ($row['admin'] ?? null) {
            return '';
        }

        $user = $this->security->getUser();

        if (!$user instanceof BackendUser) {
            return '';
        }

        if($user->id == $row['id']){
            return '';
        }
        return ($user->isAdmin || !$row['admin']) ? '<a href="' . Backend::addToUrl($href . '&amp;id=' . $row['id']) . '" title="' . StringUtil::specialchars($title) . '"' . $attributes . '>' . Image::getHtml((string) $icon, $label) . '</a> ' : Image::getHtml(str_replace('.svg', '--disabled.svg', (string) $icon)) . ' ';
    }
}
