<?php

use yii\db\Migration;

use domain\workReports\WorkReportLevel; 

class m220517_173623_create_scientific_work_reports_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%scientific_work_reports}}', [
            'id' => $this->primaryKey(),

            'description' => $this->text()->notNull(),
            'level' => $this->string()->notNull(),
            
            'type_id' => $this->integer()->notNull(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        
        $this->addForeignKey(
            'FK-scientific_work_reports_type_id-work_report_types_id',
            '{{%scientific_work_reports}}',
            'type_id',
            '{{%work_report_types}}',
            'id'
        );

        $this->batchInsert('{{%scientific_work_reports}}', ['description', 'level', 'type_id'], [

            ['Сендер, А.Н. Карточка товара в системе управления товарами интернет-магазина / А.Н. Сендер, К.А. Гольчук // Математическое моделирование и новые образовательные технологии в математике: сб. тезисов. Респ. науч.-практ. конф., Брест, 23–24 апр. 2020 г. / Брест. гос. ун-т им. А.С. Пушкина; под общ. ред. А.И. Басика. – Брест: БрГУ, 2020. – С. 3.', WorkReportLevel::BREST, 1],
            ['Сендер, А.Н. Объектно-ориентированное программирование в PHP / Е.К. Пархоц, А.Н. Сендер // Математическое моделирование и новые образовательные технологии в математике: сб. тезисов. Респ. науч.-практ. конф., Брест, 23–24 апр. 2020 г. / Брест. гос. ун-т им. А. С. Пушкина; под общ. ред. А. И. Басика. – Брест: БрГУ, 2020. – С. 4.', WorkReportLevel::BREST, 2],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-educational_work_reports_type_id-work_report_types_id',
            '{{%scientific_work_reports}}',
        );
        $this->dropTable('{{%scientific_work_reports}}');
    }
}
