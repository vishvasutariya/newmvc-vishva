<?php

/**
 * 
 */
class Model_Attribute extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL ='Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL ='Inactive';
	const STATUS_DEFAULT =2;

	protected $tablename = "eav_attribute";
	protected $primarykey = "attribute_id";

	 public function getStatusOptions()
	{
		return[
				self::STATUS_ACTIVE=>self::STATUS_ACTIVE_LBL,
				self::STATUS_INACTIVE=>self::STATUS_INACTIVE_LBL,
		];
	}
}