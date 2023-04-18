<?php

/**
 * 
 */
class Controller_Eav_Attribute extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_Eav_Attribute_Grid();

		$layout->getChild('content')->addChild('grid', $grid);
		$attributes = $grid->getAttribute();
		$layout->render();

	}

	public function addAction()	
	{
		$message = Ccc::getModel('Core_Message');
		
	try{
		$attribute = Ccc::getModel('Eav_Attribute');
		if(!$attribute){
				throw new Exception("Invalid Id.", 1);
			}
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Eav_Attribute_Edit');
			$edit->setData(['attribute'=>$attribute]);
			$layout->getChild('content')
				->addChild('edit',$edit);
			$layout->render();
	}	
	catch (Exception $e) {
			$message->addMessages('Attribute not Saved',Model_Core_Message::FAILURE);
			$this->redirect("index.php?a=grid&c=eav_attribute");	
		
	}
	}

	public function editAction()
	{
		try {
		$request = $this->getRequest();
			$id =(int) $request->getParam('attribute_id');
			if (!$id)
			{
				throw new Exception("invalid id.", 1);
				
			}
			$modelEavAttribute = Ccc::getModel('Eav_Attribute');
			$attribute = $modelEavAttribute->load($id);
			if(!$attribute)
			{
				throw new Exception("data not found.", 1);
			}
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Eav_Attribute_Edit');
			$grid->setData(['attribute'=>$attribute]);
			$layout->getChild('content')->addChild('grid',$grid);
			$layout->render();
			
		} catch (Exception $e) {
			$message = new Model_Core_Message();
	 	 	$message->addMessages("Data not found",Model_Core_Message::SUCCESS);
			$this->redirect( null,'grid', null, true);
		}
	}

	public function saveAction()
		{
			try {
				
			$request = $this->getRequest();
			if (!$request->isPost())
			{
				throw new Exception("invalid Request.", 1);
			}
			$postData = $request->getPost('attribute');
			if(!$postData)
			{
				throw new Exception("no data posted.", 1);
			}
			$modelEavAttribute = Ccc::getModel('Eav_Attribute');
			$modelEavAttributeOption = Ccc::getModel('Eav_Attribute_Option');

			$options = $request->getPost('option');

			if($id =(int) $request->getParam('attribute_id'))
			{
				$attribute = $modelEavAttribute->load($id);
				$postData['attribute_id'] = $attribute->attribute_id;
				$savetAtribute = $modelEavAttribute->setData($postData)->save();
				if(!$savetAtribute)
				{
					throw new Exception("Attribute not saved", 1);
				}
				$sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = {$id}";
				$existOptions = $modelEavAttributeOption->fetchAll($sql);
				if($existOptions)
				{
					foreach ($existOptions->getData() as $option)
					{
						$existOption[$option->option_id] =  $option->name;
						if(isset($options['exist']))
						{
							foreach ($options['exist'] as $key => $value)
							{
								if($option->option_id == $key  && $option->name != $value)
								{
									$updateData['option_id'] = $key;
									$updateData['name'] = $value;
									$update = $modelEavAttributeOption->setData($updateData)->save(); 
									if(!$update)
									{
										throw new Exception("Attribute option not saved.", 1);
									}
								}
							}
						}
					}
					if(!$existOption && isset($options['exist']))
					{
						$deleteOptions = array_diff_key($existOption,$options['exist']);
						foreach ($deleteOptions as $optionId => $name)
						{	
							$delete = $modelEavAttributeOption->load($optionId)->delete();
							if (!$delete)
							{
								throw new Exception("Attribute option not deleted.", 1);
							}
						}
					}
					else
					{
						foreach ($existOption as $optionId => $name)
						{	
							$delete = $modelEavAttributeOption->load($optionId)->delete();
							if (!$delete)
							{
								throw new Exception("Attribute option not deleted.", 1);
							}
						}
					}																	
				}
				$newOption['attribute_id'] = $id;
			}
			else
			{
				$savetAtribute = $modelEavAttribute->setData($postData)->save();
				$newOption['attribute_id'] = $savetAtribute->attribute_id;
			}
			if(isset($options['new']))
			{
				foreach ($options['new'] as $key => $value)
				{
					$modelEavAttributeOption = Ccc::getModel('Eav_Attribute_Option');
					$newOption['name'] = $value;
					$save = $modelEavAttributeOption->setData($newOption)->save();
					if(!$save)
					{
						throw new Exception("new option not saved.", 1);
					}
				}
			}
			$message = new Model_Core_Message();
					$message->addMessages("Data saved successfully.",Model_Core_Message::SUCCESS);
					$this->redirect("index.php?a=grid&c=eav_attribute");

		}
		catch (Exception $e)
		{
			$message = new Model_Core_Message();
			$message->addMessages("Data not saved successfully.",Model_Core_Message::SUCCESS);
			$this->redirect("index.php?a=grid&c=eav_attribute");
		}

	}

	public function deleteAction()
	{
		$product = Ccc::getModel('eav_attribute');
				$request = $this->getRequest();
				if (!$request->isGet())
				{
					throw new Exception("Invalid request", 1);
				}
				$id = $request->getParam('attribute_id');
				if (!$id)
				{
					throw new Exception("id not found", 1);
				}
				$product->load($id);
				$product->delete();
		
		$message = new Model_Core_Message();
		$message->addMessages("Attribute delete successfully.",Model_Core_Message::SUCCESS);
		$this->redirect("index.php?a=grid&c=eav_attribute");

	}
}