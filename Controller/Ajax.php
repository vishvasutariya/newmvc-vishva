<?php

class Controller_Ajax extends Controller_Core_Action
{
    public function testAction()
    {
        $layout = $this->getLayout();
        $test = $layout->createBlock('Ajax_Test');
        $layout->getChild('content')->addChild('test',$test);
        $layout->render();
    }

    public function responceAction()
    {
        $post = $this->getRequest()->getPost(); 
        print_r($post);
        echo "successfully inserted";
    }
}

