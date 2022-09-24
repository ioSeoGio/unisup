<?php declare(strict_types=1);

use yii\db\Migration;

class m220601_075552_add_teacher_id_column_to_users_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'teacher_id', $this->integer()->defaultValue(null));
        $this->addForeignKey(
            'FK-users_teacher_id-teachers_id',
            'users',
            'teacher_id',
            'users',
            'id'
        );
        $this->update('{{%users}}', [
            'teacher_id' => 1 
        ], ['username' => 'admin']);
    }

    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'teacher_id');
        $this->dropForeignKey(
            'FK-users_teacher_id-teachers_id',
            'users'
        );
    }
}
