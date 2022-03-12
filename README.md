## Клиент для работы с API DaData
![Packagist Version](https://img.shields.io/packagist/v/yzen.dev/php-dadata?color=blue&label=version)
![GitHub branch checks state](https://img.shields.io/github/checks-status/yzen-dev/php-dadata/master)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/yzen-dev/php-dadata/tests?label=tests)](https://github.com/yzen-dev/php-dadata/actions/workflows/tests.yml)
![Packagist Downloads](https://img.shields.io/packagist/dm/yzen.dev/php-dadata)
![Packagist Downloads](https://img.shields.io/packagist/dt/yzen.dev/php-dadata)

## :scroll: **Installation**
The package can be installed via composer:
```
composer require yzen.dev/php-dadata
```

## :scroll: **Usage**

1. Работы с почтовыми адресами и геокоординатами.
+ [Разбор адреса из строки («стандартизация»)](#CleanAddress)
+ [Подсказки по адресам](#SuggestAddress)
+ [Геокодирование (координаты по адресу)](#geocode)
+ [Обратное геокодирование (адрес по координатам)](#geolocate)
+ [Город по IP-адресу](#iplocate)
+ [Поиск адреса по коду КЛАДР или ФИАС](#findAddress)
+ [Кадастровый номер по КЛАДР или ФИАС](#cadastre)
+ [Поиск отделений Почта России](#postalUnit)
+ [Поиск стран](#country)

## Работы с почтовыми адресами и геокоординатами.
#### <a name="CleanAddress"></a>Разбор адреса из строки («стандартизация») [(Документация)](https://dadata.ru/api/clean/address/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->cleanAddress('мск сухонска 11/-89');
```

#### <a name="SuggestAddress"></a>Подсказки по адресам [(Документация)](https://dadata.ru/api/suggest/address/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->suggestionsAddress('москва хабар');
```

#### <a name="geocode"></a>Геокодирование (координаты по адресу) [(Документация)](https://dadata.ru/api/geocode/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->geocodeAddress('москва сухонская 11');
```

#### <a name="geolocate"></a>Обратное геокодирование (адрес по координатам) [(Документация)](https://dadata.ru/api/geolocate/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->geolocate('55.87', '37.653');
```

#### <a name="iplocate"></a>Город по IP-адресу [(Документация)](https://dadata.ru/api/iplocate/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->iplocate('46.226.227.20');
```

#### <a name="findAddress"></a>Поиск адреса по коду КЛАДР или ФИАС [(Документация)](https://dadata.ru/api/find-address/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->findByCode('9120b43f-2fae-4838-a144-85e43c2bfb29');
```

#### <a name="cadastre"></a>Кадастровый номер по КЛАДР или ФИАС [(Документация)](https://dadata.ru/api/cadastre/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->findByCadastre('9120b43f-2fae-4838-a144-85e43c2bfb29');
```

#### <a name="postalUnit"></a>Поиск отделений Почта России [(Документация)](https://dadata.ru/api/suggest/postal_unit/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->findPostUnit('дежнева 2а');
```

#### <a name="country"></a>Поиск стран [(Документация)](https://dadata.ru/api/suggest/country/)

```php
$dadata = new DaDataAddress($token, $secret);
$result = $dadata->suggestCountry('та');
```

