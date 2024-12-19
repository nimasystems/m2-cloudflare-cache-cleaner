<?php
/**
 * Copyright © Qoliber. All rights reserved.
 *
 * @category    Qoliber
 * @package     Qoliber_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qoliber.com
 */

namespace Qoliber\CloudFlareCache\Model\CloudFlare;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Qoliber\CloudFlareCache\Api\CloudFlare\CacheClientInterface;
use Qoliber\CloudFlareCache\Api\Data\ConfigInterface;

class CacheClient implements CacheClientInterface
{
    /** @var string  */
    const CONTENT_TYPE_APPLICATION_JSON = 'application/json';

    /** @var string  */
    const X_AUTH_EMAIL = 'X-Auth-Email: %s';

    /** @var string  */
    const X_AUTH_KEY = 'X-Auth-Key: %s';

    /** @var string  */
    const AUTHORIZATION_BEARER = 'Bearer %s';

    /** @var string  */
    const HEADERS = 'headers';

    protected Client $httpClient;

    protected ConfigInterface $config;

    /** @var array<string, string> */
    protected array $extraHeaders = [];

    public function getExtraHeaders(): array
    {
        return $this->extraHeaders;
    }

    public function setExtraHeaders(array $extraHeaders): void
    {
        $this->extraHeaders = $extraHeaders;
    }

    public function __construct(
        ConfigInterface $config,
        Client $httpClient
    ) {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function clearCache(string $jsonData): ResponseInterface
    {
        return $this->httpClient->post(
            $this->buildUrl(),
            [
                RequestOptions::HEADERS => $this->buildHeaders(),
                RequestOptions::JSON => (string) $jsonData
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function buildUrl(): string
    {
        return sprintf(self::CLOUD_FLARE_API, $this->config->getV4Zone());
    }

    /**
     * @inheritDoc
     */
    public function buildHeaders(): array
    {
        $headers['Content-Type'] = self::CONTENT_TYPE_APPLICATION_JSON;
        if ($this->config->getAuthType() == self::AUTH_TYPE_XTYPE) {
            $headers[self::X_AUTH_EMAIL] = sprintf(self::X_AUTH_EMAIL, $this->config->getXAuthEmail());
            $headers[self::X_AUTH_KEY] = sprintf(self::X_AUTH_KEY, $this->config->getXAuthKey());
        } elseif ($this->config->getAuthType() == self::AUTH_TYPE_BEARER) {
            $headers['Authorization'] = sprintf(self::AUTHORIZATION_BEARER, $this->config->getAuthBearer());
        }

        return $headers;
    }


    /**
     * @inheritDoc
     */
    public function purgeCfCache(): ResponseInterface
    {
        $json = json_encode(['purge_everything' => true]);
        return $this->clearCache(
             is_string($json) ? $json : '{}'
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCacheByTags(array $tags): ResponseInterface
    {
        $json = $this->prepareJSON($tags, 'tags');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCfCacheByFiles(array $files): ResponseInterface
    {
        $json = $this->prepareJSON($files, 'files');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCfCacheByHosts(array $hosts): ResponseInterface
    {
        $json = $this->prepareJSON($hosts, 'hosts');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCfCacheByPrefixes(array $prefixes): ResponseInterface
    {
        $json = $this->prepareJSON($prefixes, 'prefixes');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @param array<string> $data
     * @return string
     */
    public function prepareJSON(array $data, string $arrayKey)
    {
        if (($extraHeaders = $this->getExtraHeaders()) !== []) {
            $json = json_encode(
                [
                    $arrayKey => $data,
                    self::HEADERS => $extraHeaders
                ]
            );
        } else {
            $json = json_encode([
                $arrayKey => $data
            ]);
        }

        return is_string($json) ? $json : '{}';
    }
}
