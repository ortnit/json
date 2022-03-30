![workflow badge](https://github.com/ortnit/json/actions/workflows/php.yml/badge.svg)

# Readme

Helper for php functions json_enconde() and json_decode(). `JSON_THROW_ON_ERROR` will always be applied,
so every error will be thrown as exception. Other flags can also be set, the configuration is static.

Per default `Json::decode()` will create assoc arrays, not objects.

`Json::decode(string $json, bool $assoc = true)` will decode json and return the decoded structure

`Json::encode(mixed $value)` will encode the value and return the json string

`Json::setOptions(...$options)` allow you to set the JSON flags from the php documentation, 
https://www.php.net/manual/en/json.constants.php. Function will overwrite all flags.

`Json::getOptions()` will return the current options set