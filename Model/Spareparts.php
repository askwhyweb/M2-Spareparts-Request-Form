<?php
namespace OrviSoft\SpareParts\Model;

class Spareparts extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OrviSoft\SpareParts\Model\ResourceModel\Spareparts');
    }
}
?>