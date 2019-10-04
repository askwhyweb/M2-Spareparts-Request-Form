<?php
namespace OrviSoft\SpareParts\Block\Adminhtml\Spareparts\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('spareparts_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Spareparts Information'));
    }
}