<?php

use helpers\TranslationMessageHelper;
use yiiseog\db\Migration;

class M211207144248CreateI18nTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%source_message}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(32)->notNull()->defaultValue('app'),
            'message' => $this->text()->unique(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date and time of creating'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date and time of last updating'),
        ]);
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'source_id' => $this->integer(),
            'language' => $this->string()->notNull(),
            'translation' => $this->text()->defaultValue(''),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date and time of creating'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date and time of last updating'),
        ]);
        $this->addForeignKey(
            'FK_message_id_source_message_id',
            '{{%message}}',
            'source_id',
            '{{%source_message}}',
            'id',
            'SET NULL',
            'SET NULL'
        );

        $translations = TranslationMessageHelper::getTranslationPairs();
        foreach ($translations as $message => $oneLanguageTranslations) {
            $sourceId = $this->insertWithReturningId('{{%source_message}}', [
                'message' => $message,
            ]);

            foreach ($oneLanguageTranslations as $language => $translation) {
                $this->insert('{{%message}}', [
                    'source_id' => $sourceId,
                    'translation' => $translation,

                    'language' => $language,
                ]);
            }
        }
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'FK_message_id_source_message_id',
            '{{%message}}'
        );
        $this->dropTable('{{%message}}');
        $this->dropTable('{{%source_message}}');
        return true;
    }
}
