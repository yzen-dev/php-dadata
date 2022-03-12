<?php

namespace PhpDaData;

/**
 * Список ендпоинтов для обращения к ДаДата
 *
 * @link https://dadata.ru/api/#address
 * @author yzen.dev <yzen.dev@gmail.com>
 */
class MethodsEnum
{
    public const CLEAN_ADDRESS = 'https://cleaner.dadata.ru/api/v1/clean/address';

    public const SUGGEST_ADDRESS = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address';
    public const SUGGEST_GEO_LOCATE_ADDRESS = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/geolocate/address';
    public const SUGGEST_IP_ADDRESS = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address';
    public const SUGGEST_POST_UNIT = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/postal_unit';
    public const SUGGEST_COUNTRY = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/country';

    public const FIND_BY_CADASTRE = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/cadastre';
    public const FIND_BY_CODE = 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/address';
}
