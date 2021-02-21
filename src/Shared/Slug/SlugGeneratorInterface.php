<?php

declare(strict_types=1);

namespace App\Shared\Slug;

interface SlugGeneratorInterface
{
    /**
     * @param  string   $subject String to generate the slug from
     * @param  null|int $suffix  Optional suffix to ensure uniqueness, e.g. "my-slug" should become "my-slug-1"
     *
     * @return string
     */
    public function generate(string $subject, ?int $suffix = null): string;
}