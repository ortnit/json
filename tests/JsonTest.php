<?php

namespace Test;

use Ortnit\Json\Exception\JsonException;
use Ortnit\Json\Json;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testFailedJsonEncode()
    {
        $this->expectException(JsonException::class);
        $text = "\xB1\x31";
        Json::encode($text);
    }

    /*public function testSetOptions() {
        $options = [
            JSON_UNESCAPED_SLASHES,
            JSON_PRETTY_PRINT,
            JSON_PARSER_NOTSTRICT
        ];
        Json::setOptions(...$options);

    }*/

    /**
     * @throws JsonException
     */
    public function testJsonDecodeEmptyString()
    {
        $result = Json::decode('');
        $this->assertNull($result);
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function testJsonDecodeMalformed()
    {
        $this->expectException(JsonException::class);
        $json = 'foobar';
        Json::decode($json);
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function testJsonDecode()
    {
        $expectedResult = [
            'test' => 123,
            'foo' => 'bar',
        ];

        $json = "{\"test\":123,\"foo\":\"bar\"}";

        $result = Json::decode($json);

        $this->assertEquals($expectedResult, $result);
    }
}