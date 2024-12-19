<?php
/**
 * Copyright © Qoliber. All rights reserved.
 *
 * @category    Qoliber
 * @package     Qoliber_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qoliber.com
 */

namespace Qoliber\CloudFlareCache\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Qoliber\CloudFlareCache\Api\Data\ConfigInterface;

class Config implements ConfigInterface
{
    protected ScopeConfigInterface $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function getAuthType(): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XPATH_QOLIBER_CLOUDFLARECACHE_AUTH_TYPE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getXAuthEmail(): ?string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_QOLIBER_CLOUDFLARECACHE_XAUTH_EMAIL,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getXAuthKey(): ?string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_QOLIBER_CLOUDFLARECACHE_XAUTH_KEY,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getAuthBearer(): ?string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_QOLIBER_CLOUDFLARECACHE_AUTH_BEARER,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getV4Zone(): ?string
    {
        return $this->scopeConfig->getValue(
            self::XPATH_QOLIBER_CLOUDFLARECACHE_V_4_ZONE,
            ScopeInterface::SCOPE_STORE
        );
    }
}
