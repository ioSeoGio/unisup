<?php declare(strict_types=1);

use yii\db\Migration;
use domain\workReport\WorkReportLevel; 

class m220517_224033_create_methodical_work_reports_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%methodical_work_reports}}', [
            'id' => $this->primaryKey(),

            'description' => $this->text()->notNull(),
            'level' => $this->string()->notNull(),
            
            'type_id' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        
        $this->addForeignKey(
            'FK-methodical_work_reports_type_id-work_report_types_id',
            '{{%methodical_work_reports}}',
            'type_id',
            '{{%work_report_types}}',
            'id'
        );
        $this->batchInsert('{{%methodical_work_reports}}', ['description', 'level', 'type_id'], [

            ['Математический анализ (2014): учеб. пособие: в 4 ч. / Н.П. Семенчук, Н.Н. Сендер, С.А. Марзан, А. Н. Сендер, под общ. ред. Н.Н. Сендера ; Брест. гос. ун-т им. А. С. Пушкина. – Брест: БрГУ, 2020. – Ч. 3: Дифференциальное и интегральное исчисление функций многих переменных: в 2 кн. – кн. 1. – 226 с. (гриф Министерства образования Республики Беларусь)', WorkReportLevel::BREST, 1],
            ['Математический анализ: учеб. пособие: в 4 ч. / Н.П. Семенчук, Н.Н. Сендер, С.А. Марзан, А.Н. Сендер, под общ. ред. Н.Н. Сендера ; Брест. гос. ун-т им. А. С. Пушкина. – Брест: БрГУ, 2020. – Ч. 3: Дифференциальное и интегральное исчисление функций многих переменных: в 2 кн. – кн. 2. – 166 с. (гриф Министерства образования Республики Беларусь)', WorkReportLevel::BREST, 2],
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-methodical_work_reports_type_id-work_report_types_id',
            '{{%methodical_work_reports}}',
        );
        $this->dropTable('{{%methodical_work_reports}}');
    }
}
