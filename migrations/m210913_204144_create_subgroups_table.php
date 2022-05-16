<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subgroups}}`.
 */
class m210913_204144_create_subgroups_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subgroups}}', [
            'id' => $this->primaryKey(),
            'discipline_id' => $this->integer()->notNull()->comment('Название предмета'),
            'teacher_id' => $this->integer()->notNull()->comment('Преподаватель'),
            'group_id' => $this->integer()->notNull()->comment('Номер учебной группы'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        
        $this->addForeignKey(
            'FK-subgroups_discipline_id-disciplines_id',
            'subgroups',
            'discipline_id',
            'disciplines',
            'id'
        );
        $this->addForeignKey(
            'FK-subgroups_teachers_id-teacher_id',
            'subgroups',
            'discipline_id',
            'teachers',
            'id'
        );
        $this->addForeignKey(
            'FK-subgroups_group_id-groups_id',
            'subgroups',
            'discipline_id',
            'groups',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-subgroups_group_id-groups_id',
            'subgroups',
        );
        $this->dropForeignKey(
            'FK-subgroups_teachers_id-teacher_id',
            'subgroups',
        );
        $this->dropForeignKey(
            'FK-subgroups_discipline_id-disciplines_id',
            'subgroups',
        );
        $this->dropTable('{{%subgroups}}');
    }
}
