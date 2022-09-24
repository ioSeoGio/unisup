<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%students}}`.
 */
class m210913_204208_create_students_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%students}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('ФИО студента'),

            'group_id' => $this->integer()->notNull()->comment('Группа студента'),
            'course_id' => $this->integer()->notNull()->comment('Курс студента'),

            'form_of_study' => $this->string()->comment('Форма обучения студента (дн.заоч.веч.)'),
            'form_of_payment' => $this->string()->comment('Платно/бюджет'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-students_group_id-groups_id',
            'students',
            'group_id',
            'groups',
            'id'
        );
        $this->addForeignKey(
            'FK-students_course_id-courses_id',
            'students',
            'course_id',
            'courses',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'FK-students_course_id-courses_id',
            'students'
        );
         $this->dropForeignKey(
            'FK-students_group_id-groups_id',
            'students'
        );
        $this->dropTable('{{%students}}');
    }
}
