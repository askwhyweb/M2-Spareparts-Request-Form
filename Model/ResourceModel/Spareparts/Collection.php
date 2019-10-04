<?php

namespace OrviSoft\SpareParts\Model\ResourceModel\Spareparts;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OrviSoft\SpareParts\Model\Spareparts', 'OrviSoft\SpareParts\Model\ResourceModel\Spareparts');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>