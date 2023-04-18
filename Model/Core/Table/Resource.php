<?php

class Model_Core_Table_Resource
{
	protected $tablename = null;
	protected $primarykey = null;
	protected $adapter= null;

	public function setAdapter($adapter)
	{
		$this->adapter=$adapter;
		return $this;
	}
	
	public function getAdapter()
	{
		 if ($this->adapter) 
		 {
		 	return $this->adapter;
		 }
		 $adapter=new Model_Core_Adapter();
		 $this->setAdapter($adapter);
		 return $adapter;
	}

	public function getPrimaryKey()
	{
		return $this->primarykey;
	}

	public function setPrimaryKey($primarykey)
	{
		$this->primarykey = $primarykey;
		return $this;
	}

	public function getTableName()
	{
		return $this->tablename;
	}

	public function setTableName($tablename)
	{
		$this->tablename=$tablename;
		return $this;
	}


	public function fetchAll($query=null)
	{
		$adapter=$this->getAdapter();

		if ($query == null) 
		{
			 $query="SELECT * FROM `{$this->getTableName()}`";
			$result=$adapter->fetchAll($query);
		}
		else{
			$result=$adapter->fetchAll($query);
		}
		return $result;
	}

	public function fetchRow($query=null)
	{
		$adapter=$this->getAdapter();

		if ($query==null)
		 {
			 $query="SELECT * FROM `{$this->tablename}` WHERE `{$this->primarykey}`='$id'";  
			$result=$adapter->fetchRow($query);
		}
		else
		{
			$result=$adapter->fetchRow($query);
		}
		return $result; 
	}

	public function insert($data)
	{
		 $key="`".implode("`,`",array_keys($data))."`";
		 $value="'".implode("','",array_values($data))."'";

		$query="INSERT INTO `{$this->tablename}` ({$key}) VALUES ({$value})";

		 return $this->getAdapter()->insert($query);
		  
	}

	public function update($data,$condition)
	{
		$where=[];
		if (is_array($data)) 
		{
			foreach ($data as $key => $value) 
			{
				$where[]="`$key`='$value'";

			}
		}
		$conditions=[];
		if (is_array($condition))
		 {
			 foreach ($condition as $key => $value) 
			 {
			 	 $conditions[]="`{$key}`='{$value}'";
			 }
			 $query="UPDATE `{$this->tablename}` SET". implode(',',$where)."WHERE".implode('AND', $conditions); 
		}
		else
		{
		 $query="UPDATE `{$this->tablename}` SET". implode(',',$where)."
		WHERE `{$this->getPrimaryKey()}`='{$condition}'";  
		}
		$this->getAdapter()->update($query);
	}


	public function delete($condition)
	{
		 $query="DELETE FROM `{$this->tablename}` WHERE  `{$this->getPrimaryKey()}`='{$condition}'";
			 $this->getAdapter()->delete($query);
		 
	}

	public function load($id)
	{
		$adapter = $this->getAdapter();
		 $query = "SELECT * FROM `{$this->tablename}` WHERE `{$this->primarykey}` = '{$id}' ";
		return $this->getAdapter()->fetchRow($query);
	}

	
	 
}
?>