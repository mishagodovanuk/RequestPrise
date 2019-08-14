<?php

/**
 * Class RequestPriceButton
 *
 * @category Smile
 * @author Mikhaylo Hodovanuk <mishagodovanuk@gmail.com>
 */
namespace Smile\Catalog\Block\Catalog;

use Magento\Framework\View\Element\Template;

/**
 * Class RequestPriceButton
 * @package Smile\Catalog\Block\Catalog
 */
class RequestPriceButton extends Template
{

    /**
     * Get button label
     *
     * @return string
     */
    public function getButtonLabel()
    {
        return __('Request price');
    }
}
