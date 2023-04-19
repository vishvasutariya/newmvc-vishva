<?php

class Block_Ajax_Test extends Block_Core_Templete
{
    public function __construct()
    {
        parent :: __construct();
        $this->setTemplete('ajax/test.phtml');
    }
}
