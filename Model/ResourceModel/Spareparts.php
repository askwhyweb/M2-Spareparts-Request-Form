<?php
namespace OrviSoft\SpareParts\Model\ResourceModel;

class Spareparts extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('asus_spareparts', 'id');
    }
}
?>