<?php

namespace OrviSoft\SpareParts\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $jsonHelper;
    protected $messageManager;
    protected $model;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \OrviSoft\SpareParts\Model\Spareparts $_model
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->jsonHelper = $jsonHelper;
        $this->logger = $logger;
        parent::__construct($context);
        $this->messageManager = $messageManager;
        $this->model = $_model;
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $error = false;
        try {
            if (!\Zend_Validate::is(trim($post['full_name']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['phone']), 'NotEmpty')) {
                $error = true;
            }
            if (!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                $error = true;
            }
            if ($error) {
                throw new \Exception();
            }
            $this->model->setData($post)->save();
            $this->messageManager->addSuccess(__('The Spareparts request is successfully received.'));
            $html = '
				<style>
					.innertable td {border:1px solid;}
				</style>
				<center>
				<table width="100%" border="0" cellpadding="2" cellspacing="2" style="margin:0 auto">
				<tbody>
				<tr>
				<td>
				<table width="600" align="center">
				<tr>
				<td colspan="1" align="center">
				<a href="https://uk.store.asus.com/" target="_blank">
				<img src="https://uk.store.asus.com/pub/static/frontend/Asus/complete/en_GB/images/logo.png"/> </a>
				</td> 
				</tr>
				</table>
				</td>
				</tr>
				<tr>
				<td>
				<table width="600" align="center" cellpadding="5" cellspacing="5" class="innertable">
				<tr>
				<td align="center">
				<strong>If you cannot find a spare part you are looking for on our site then please complete the form below and we will get back to you with a price if it is available.</strong>
				</td>
				</tr>
				</table>
				</td>
				</tr>
				<tr>
				<td>
				<table width="600" border="0" cellspacing="5" cellpadding="5" align="center">
				  <tr>
					<td><label>Name:<span style="color: #ff0000;">*</span> </label></td>
					<td>'.$post['full_name'].'</td>
				  </tr>
				  <tr>
					<td><label>Email:<span style="color: #ff0000;">*</span> </label></td>
					<td>'.$post['email'].'</td>
				  </tr>
				  <tr>
					<td><label>Phone Number:<span style="color: #ff0000;">*</span> </label></td>
					<td>'.$post['phone'].'</td>
				  </tr>
				  <tr>
					<td><label>Address:<span style="color: #ff0000;">*</span> </label></td>
					<td>'.$post['address'].'</td>
				  </tr>
				  <tr>
					<td><label>Model Number:</label></td>
					<td>'.$post['model_number'].'</td>
				  </tr>
				  <tr>
					<td><label>Serial Number:</label></td>
					<td>'.$post['serial_number'].'</td>
				  </tr>
				  <tr>
					<td><label>Part Required:</label></td>
					<td>'.$post['part_required'].'</td>
				  </tr>
				  <tr>
					<td><label>Comments:</label></td>
					<td>'.$post['comment'].'</td>
				  </tr>
				</table>
				</td>
				</tr>
				</tbody>
				</table>
				</center>
			';
            $this->_redirect('asus-spare-parts-request-form');
            return;
        } catch (\Exception $e) {
            $this->messageManager->addError(
                __('We can\'t process your request right now. Sorry, that\'s all we know.')
            );
            $this->_redirect('asus-spare-parts-request-form');
            return;
        }
    }
}