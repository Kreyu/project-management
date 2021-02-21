<?php

declare(strict_types=1);

namespace App\Shared\View;

interface ViewRendererInterface
{
    public function render(string $view, array $context = []): string;
}