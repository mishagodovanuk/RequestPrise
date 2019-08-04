<?php
namespace Smile\Customer\Model\ResourceModel\Request;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Smile\Customer\Model\ResourceModel\Request
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize Model, ResourceModel
     */
    public function _construct()
    {
        $this->_init('Smile\Customer\Model\Request', 'Smile\Customer\Model\ResourceModel\Request');
    }
}
