<?php

namespace src\helpers;

class TranslationMessageHelper
{
    public static function getTranslationPairs()
    {
        $messagePath = \Yii::getAlias('@message');

        $translations = [
            'uk-UA' => require $messagePath . DIRECTORY_SEPARATOR . 'uk-UA' . DIRECTORY_SEPARATOR . 'app.php',
            'ru-RU' => require $messagePath . DIRECTORY_SEPARATOR . 'ru-RU' . DIRECTORY_SEPARATOR . 'app.php',
        ];

        $originalMessages = [];
        foreach ($translations as $oneLanguageTranslations) {
            $originalMessages = array_merge(
                $originalMessages, 
                array_keys($oneLanguageTranslations)
            );
        }

        $return = [];
        foreach ($originalMessages as $originalMessage) {
            foreach ($translations as $language => $oneLanguageTranslations) {
                $return[$originalMessage][$language] = $oneLanguageTranslations[$originalMessage] ?? '';
            }
        }
        
        return $return;
    }
}
