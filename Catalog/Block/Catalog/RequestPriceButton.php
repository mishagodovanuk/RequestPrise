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

    /**
     * Get Request price form
     *
     * @return string
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getRequestPriceForm()
    {
        return $this->getLayout()
            ->createBlock("Smile\Catalog\Block\Catalog\RequestPriceForm")
            ->setTemplate('Smile_Catalog::request_price_form.phtml')
            ->toHtml();
    }
}
