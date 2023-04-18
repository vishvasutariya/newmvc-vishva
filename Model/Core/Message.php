<?php
require_once 'Model\Core\Session.php';
/**
 * 
 */
class Model_Core_Message
{
	protected $session=null;
	const SUCCESS = 'success';
	const FAILURE = 'failure';
	const NOTICE = 'notice';

	public function __construct()
	{
		$this->getSession();
	}
	public function setSession(Model_Core_Session $session)
	{
		 $this->session = $session;
		 return $this;
	}

	public function getSession()
	{
		if ($this->session!=null) 
		{
			return $this->session;
		}
		$session = new Model_Core_Session();
		$this->setSession($session);
		return $session;
	}
	
	 public function addMessages($message,$type=self::SUCCESS)
	 {
	 	
	 	if (!$this->getSession()->has('message'))
	 	 {
	 		$this->getSession()->set('message',[]);
	 	}

	 	 $messages= $this->getMessages();
   	 	 $messages[$type]=$message;
	 	 $this->getSession()->set('message',$messages);
	 	 return $this;
	 	  
	 }

	 public function getMessages()
	 {
	 	if (!$this->getSession()->has('message')) 
	 	{
	 		return null;
	 	}
	 	return $this->getSession()->get('message');
	 }

	 public function cleanMessages()
	 {
	 	if (!$this->getSession()->has('message')) 
	 	{
	 		return null;
	 	}
	 	$this->getSession()->unSet('message');
	 	return $this;
	 }

	  
}


?>