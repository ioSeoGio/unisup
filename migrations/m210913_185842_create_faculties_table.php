<?php declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%faculties}}`.
 */
class m210913_185842_create_faculties_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%faculties}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название факультета'),
            
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        
        $this->batchInsert('faculties', ['name'], [
            ['Естествознания'],
            ['Филологический'],
            ['Юридический'],
            ['Исторический'],
            ['Физико-математический'],
            ['Иностранных языков'],
            ['Физического воспитания и туризма'],
            ['Психолого-педагогический'],
            ['Социально-педагогический'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%faculties}}');
    }
}
