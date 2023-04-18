<?php
require_once 'Controller/Core/Action.php';
require_once 'Model/Salesman_price.php';
/**
*
*/
class Controller_Salesman_Price extends Controller_Core_Action
{
	protected $price=null;
	protected $salesman=null;
	protected $modelprice=null;

	public function setSalesman($salesman)
	{	
		$this->salesman = $salesman;
		return $this;
	}

	public function getSalesman()
	{
		return $this->salesman;
	}
	public function setPrice($price)
	{
		 $this->price = $price;
		 return $this;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setModelPrice($modelprice)
	{
		$this->modelprice = $modelprice;
		return $this;
	}

	public function getModelPrice()
	{
		if ($this->modelprice!=null)
		{
			return $this->modelprice;
		}
		$modelprice = new Model_Salesman_Price();
		$this->setModelPrice($modelprice);
		return $modelprice;
	}
	public function gridAction()
	{
		$request = $this->getRequest();
		if (!$request) {
			throw new Exception("Invalid Request", 1);
		}
	   $id=$this->getRequest()->getParam('salesman_id');
	   $sql= "SELECT * FROM `salesman` ORDER BY `fname` ASC";
	   $result = $this->getModelPrice()->fetchAll($sql);
	   $this->setPrice($result);
	   $sql1="SELECT sp.entity_id,p.name,p.product_id,p.sku,p.cost,p.price,sp.salesman_id,sp.salesman_price FROM `product`p LEFT JOIN `salesman_price`sp ON p.product_id= sp.product_id AND sp.salesman_id=$id"; 

	 $result1=$this->getModelPrice()->fetchAll($sql1);
	   $this->setSalesman($result1);
		 $this->getTemplete('salesman_price/grid.phtml');

	}
	public function updateAction()
	{
	 echo "<pre>";
	 $request=$this->getRequest();
	 if (!$request) {
	 	throw new Exception("Invalid Request", 1);
	 }
	 $id=$request->getParam('salesman_id');
	 $submit=$request->getPost('action');
	 $price=$request->getPost('sprice');
	 print_r($price);
	 if ($submit == 'update') {
	  foreach ($price as $key => $value)
	   {
	  $query="SELECT `entity_id` FROM `salesman_price` WHERE `product_id`=$key AND `salesman_id`=$id";
	  // print_r($query);
	  $result=$this->getModelPrice()->fetchAll($query);
	  if ($result) {
	  	$price['salesman_price'] = $value;
	  	print_r($price);
	  	$condition = ['product_id'=>$key, 'salesman_id'=>$id];
	  	$result = $this->getModelPrice()->update($price,$condition);
	  }else{
	  	if ($value!=null) {
	  		$price = ['product_id'=>$key, 'salesman_id'=>$id, 'salesman_price'=>$value];
			$result = $this->getModelPrice()->insert($price);
	  	}
	    }
	  }
	 }
	 if ($submit == 'delete') {
	$data=$request->getPost('deletep');
	foreach ($data as $key => $value) {
	$query = "DELETE FROM `salesman_price` WHERE `entity_id`= $key";
	$this->getmodelprice()->delete($query);
	}
	
	 }
	 // return $this->redirect("http://localhost/practice/new_project/Salesman_price.php?a=gridAction&salesman_id=$id");
	}
	 
	}
	 
	?>