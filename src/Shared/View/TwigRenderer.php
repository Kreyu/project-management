<?php

declare(strict_types=1);

namespace App\Shared\View;

use Twig\Environment;
use Twig\Error\Error as TwigError;

class TwigRenderer implements ViewRendererInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param  string $view
     * @param  array  $context
     *
     * @return string
     * @throws TwigError
     */
    public function render(string $view, array $context = []): string
    {
        return $this->twig->render($view, $context);
    }
}