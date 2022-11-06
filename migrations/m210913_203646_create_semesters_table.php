<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%semesters}}`.
 */
class m210913_203646_create_semesters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%semesters}}', [
            'id' => $this->primaryKey(),

            'name' => $this->string()->notNull()->comment('Имя семестра (I/II)'),
            'course_name' => $this->string()->notNull()->comment('Имя курса (I/II/)'),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'FK-semesters_course_name-courses_name',
            '{{%semesters}}',
            'course_name',
            '{{%courses}}',
            'name'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%semesters}}');
    }
}
