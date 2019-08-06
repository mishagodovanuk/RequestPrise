<?php
namespace Smile\Customer\Controller\Adminhtml\RequestPrice;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Customer\Api\RequestRepositoryInterface;
use Smile\Customer\Model\RequestFactory;
use Smile\Customer\Model\Request;

/**
 * Class Save
 * @package Smile\Customer\Controller\Adminhtml\RequestPrice
 */
class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_Customer::customer_request_price_save';

    /**
     * Data persistor interface
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var RequestRepositoryInterface
     */
    private $requestRepository;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param RequestRepositoryInterface $requestRepository
     * @param RequestFactory $requestFactory
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        RequestRepositoryInterface $requestRepository,
        RequestFactory $requestFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->requestRepository = $requestRepository;
        $this->requestFactory = $requestFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $postObject = new DataObject();
            $postObject->setData($data);

            $id = $this->getRequest()->getParam('id');

            try {
                if (!$id) {
                    $data['id']= null;
                    $model = $this->requestFactory->create();
                } else {
                    if (!empty($data['answer_content'])) {
                        $data['status'] = Request::STATUS_CLOSED;
                        //place for send email logic
                    } elseif(empty($data['answer_content']) && $data['status'] == Request::STATUS_CLOSED ) {
                        $data['status'] = Request::STATUS_CHECKED;
                    }
                    $model = $this->requestRepository->getById($id);
                }

                $model->setData($data);
                $this->requestRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Your Answer save.'));
                $this->dataPersistor->clear('customer_request_price');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while save the request.'));
            }

            $this->dataPersistor->set('customer_request_price', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}
