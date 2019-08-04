<?php
namespace Smile\Customer\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Request
 * @package Smile\Customer\Model\ResourceModel
 */
class Request extends AbstractDb
{
    /**
     * Initialize table
     */
    public function _construct()
    {
        $this->_init('smile_customer_request_price', 'id');
    }
}
