<?php

namespace Ortnit\Json;

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
     * @throw JsonException
     * @return string
     */
    public static function encode($data): string
    {
        return json_encode($data, static::getOptionValue());
    }

    /**
     * function to decode json formatted strings to arrays
     *
     * @param string $content
     * @param bool $assoc
     *
     * @throw JsonException
     * @return mixed
     */
    public static function decode(string $content, bool $assoc = true)
    {
        $json = null;
        if (strlen($content) != 0) {
            $json = json_decode($content, $assoc, 512, static::getOptionValue());
        }

        return $json;
    }

    /**
     * helper function which will show the setup options as combined int
     *
     * @return int
     */
    public static function getOptionValue(): int
    {
        return array_reduce(static::$options, function (int $carry, int $value) {
            return $carry | $value;
        }, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array
     */
    public static function getOptions(): array
    {
        return static::$options;
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
