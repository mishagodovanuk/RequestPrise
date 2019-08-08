<?php
namespace Smile\Catalog\Controller\Request;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Smile\Customer\Model\RequestFactory;
use Smile\Customer\Api\RequestRepositoryInterface;

class Save extends Action
{
    protected $requestFactory;

    protected $requestRepository;

    public function __construct(
        Context $context,
        RequestFactory $requestFactory,
        RequestRepositoryInterface $requestRepository
    )
    {
        $this->requestFactory = $requestFactory;
        $this->requestRepository = $requestRepository;
        parent::__construct($context);
    }
    /**
     * Request action
     *
     * @return void
     *
     * @throws \Exception
     */
    public function execute()
    {
        try{
            if ($this->getRequest()->isAjax()) {
                $data = $this->getRequest()->getParams();
                $model = $this->requestFactory->create();
                $model->setData($data);
                $model->setEmail($data['request_email']);
                $this->requestRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Your request has been saved'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
    }
}
