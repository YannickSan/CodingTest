<?php
/**
 * Created by PhpStorm.
 * User: yannick
 * Date: 01/08/19
 * Time: 01:57
 */
namespace Test\Banner\Controller\Adminhtml\Testbanners;

use Test\Banner\Controller\Adminhtml\AbstractBanner;

class NewAction extends AbstractBanner
{
    /**
     * Create new banner
     *
     * @return void
     */
    public function execute()
    {
        // the same form is used to create and edit
        $this->_forward('edit');
    }
}