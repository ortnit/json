![workflow badge](https://github.com/ortnit/json/actions/workflows/php.yml/badge.svg)

# Readme

Helper for php functions json_enconde() and json_decode(). JSON_THROW_ON_ERROR will always be applied,
so every error will be thrown as exception. Other flags can also be set, the configuration is static.

Per default Json::decode() will create assoc arrays, not objects, as the default behaviour from json_decode().

