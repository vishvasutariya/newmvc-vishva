<?php

/**
 * 
 */
class Model_Core_Session
{
	public function getId()
	{
		return session_id();	
	}

	public function start()
	{
		if(session_status() == 1){
			session_start();
		}
		return $this;
	}

	public function destroy()
	{
		 session_destroy();
		 return $this;
	}

	public function set($key,$value)
	{
		$_SESSION[$key] = $value;
		return $this;
	}

	public function get($key)
	{
		if(!$this->has($key))
		{
			return null;
		}
		return $_SESSION[$key];
	}

	public function unset($key)
	{
		if($this->has($key))
		{
			unset($_SESSION[$key]);
		}
		return null;
	}

	public function has($key)
	{
		// var_dump(session_status());	
		$this->start();
		if (array_key_exists($key,$_SESSION)) 
		{
			return true;
		}
		return false;
	}


}
?>