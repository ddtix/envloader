<?php

namespace Ddtix\Envloader;

class ENV
{
    /** @return array<mixed, mixed> */
    public static function load(string $path): array
    {
        $envFile = $path . '/../.env';

        if (!file_exists($envFile)) {
            throw new \Exception(".env file not found: $envFile");
        }

        $items = parse_ini_file($envFile);
        if ($items === false) {
            throw new \RuntimeException("Failed to parse .env file: $envFile");
        }

        self::fillenv($items);

        return $_ENV;
    }

    /** @param array<mixed, mixed> $items */
    private static function fillenv(array $items): void
    {
        foreach ($items as $key => $value) {
            if (!is_string($key) || !is_scalar($value)) {
                continue;
            }

            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}
