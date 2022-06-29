<?php

declare(strict_types=1);

namespace App;

class Config
{
    private array $config;

    public const VIEW_PATH = __DIR__ . '/../views';

    public function __construct()
    {
        $this->config = [
            'db' => [
                'host' => 'localhost',
                'user' => 'root',
                'pwd' => 'aspirine13',
                'database' => 'framework',
            ]
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}