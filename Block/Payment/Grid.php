<?php

/**
 *
 */
class Block_Payment_Grid extends Block_Core_Grid
{
	
	

	function __construct()
	{
		parent::__construct();
		$this->setTitle('MANAGE PAYMENT METHOD');
	} 

	protected function _prepareColumns()
	{
		$this->addColumn('payment_id', [
			'title'=>'Payment Id'
		]);		
		$this->addColumn('name', [
			'title'=>'Name'
		]);		
		$this->addColumn('status', [
			'title'=>'Status'
		]);		
		$this->addColumn('create_at', [
			'title'=>'Created At'
		]);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addColumn('edit', [
			'title' => 'Edit',
			'method' => 'getEditUrl'
		]);		
		$this->addColumn('delete', [
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		]);	

		return parent::_prepareActions();	
	}


	protected function _prepareButtons()
	{
		$this->addButton('payment_id', [
			'title' => 'ADD PAYMENT',
			'url' => $this->getUrl(null, 'add')
		]);

		return parent::_prepareButtons();		
	}


	public function getPayments()
	{
		$query = "SELECT * FROM `payment`";
		$payments = Ccc::getModel('Payment')->fetchAll($query);
		return $payments->getData();
	}

	public function getCollection()
	{
		try {

		$query = "SELECT * FROM `payment`";
		$payments = Ccc::getModel("Payment")->fetchAll($query);

		return $payments;
		} catch (Exception $e) {
			$message = new Model_Core_Message();
			$message->addMessages("Data not found",Model_Core_Message::FAILURE);
			$this->redirect("index.php?a=grid&c=payment");
		}
	}
}