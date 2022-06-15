<?php
/**
 * Copyright (c) 2022. MageCloud.  All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\PageSpeedCssExtremeLazyLoad\Model;

use Hryvinskyi\PageSpeedCssExtremeLazyLoad\Api\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ConfigInterface
{
    /**
     * Configuration paths
     */
    public const XML_CONF_ENABLED = 'hryvinskyi_pagespeed/css/extreme_lazy_load/enabled';
    public const XML_CONF_ONLY_DEFERRED = 'hryvinskyi_pagespeed/css/extreme_lazy_load/only_deferred';
    public const XML_CONF_ENABLED_TIMEOUT = 'hryvinskyi_pagespeed/css/extreme_lazy_load/enabled_timeout';
    public const XML_CONF_TIMEOUT = 'hryvinskyi_pagespeed/css/extreme_lazy_load/timeout';
    public const XML_CONF_DELAY_EVENTS = 'hryvinskyi_pagespeed/css/extreme_lazy_load/delay_events';
    public const XML_CONF_EXCLUDE_BY_ATTRIBUTES = 'hryvinskyi_pagespeed/css/extreme_lazy_load/exclude_by_attributes';

    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritdoc
     */
    public function isEnabled($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_ENABLED, $scopeType, $scopeCode);
    }

    /**
     * @inheritdoc
     */
    public function isOnlyDeferred($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_ONLY_DEFERRED, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function isTimeOutEnabled($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONF_ENABLED_TIMEOUT, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function getTimeOut($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): int
    {
        return (int)$this->scopeConfig->getValue(self::XML_CONF_TIMEOUT, $scopeType, $scopeCode);
    }

    /**
     * @inheritDoc
     */
    public function getDelayEvents($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): array
    {
        return explode(',', (string)$this->scopeConfig->getValue(self::XML_CONF_DELAY_EVENTS, $scopeType, $scopeCode));
    }

    /**
     * @inheritDoc
     */
    public function getExcludeByAttributes($scopeCode = null, string $scopeType = ScopeInterface::SCOPE_STORE): array
    {
        return explode(
            ',',
            (string)$this->scopeConfig->getValue(self::XML_CONF_EXCLUDE_BY_ATTRIBUTES, $scopeType, $scopeCode)
        );
    }
}
