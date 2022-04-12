<?php

namespace seog\db;

use yii\db\ActiveRecord as BaseActiveRecord;
use domain\common\ArrayableInterface;

abstract class ActiveRecordAdapter extends BaseActiveRecord implements ArrayableInterface 
{
	public function asArray(): array
	{
		return $this->attributes;
	}
}
