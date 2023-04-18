<?php

class Model_Category extends Model_Core_Table
{
	function __construct()
	{
		 $this->setResourceClass('Model_Category_Resource');
	}

	public function getStatus()
	{
		if($this->status)
		{
			return $this->status; 
		}
		return Model_Category_Resource::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses))
		{
			return $statuses[$this->status];
		}
			return $statuses[ Model_Category_Resource::STATUS_DEFAULT];
	}

	public function updatePath()
	{
		echo "string";
		if(!$this->getId())
		{
			return false;
		}
		print_r($this->parent_id);
		$parent = Ccc::getModel('Category_Row')->load($this->parent_id);
		$oldPath = $this->path;
		print_r($oldPath);
		if(!$parent)
		{
			$this->path = $this->getId(); 
		}
		else
		{
			$this->path =$parent->path.'='.$this->getId(); 
		}
		$this->save();
		$query = "UPDATE `category`
		SET `path` = REPLACE(`path`,'{$oldPath}=','{$this->path}=')
		WHERE `path` LIKE '{$oldPath}=%';";
		$this->getResource()->getAdapter()->update($query);
		return $this;
	}

	public function getPathName()
	{
		$path = explode('=', $this->path);
		$query = "SELECT `category_id`,`name` FROM `category`;";
		$categoryArray = $this->getResource()->getAdapter()->fetchPairs($query);
		foreach ($path as $id2 => &$value)
		{
			foreach ($categoryArray as $key => $id)
			{
				if($value == $key)
				{
					$value = $id ;
				}
			}
		}
		return implode('=>', $path);
	}
}
?>