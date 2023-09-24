<?php

namespace Magedia\AccountManagement\Model\ResourceModel;

use Magedia\AccountManagement\Api\Data\AccountInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Account extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(AccountInterface::DB_NAME, AccountInterface::ID);
    }
}
