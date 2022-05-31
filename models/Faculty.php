<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Faculty extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%faculties}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function getDepartments(): ActiveQueryInterface
    {
        return $this->hasMany(Department::class, ['faculty_id' => 'id']);
    }

    public function getGroups(): ActiveQueryInterface
    {
        return $this->hasMany(Group::class, ['faculty_id' => 'id']);
    }
}
