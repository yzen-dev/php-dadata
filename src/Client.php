<?php

namespace PhpDaData;

use PhpDaData\Exceptions\DaDataException;

/**
 * Http client
 *
 * @author yzen.dev <yzen.dev@gmail.com>
 */
final class Client
{
    /**
     * @var string
     */
    private string $token;
    /**
     * @var string|null
     */
    private ?string $secret;

    /**
     * @param string $token
     * @param string|null $secret
     */
    public function __construct(string $token, ?string $secret = null)
    {
        $this->token = $token;
        $this->secret = $secret;
    }

    /**
     * @param string $url
     * @param array<mixed> $data
     *
     * @return array<mixed>
     * @throws DaDataException
     */
    public function post(string $url, array $data): array
    {
        return $this->call($url, 'POST', ['body' => $data]);
    }

    /**
     * @param string $url
     * @param array<mixed> $data
     *
     * @return array<mixed>
     * @throws DaDataException
     */
    public function get(string $url, array $data): array
    {
        return $this->call($url, 'GET', ['query' => $data]);
    }


    /**
     * @param string $url
     * @param string $method
     * @param array<mixed> $option
     *
     * @return array<mixed>
     * @throws DaDataException
     */
    public function call(string $url, string $method, array $option): array
    {
        $headers = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Token ' . $this->token,
        ];
        if ($this->secret !== null) {
            $headers[] = 'X-Secret: ' . $this->secret;
        }

        if (!empty($option['query'])) {
            $url .= '?' . http_build_query($option['query']);
        }
        $curl = curl_init($url);
        if (!$curl) {
            throw new \RuntimeException('сurl initialization error');
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($option['body']));
        }

        $result = curl_exec($curl);
        if (!$result) {
            throw new \RuntimeException('Failed execute curl request');
        }

        $result = json_decode((string)$result, true);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpStatus !== 200) {
            throw new DaDataException($result['message'], $httpStatus);
        }
        curl_close($curl);

        return $result;
    }
}
