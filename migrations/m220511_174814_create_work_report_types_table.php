<?php declare(strict_types=1);

use yii\db\Migration;

use domain\workReport\WorkReportType;

class m220511_174814_create_work_report_types_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%work_report_types}}', [
            'id' => $this->primaryKey(),

            'serial_number' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            
            'foreign_points' => $this->integer(),
            'belarus_points' => $this->integer(),
            'brest_points' => $this->integer(),
        ]);
        $this->batchInsert('{{%work_report_types}}', ['serial_number', 'type', 'description', 'foreign_points', 'belarus_points', 'brest_points'], [

            [1, WorkReportType::SCIENTIFIC, 'Выкананне праграмы, па якой універсітэт з ’яўляецца галаўной арганізацыяй (на ўсіх выканаўцаў)', 60, 50, 30],
            [2, WorkReportType::SCIENTIFIC, 'Выкананне праекта па праграме ЕС па навуцы і інавацыях «Гарызонт 2020» , трансгранічнага супрацоўніцтва (на ўсіх выканаўцаў,)', 60, null, null],            

            [1, WorkReportType::METHODICAL, 'Удзел у міжнародных адукацыйных праектах, у якіх універсітэт выступае ў якасці каардынатара ці партнёра (на ўсіх удзельнікаў ад БрДУ)', 60, null, null],
            [5, WorkReportType::METHODICAL, 'Апублікаванне вучэбна-метадычных рэкамендацый, атласа-альбома, слоўніка, навукова-метадычнага даведніка, рабочага сшытку для практычных і лабараторных заняткаў у ВНУ (друкаванае выданне)', 5, 5, 5],            

            [1, WorkReportType::EDUCATIONAL, 'Распрацоўка лакальнага прававога акта па ІВП, зацверджанага ва ўстаноўленым парадку (на ўсіх распрацоўшчыкаў)', null, null, 7],
            [6, WorkReportType::EDUCATIONAL, "Кіраўніцтва (без аплаты) студэнцкім пастаянна дзеючым калектывам, аб'яднаннем: добраахвотніцкія атрады, групы; клубы па інтарэсах; краязнаўчая група, творчы калектыў, зборнай камандай і інш. (пры наяўнасці загада, распараджэння і вынікаў працы", null, null, 4],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_report_types}}');
    }
}
