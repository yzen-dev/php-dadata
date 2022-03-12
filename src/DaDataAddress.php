<?php

namespace PhpDaData;

/**
 * Клиент API DaData для работы с почтовыми адресами и геокоординатами.
 *
 * @link https://dadata.ru/api/#address
 * @author yzen.dev <yzen.dev@gmail.com>
 */
final class DaDataAddress
{
    /** @var Client $client */
    private Client $client;

    /**
     * @param string $token
     * @param string|null $secret
     */
    public function __construct(string $token, ?string $secret = null)
    {
        $this->client = new Client($token, $secret);
    }

    /**
     * Стандартизация адреса
     *
     * @param string $address Адрес
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     * @link https://dadata.ru/api/clean/address/
     */
    public function cleanAddress(string $address): array
    {
        return $this->client->post(MethodsEnum::CLEAN_ADDRESS, [$address]);
    }

    /**
     * Подсказки по адресам
     *
     * @link https://dadata.ru/api/suggest/address/
     *
     * @param string $address Адрес
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     */
    public function suggestionsAddress(string $address): array
    {
        return $this->client->post(MethodsEnum::SUGGEST_ADDRESS, ['query' => $address]);
    }

    /**
     * Геокодирование (координаты по адресу)
     *
     * @link https://dadata.ru/api/geocode/
     *
     * @param string $address Адрес
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     */
    public function geocodeAddress(string $address): array
    {
        return $this->client->post(MethodsEnum::CLEAN_ADDRESS, [$address]);
    }

    /**
     * Обратное геокодирование (адрес по координатам)
     *
     * @param string $lat Широта
     * @param string $lon Долгота
     * @param int $radiusMeters Радиус поиска в метрах
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     * @link https://dadata.ru/api/geolocate/
     */
    public function geolocate(string $lat, string $lon, int $radiusMeters = 100): array
    {
        return $this->client->get(MethodsEnum::SUGGEST_GEO_LOCATE_ADDRESS, ['lat' => $lat, 'lon' => $lon, 'radius_meters' => $radiusMeters]);
    }

    /**
     * Город по IP-адресу
     *
     * @param string $ip
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     * @link https://dadata.ru/api/iplocate/
     */
    public function iplocate(string $ip): array
    {
        return $this->client->get(MethodsEnum::SUGGEST_IP_ADDRESS, ['ip' => $ip]);
    }

    /**
     * Поиск адреса по коду КЛАДР или ФИАС
     *
     * @param string $code Код КЛАДР или ФИАС
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     * @link https://dadata.ru/api/find-address/
     */
    public function findByCode(string $code): array
    {
        return $this->client->post(MethodsEnum::FIND_BY_CODE, ['query' => $code]);
    }

    /**
     * Кадастровый номер по КЛАДР или ФИАС
     *
     * @param string $code Код КЛАДР или ФИАС
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     * @link https://dadata.ru/api/cadastre/
     */
    public function findByCadastre(string $code): array
    {
        return $this->client->post(MethodsEnum::FIND_BY_CADASTRE, ['query' => $code]);
    }

    /**
     * Поиск отделений Почта России
     *
     * @param string $address
     *
     * @return array<mixed>
     * @throws Exceptions\DaDataException
     * @link https://dadata.ru/api/suggest/postal_unit/
     */
    public function findPostUnit(string $address): array
    {
        return $this->client->post(MethodsEnum::SUGGEST_POST_UNIT, ['query' => $address]);
    }

    /**
     * Поиск стран
     *
     * @param string $country
     *
     * @return array<mixed>
     *
     * @throws Exceptions\DaDataException
     * @link https://dadata.ru/api/suggest/country/
     */
    public function suggestCountry(string $country): array
    {
        return $this->client->post(MethodsEnum::SUGGEST_COUNTRY, ['query' => $country]);
    }
}
