<?php
namespace OrviSoft\SpareParts\Block\Adminhtml\Spareparts;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \OrviSoft\SpareParts\Model\sparepartsFactory
     */
    protected $_sparepartsFactory;

    /**
     * @var \OrviSoft\SpareParts\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \OrviSoft\SpareParts\Model\sparepartsFactory $sparepartsFactory
     * @param \OrviSoft\SpareParts\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \OrviSoft\SpareParts\Model\SparepartsFactory $SparepartsFactory,
        \OrviSoft\SpareParts\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_sparepartsFactory = $SparepartsFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_sparepartsFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'full_name',
					[
						'header' => __('Full Name'),
						'index' => 'full_name',
					]
				);
				
				$this->addColumn(
					'email',
					[
						'header' => __('Email'),
						'index' => 'email',
					]
				);
				
				$this->addColumn(
					'phone',
					[
						'header' => __('Phone'),
						'index' => 'phone',
					]
				);
				
				$this->addColumn(
					'address',
					[
						'header' => __('Address'),
						'index' => 'address',
					]
				);
				
				$this->addColumn(
					'model_number',
					[
						'header' => __('Model #'),
						'index' => 'model_number',
					]
				);
				
				$this->addColumn(
					'serial_number',
					[
						'header' => __('Serial #'),
						'index' => 'serial_number',
					]
				);
				
				$this->addColumn(
					'part_required',
					[
						'header' => __('Part(s) Required'),
						'index' => 'part_required',
					]
				);
				
				$this->addColumn(
					'comment',
					[
						'header' => __('Comments'),
						'index' => 'comment',
					]
				);
				
						
						$this->addColumn(
							'status',
							[
								'header' => __('Request Status'),
								'index' => 'status',
								'type' => 'options',
								'options' => \OrviSoft\SpareParts\Block\Adminhtml\Spareparts\Grid::getOptionArray8()
							]
						);
						
						


		
        $this->addColumn(
            'edit',
            [
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => [
                    [
                        'caption' => __('Edit'),
                        'url' => [
                            'base' => '*/*/edit'
                        ],
                        'field' => 'id'
                    ]
                ],
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            ]
        );
		

		
		   $this->addExportType($this->getUrl('spareparts/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('spareparts/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('OrviSoft_SpareParts::spareparts/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('spareparts');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('spareparts/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('spareparts/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('spareparts/*/index', ['_current' => true]);
    }

    /**
     * @param \OrviSoft\SpareParts\Model\spareparts|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'spareparts/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray8()
		{
            $data_array=array(); 
			$data_array[0]='Pending';
			$data_array[1]='Processing';
			$data_array[2]='Completed';
			$data_array[3]='Cancelled';
            return($data_array);
		}
		static public function getValueArray8()
		{
            $data_array=array();
			foreach(\OrviSoft\SpareParts\Block\Adminhtml\Spareparts\Grid::getOptionArray8() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}
