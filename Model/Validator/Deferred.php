<?php
/**
 * Copyright (c) 2022. MageCloud.  All rights reserved.
 * @author: Volodymyr Hryvinskyi <mailto:volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\PageSpeedCssExtremeLazyLoad\Model\Validator;

use Hryvinskyi\PageSpeedApi\Api\Finder\Result\TagInterface;
use Hryvinskyi\PageSpeedCssExtremeLazyLoad\Model\Config;
use Hryvinskyi\PageSpeedCssExtremeLazyLoad\Model\ValidatorInterface;

class Deferred implements ValidatorInterface
{
    public const DEFERRED = 'deferred';
    public const DEFER = 'defer';
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function validate(TagInterface $style): bool
    {
        if ($this->config->isOnlyDeferred()) {
            $isDeferred = isset($style->getAttributes()[self::DEFERRED]) && $style->getAttributes()[self::DEFERRED] === 'true';
            $isDefer = isset($style->getAttributes()[self::DEFER]);
            return $isDefer || $isDeferred;
        }

        return true;
    }
}
