<?php
/**
 * Copyright © Qoliber. All rights reserved.
 *
 * @category    Qoliber
 * @package     Qoliber_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qoliber.com
 */

namespace Qoliber\CloudFlareCache\Api\Data;

interface ConfigInterface
{
    /** @var string */
    const XPATH_QOLIBER_CLOUDFLARECACHE_XAUTH_KEY = 'qoliber/cloudflarecache/xauth_key';

    /** @var string */
    const XPATH_QOLIBER_CLOUDFLARECACHE_XAUTH_EMAIL = 'qoliber/cloudflarecache/xauth_email';

    /** @var string */
    const XPATH_QOLIBER_CLOUDFLARECACHE_AUTH_BEARER = 'qoliber/cloudflarecache/auth_bearer';

    /** @var string */
    const XPATH_QOLIBER_CLOUDFLARECACHE_V_4_ZONE = 'qoliber/cloudflarecache/v4_zone';

    /** @var string */
    const XPATH_QOLIBER_CLOUDFLARECACHE_AUTH_TYPE = 'qoliber/cloudflarecache/auth_type';

    public function getAuthType(): int;

    public function getXAuthEmail(): ?string;

    public function getXAuthKey(): ?string;

    public function getAuthBearer(): ?string;

    public function getV4Zone(): ?string;
}
