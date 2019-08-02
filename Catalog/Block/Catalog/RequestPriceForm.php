<?php

/**
 * Class RequestPriceForm
 *
 * @category Smile
 * @author Mikhaylo Hodovanuk <mishagodovanuk@gmail.com>
 */
namespace Smile\Catalog\Block\Catalog;

use Magento\Framework\View\Element\Template;

/**
 * Class RequestPriceForm
 * @package Smile\Catalog\Block\Catalog
 */
class RequestPriceForm extends Template
{
    /**
     * Get form action
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('smile_customer/request/save');
    }
}
