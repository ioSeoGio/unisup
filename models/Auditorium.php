<?php

namespace models;

use Yii;
use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

class Auditorium extends ActiveRecordAdapter
{
    public static function tableName()
    {
        return '{{%auditoriums}}';
    }

    public function rules()
    {
        return [
            [['auditorium'], 'required'],
            [['auditorium_type_id', 'size_auditorium'], 'default', 'value' => null],
            [['auditorium_type_id', 'size_auditorium'], 'integer'],
            [['auditorium'], 'string', 'max' => 255],
            [['auditorium_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuditoriumType::class, 'targetAttribute' => ['auditorium_type_id' => 'id']]
        ];
    }

    public function getAuditoriumType(): ActiveQueryInterface
    {
        return $this->hasOne(AuditoriumType::class, ['id' => 'auditorium_type_id']);
    }


    
    /**
     * @inheritdoc
     * @return \models\query\AuditoriumQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \models\query\AuditoriumQuery(get_called_class());
    }


}
