<?php

namespace Smile\Customer\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Smile\Customer\Api\Data\RequestInterface;

/**
 * Class Request
 * @package Smile\Customer\Model
 */
class Request extends AbstractModel implements RequestInterface
{
    /**#@+
     * Request's Statuses
     */
    const STATUS_NEW = 1;
    const STATUS_CHECKED = 2;
    const STATUS_CLOSED = 3;
    /**#@-*/

    const CACHE_TAG = 'smile_customer_request_price';

    /**
     * @var string
     */
    public $cacheTag = 'smile_customer_request_price';

    /**
     * @var string
     */
    public $eventPrefix = 'smile_customer_request_price';

    /**
     * Initialize Resource Module
     */
    public function _construct()
    {
        $this->_init('Smile\Customer\Model\ResourceModel\Request');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get created date
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get Answer data
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Get product SKU
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return RequestInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RequestInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return RequestInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return RequestInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Set request status
     *
     * @param string $status
     *
     * @return RequestInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set creation date
     *
     * @param string $date
     *
     * @return RequestInterface
     */
    public function setCreatedDate($date)
    {
        return $this->setData(self::CREATED_AT, $date);
    }

    /**
     * Set Answer data
     *
     * @param string $answer
     *
     * @return RequestInterface
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Set product SKU
     *
     * @param string $sku
     *
     * @return RequestInterface
     */
    public function setSku($sku)
    {
        return $this->setData(self::PRODUCT_SKU, $sku);
    }

    /**
     * Get all answer statuses
     *
     * @return array
     */
    public function getAnswerStatuses()
    {
        return [
            self::STATUS_NEW => __('New'),
            self::STATUS_CHECKED => __('Checked'),
            self::STATUS_CLOSED => __('Closed')
        ];
    }
}
