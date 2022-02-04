<?php
declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('asset_url', [$this, 'getAssetUrl'])
        ];
    }

    public function getAssetUrl($path): string
    {
        return 'http://localhost:8002/' . $path;
    }
}