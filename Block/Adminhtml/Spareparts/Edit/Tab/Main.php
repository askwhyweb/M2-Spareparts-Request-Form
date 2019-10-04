<?php

namespace OrviSoft\SpareParts\Block\Adminhtml\Spareparts\Edit\Tab;

/**
 * Spareparts edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \OrviSoft\SpareParts\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \OrviSoft\SpareParts\Model\Status $status,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \OrviSoft\SpareParts\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('spareparts');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

		
        $fieldset->addField(
            'full_name',
            'text',
            [
                'name' => 'full_name',
                'label' => __('Full Name'),
                'title' => __('Full Name'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'phone',
            'text',
            [
                'name' => 'phone',
                'label' => __('Phone'),
                'title' => __('Phone'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'address',
            'text',
            [
                'name' => 'address',
                'label' => __('Address'),
                'title' => __('Address'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'model_number',
            'text',
            [
                'name' => 'model_number',
                'label' => __('Model #'),
                'title' => __('Model #'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'serial_number',
            'text',
            [
                'name' => 'serial_number',
                'label' => __('Serial #'),
                'title' => __('Serial #'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'part_required',
            'text',
            [
                'name' => 'part_required',
                'label' => __('Part(s) Required'),
                'title' => __('Part(s) Required'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'comment',
            'textarea',
            [
                'name' => 'comment',
                'label' => __('Comments'),
                'title' => __('Comments'),
				
                'disabled' => $isElementDisabled
            ]
        );
									
						
        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Request Status'),
                'title' => __('Request Status'),
                'name' => 'status',
				
                'options' => \OrviSoft\SpareParts\Block\Adminhtml\Spareparts\Grid::getOptionArray8(),
                'disabled' => $isElementDisabled
            ]
        );
						
						

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
