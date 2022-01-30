<?php

namespace Ortnit\Json;

use Ortnit\Json\Exception\JsonException;

/**
 * Class Json
 *
 * Class with better default settings and Exception based Error handling
 *
 */
class Json
{
    /**
     * preset options
     *
     * @var array
     */
    protected static array $options = [
        JSON_UNESCAPED_SLASHES,
        JSON_PRETTY_PRINT,
    ];

    /**
     * @param $data
     *
     * @return string
     * @throws JsonException
     */
    public static function encode($data): string
    {
        $json = json_encode($data, static::getOptions());
        if (json_last_error()) {
            throw new JsonException(json_last_error_msg(), json_last_error());
        }

        return $json;
    }

    /**
     * function to decode json formatted strings to arrays
     *
     * @param string $content
     * @param bool   $assoc
     *
     * @return mixed
     * @throws JsonException
     */
    public static function decode(string $content, bool $assoc = true)
    {
        $json = null;
        if (strlen($content) != 0) {
            $json = json_decode($content, $assoc);
            if (json_last_error()) {
                throw new JsonException(json_last_error_msg(), json_last_error());
            }
        }

        return $json;
    }

    /**
     * helper function which will show the setup options as combined int
     *
     * @return int
     */
    protected static function getOptions(): int
    {
        return array_reduce(static::$options, function (int $carry, int $value) {
            return $carry | $value;
        }, 0);
    }

    /**
     * overwrites options
     *
     * @param int ...$options
     */
    public static function setOptions(int ...$options): void
    {
        static::$options = [];
        foreach ($options as $option) {
            static::$options[] = $option;
        }
    }
}
