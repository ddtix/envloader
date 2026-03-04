<?php

namespace Ddtix\envloader;

class ENV
{
    public static function load(string $path): array
    {
        $envFile = rtrim($path, '/') . '/.env';

        if (!file_exists($envFile)) {
            throw new \Exception(".env file not found: $envFile");
        }

        return parse_ini_file($envFile);
    }
}
