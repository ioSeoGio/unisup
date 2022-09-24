<?php declare(strict_types=1);

namespace models;

use seog\db\ActiveRecordAdapter;
use yii\db\ActiveQueryInterface;

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

    public function getAuditoria(): ActiveQueryInterface
    {
        return $this->hasMany(Auditorium::class, ['auditorium_type_id' => 'id']);
    }
}
