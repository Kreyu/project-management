<?php

declare(strict_types=1);

namespace App\Shared\Slug;

use LogicException;
use Transliterator;

class IntlTransliteratorSlugGenerator implements SlugGeneratorInterface
{
    public function generate(string $subject, ?int $suffix = null): string
    {
        $transliterator = Transliterator::createFromRules(
            ':: Any-Latin;'
            . ':: NFD;'
            . ':: [:Nonspacing Mark:] Remove;'
            . ':: NFC;'
            . ':: [:Punctuation:] Remove;'
            . ':: Lower();'
            . '[:Separator:] > \'-\''
        );

        if (null === $transliterator) {
            throw new LogicException('Unable to create an instance of transliterator.');
        }

        $slug = $transliterator->transliterate(trim($subject));

        if (null !== $suffix) {
            $slug .= sprintf('-%d', $suffix);
        }

        return $slug;
    }
}