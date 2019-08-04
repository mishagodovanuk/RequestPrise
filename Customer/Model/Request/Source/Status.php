<?php
namespace Hodovanuk\Blog\Model\Comments\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Hodovanuk\Blog\Model\Comment;

/**
 * Class Status
 * @package Hodovanuk\Blog\Model\Comments\Source
 */
class Status implements OptionSourceInterface
{
    /**
     * @var Comment
     */
    private $commentStatus;

    /**
     * Status constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->commentStatus = $comment;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->commentStatus->getAnswerStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}
