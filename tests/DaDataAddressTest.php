<?php

namespace Tests;

use PhpDaData\DaDataAddress;
use PHPUnit\Framework\TestCase;
use PhpDaData\Exceptions\DaDataException;

/**
 * Class DaDataAddressTest
 *
 * @package Tests
 */
class DaDataAddressTest extends TestCase
{
    private string $token;
    private string $secret;

    protected function setUp():void
    {
        parent::setUp();
        putenv("token=6ea912e9b5afcbda6a0630a4c3c8af7843ebc1d5");
        putenv("secret=4be548780d741c5e027c0748a2636a6d939559ea");
        $this->token = getenv('token');
        $this->secret = getenv('secret');
    }

    public function testNotAuth(): void
    {
        $this->expectException(DaDataException::class);
        $dadata = new DaDataAddress('null', 'null');
        $dadata->cleanAddress('мск сухонска 11/-89');
    }

    public function testCleanAddress(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->cleanAddress('мск сухонска 11/-89');
        self::assertEquals('мск сухонска 11/-89', $result[0]['source']);
    }

    public function testSuggestionsAddress(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->suggestionsAddress('москва хабар');
        self::assertNotEmpty($result['suggestions']);
    }

    public function testGeocodeAddress(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->geocodeAddress('москва сухонская 11');
        self::assertEquals('москва сухонская 11', $result[0]['source']);
    }

    public function testGeolocate(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->geolocate('55.87', '37.653');
        self::assertNotEmpty($result['suggestions']);
    }

    public function testIplocate(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->iplocate('46.226.227.20');
        self::assertNotEmpty($result['location']);
    }

    public function testFindByCode(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->findByCode('9120b43f-2fae-4838-a144-85e43c2bfb29');
        self::assertNotEmpty($result['suggestions']);
    }

    public function testFindByCadastre(): void
    {
        $this->expectException(DaDataException::class);
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->findByCadastre('9120b43f-2fae-4838-a144-85e43c2bfb29');
        self::assertNotEmpty($result['suggestions']);
    }

    public function testFindPostUnit(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->findPostUnit('дежнева 2а');
        self::assertNotEmpty($result['suggestions']);
    }

    public function testSuggestCountry(): void
    {
        $dadata = new DaDataAddress($this->token, $this->secret);
        $result = $dadata->suggestCountry('та');
        self::assertNotEmpty($result['suggestions']);
    }
}
