# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2024

### Added
- CloudFlare API v4 integration for cache purging via Guzzle HTTP client
- Multiple authentication methods supporting X-Auth-Email/X-Auth-Key and Bearer token authorization
- Console command `qoliber:cloudflare:cache-clear` for CLI-based cache operations
- Granular cache purging supporting five distinct purge methods:
  - `purge_everything` - complete cache invalidation
  - `files` - purge specific URLs (max 30 per request due to CloudFlare limits)
  - `tags` - purge by cache tags
  - `hosts` - purge by hostname patterns
  - `prefixes` - purge by URL prefix patterns
- Admin configuration panel in Stores > Configuration > Qoliber > Cloud Flare Cache
- Configurable Zone ID selection for multi-zone CloudFlare accounts
- Custom HTTP header support for advanced cache purge requests
- ACL resource `Qoliber_CloudFlareCache::config` for admin permission control
- JSON-based request body preparation with automatic encoding
- PHP 8.1+ compatibility using constructor property promotion

### Technical Details
- Implements `CacheClientInterface` for extensibility and DI optimization
- Uses lazy proxy pattern for `CacheClient` in console commands
- Supports CloudFlare API endpoint: `https://api.cloudflare.com/client/v4/zones/{zone_id}/purge_cache`
- Validates authentication type before building request headers
- Returns `Psr\Http\Message\ResponseInterface` for response inspection
- Requires `guzzlehttp/guzzle` ^6.0.0 or ^7.0.0 and `qoliber/core` module
