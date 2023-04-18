<?php

class Controller_Payment extends Controller_Core_Action
{
	 protected $payment = null;
	 protected $modelpayment = null;

	 public function setPayment($payment)
	 {
	 	 $this->payment = $payment;
	 	 return $this;
	 }

	 public function getPayment()
	 {
	 	 return $this->payment;
	 }

	 public function setModelPayment($modelpayment)
	 {
	 	 $this->modelpayment = $modelpayment;
	 	 return $this;
	 }

	 public function getModelPayment()
	 {
	 	 if ($this->modelpayment!=null)
	 	 {
	 	 	return $this->modelpayment;
	 	 }
	 	 $modelpayment = new Model_Payment();
	 	 $this->setModelPayment($modelpayment);
	 	 return $modelpayment;
	 }

	 public function gridAction()
	 {
	 	 try {
	 	 		$layout = $this->getLayout();
	 	 		$grid = new Block_Payment_Grid();

	 	 		$layout->getChild('content')->addChild('grid' , $grid);
	 	 		$grid->getCollection();
	 	 		$layout->render();
	 	 } catch (Exception $e) {
	 	 	$message = new Model_Core_Message();
	 	 	$message->addMessages("Data not found",Model_Core_Message::SUCCESS);
	 	    $this->redirect("index.php?a=grid&c=payment");

	 	 }
	 }

	 public function addAction()
	 {
	 	 try {
				$layout = $this->getLayout();
				$payment = Ccc::getModel('Payment');
				$add = $layout->createBlock('Payment_Edit')->setData(['payment'=>$payment]);

				 $layout->getChild('content')->addChild('add', $add);

				$layout->render();
		
	 	} catch (Exception $e) {
	 		$message = new Model_Core_Message();
	 	 $message->addMessages("Data not found..",Model_Core_Message::FAILURE);
	 	 $this->redirect("index.php?a=grid&c=payment");
	 	}
	 }

	 public function editAction()
	 {
	 	try {
				$request = $this->getRequest();
			$id=$request->getParam('payment_id');
			if(!$id)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$payment = Ccc::getModel('Payment');
			$query = "SELECT * FROM `payment` WHERE `payment_id`= '$id'";
			$payment =$payment->fetchRow($query);
			if(!$payment)
			{
				throw new Exception('invalid id', 1);
				
			}
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Payment_Edit');
			$edit->setData(['payment' => $payment]);
			$layout->getChild('content')->addChild('edit',$edit);

			$layout->render();
		
	 	} catch (Exception $e) {
	 		$message = new Model_Core_Message();
	 	 $message->addMessages("Data not found..",Model_Core_Message::FAILURE);
	 	 $this->redirect("index.php?a=grid&c=payment");
	 	}
	 }

	public function saveAction()
		{
			try {
				$row = Ccc::getModel('Payment');
					$request=$this->getRequest();
					if (!$request->isPost()){
				throw new Exception("Invalid Request", 1);
					}
					$payments = $request->getPost('payment');
					if (!$payments) {
						throw new Exception("Data not posted", 1);
					}
					$id = $request->getParam('payment_id');
					if(!$id){
						if(!$row->load($id)){
							throw new Exception("Data not found.", 1);
						}
					}
					$data = $row->setData($payments);
					if ($data->payment_id) {
						$data->update_at = date('Y-m-d h:i:sa');
					}
					else{
						$data->create_at = date('Y-m-d h:i:sa');
					}
					$data = $row->save();
					$message = new Model_Core_Message();
					$message->addMessages("Data saved successfully.",Model_Core_Message::SUCCESS);
				$this->redirect("index.php?a=grid&c=payment");
				
			} catch (Exception $e) {
				$message = new Model_Core_Message();
				$message->addMessages("Data not saved.",Model_Core_Message::FAILURE);
				$this->redirect("index.php?a=grid&c=payment");
			}
		}



	 public function deleteAction()
	 {
	 	try {
		$row = Ccc::getModel('Payment_Row');
	 	 $request = $this->getRequest();
	 	 if (!$request) {
	 	 	throw new Exception("Invalid Request", 1);
	 	 }
	 	 $id = $request->getParam('payment_id');
	 	 if (!$id) {
	 	 	throw new Exception("Id not found", 1);
	 	 }
	 	 $row->load($id);
	 	 $row->delete();
	 	 $message = new Model_Core_Message();
	 	 $message->addMessages("Row Delete successfully..",Model_Core_Message::SUCCESS);
	 	 $this->redirect("index.php?a=grid&c=payment");
	 	} catch (Exception $e) {
	 	 $message = new Model_Core_Message();
	 	 $message->addMessages("Row Not Delete ..",Model_Core_Message::FAILURE);
	 	 $this->redirect("index.php?a=grid&c=payment");
	 	}
	 }
}
?>