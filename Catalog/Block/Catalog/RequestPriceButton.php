<?php
namespace Smile\Catalog\Block\Catalog;

use Magento\Framework\View\Element\Template;

class RequestPriceButton extends Template
{

    public function getButtonLabel()
    {
        return __('Request price');
    }

}