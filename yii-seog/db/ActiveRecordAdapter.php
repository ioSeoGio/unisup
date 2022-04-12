<?php

namespace seog\db;

use yii\db\ActiveRecord as BaseActiveRecord;
use src\ArrayableInterface;

abstract class ActiveRecordAdapter extends BaseActiveRecord implements ArrayableInterface 
{
	public function asArray(): array
	{
		return $this->attributes;
	}
}
