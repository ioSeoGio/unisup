<?php

use app\parent\db\Migration;
use src\models\base\User;

class m200921_173432_create_table_users extends Migration
{
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(64)->notNull(),
            'email' => $this->string(64)->notNull(),
            'password_hash' => $this->string(64)->notNull(),
            'auth_key' => $this->string(64),
            'password_reset_token' => $this->string(64),
            'verification_token' => $this->string(64),

            'role' => $this->integer()->notNull()->defaultValue(User::ROLE_USER),
            'status' => $this->integer()->notNull()->defaultValue(User::STATUS_INACTIVE),

            'access_token' => $this->string(64)->notNull(),

            'created_at' => $this->timestamp()
                ->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Date and time of creating'),
        
            'updated_at' => $this->timestamp()
                ->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP')
                ->comment('Date and time of last updating'),
        ]);

        $this->insert('{{%user}}', [
            'username' => 'admin',
            //12345678
            'password_hash' => '$2y$13$F2g0DJS8xzflDVLQ7Yzsm.51FGx1bDLBYFO9hOoVX1vv9u7PH1VR.',
            'email' => 'admin@gmail.com',
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_ADMIN,
            'auth_key' => 'K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r',
            'access_token' => 'K1t9ek5Y5llzWcqee7G5lL2j9SR1Vj6r_1644828238',
        ]);
        $this->insert('{{%user}}', [
            'username' => 'moderator',
            //12345678
            'password_hash' => '$2y$13$F2g0DJS8xzflDVLQ7Yzsm.51FGx1bDLBYFO9hOoVX1vv9u7PH1VR.',
            'email' => 'moderator@gmail.com',
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_MODERATOR,
            'auth_key' => 'F17N0jZXg1u1by59O043wtwan_dJ7j-b',
            'access_token' => 'F17N0jZXg1u1by59O043wtwan_dJ7j-b_1644828238',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
