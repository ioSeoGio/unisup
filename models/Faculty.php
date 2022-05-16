<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::class, ['faculty_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['faculty_id' => 'id']);
    }
}
