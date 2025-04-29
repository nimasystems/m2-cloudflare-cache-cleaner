<?php
/**
 * Copyright © Qoliber. All rights reserved.
 *
 * @category    Qoliber
 * @package     Qoliber_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qoliber.com
 */

namespace Qoliber\CloudFlareCache\Api\CloudFlare;

use Psr\Http\Message\ResponseInterface;

interface CacheClientInterface
{
    /** @var string */
    public const CLOUD_FLARE_API = 'https://api.cloudflare.com/client/v4/zones/%s/purge_cache';

    /** @var int */
    public const AUTH_TYPE_XTYPE = 0;

    /** @var int */
    public const AUTH_TYPE_BEARER = 1;

    /**
     * @return array<string, string>
     */
    public function getExtraHeaders(): array;

    /**
     * @param array<string, string> $extraHeaders
     * @return void
     */
    public function setExtraHeaders(array $extraHeaders): void;

    public function buildUrl(): string;

    /**
     * @return array<string, string>
     */
    public function buildHeaders(): array;

    public function clearCache(string $jsonData): ResponseInterface;

    public function purgeCfCache(): ResponseInterface;

    /**
     * @param array<string> $tags
     * @return ResponseInterface
     */
    public function clearCacheByTags(array $tags): ResponseInterface;

    /**
     * @param array<string> $files
     * @return ResponseInterface
     */
    public function clearCfCacheByFiles(array $files): ResponseInterface;

    /**
     * @param array<string> $hosts
     * @return ResponseInterface
     */
    public function clearCfCacheByHosts(array $hosts): ResponseInterface;

    /**
     * @param array<string> $prefixes
     * @return ResponseInterface
     */
    public function clearCfCacheByPrefixes(array $prefixes): ResponseInterface;
}
