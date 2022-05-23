<?php

namespace seog\db;

use domain\common\ArrayableInterface;
use helpers\Formatter;
use yii\db\ActiveRecord as BaseActiveRecord;
use yii\behaviors\TimestampBehavior;


abstract class ActiveRecordAdapter extends BaseActiveRecord implements ArrayableInterface
{
    public function asArray(): array
    {
        return $this->attributes;
    }

    public function behaviors()
    {
        return [
           'timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => function() {
                    return Formatter::currentDateTime();
                }
            ],
        ];
    }

    /**
     * Additional fiels to display relations
     * By default adds all related records to return in rest controller
     * WARNING You should declare corresponding properties in AR class
     * Use ActiveQuery::with() to get related methods
     *
     * @return array $fields
    */
    // public function fields()
    // {
    //     $fields = parent::fields();
        
    //     // dd($this->relatedRecords);
    //     $fields['related'] = function () {
    //         return $this->relatedRecords;
    //     };
        
    //     return $fields;
    // }
}
