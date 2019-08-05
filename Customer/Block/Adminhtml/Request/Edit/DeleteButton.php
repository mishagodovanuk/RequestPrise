<?php

/**
 * DeleteButton.php
 *
 * Delete button
 *
 * @category   Smile
 * @package    Smile\Customer
 * @author     Mikhaylo Hodovanuk <mishahodovanuk@gmail.com>
 */
namespace Smile\Customer\Block\Adminhtml\Request\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package Smile\Customer\Block\Adminhtml\Request\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getRequestId()) {
            $data = [
                'label' => __('Delete Request'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Do you want delete this request?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 30,
            ];
        }

        return $data;
    }

    /**
     * Get URL FOR delete button
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getRequestId()]);
    }
}
