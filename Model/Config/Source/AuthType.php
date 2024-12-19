<?php
/**
 * Copyright © Qoliber. All rights reserved.
 *
 * @category    Qoliber
 * @package     Qoliber_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qoliber.com
 */

namespace Qoliber\CloudFlareCache\Model\Config\Source;

class AuthType
{
    /**
     * Options getter
     *
     * @return array<int, array<string, int|string>>
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 1, 'label' => __('Authorization Bearer')],
            ['value' => 0, 'label' => __('X-Auth')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array<int, string>
     */
    public function toArray(): array
    {
        return [
            1 => __('Authorization Bearer'),
            0 => __('X-Auth')
        ];
    }
}
