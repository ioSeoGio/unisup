<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;

class AuditoriumType extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%auditorium_types}}';
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
    public function getAuditoria()
    {
        return $this->hasMany(Auditorium::class, ['auditorium_type_id' => 'id']);
    }
}
