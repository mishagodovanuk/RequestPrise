<?php
namespace Hodovanuk\Blog\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class CommentsActions
 * @package Hodovanuk\Blog\Ui\Component\Listing\Column
 */
class CommentsActions extends Column
{
    /**
     * Url path to answer page
     */
    const URL_PATH_ANSWER = 'hodovanuk_blog/comments/edit';

    /**
     * Url path to delete page
     */
    const URL_PATH_DELETE = 'hodovanuk_blog/comments/delete';

    /**
     * Url path to post form page
     */
    const URL_PATH_ADMIN_POST = 'hodovanuk_blog/post/form';

    /**
     * Url builder
     *
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactorys
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_ANSWER,
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Answer')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'id' => $item['id']
                                ]
                            ),
                            'label' => __('Delete')
                        ],
                        'form' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_ADMIN_POST,
                                [
                                    'id' => $item['post_id']
                                ]
                            ),
                            'label' => __('Post admin')
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}
