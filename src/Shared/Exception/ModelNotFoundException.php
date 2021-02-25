<?php

declare(strict_types=1);

namespace App\Shared\Exception;

use Exception;

class ModelNotFoundException extends Exception
{
    private string $modelClass;

    /**
     * @param  class-string $modelClass
     */
    public function __construct(string $modelClass)
    {
        parent::__construct();

        $this->modelClass = $modelClass;
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}