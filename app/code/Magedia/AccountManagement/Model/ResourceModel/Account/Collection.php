<?php

namespace Magedia\AccountManagement\Model\ResourceModel\Account;

use Magedia\AccountManagement\Model\Account;
use Magedia\AccountManagement\Model\ResourceModel\Account as AccountResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected  function _construct()
    {
        $this->_init(Account::class, AccountResource::class);
    }
}
