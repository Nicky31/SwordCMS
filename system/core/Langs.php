<?php

class Langs
{
    /*
     * Translations
     * $langs['sentance']['fr/en...'] = Translation
     */
    private static $translations = array(); 
    private static $lang         = NULL; 
    
    public static function loadTranslations()
    {
        self::$lang = (!empty($_SESSION['lang'])) ? $_SESSION['lang'] : 'fr';
        $langsContent = file_get_contents(APP_PATH.'/langs/langs.json');
        self::$translations = json_decode($langsContent,true);
    }
    
    public static function get($sentance)
    {
        if(!empty(self::$translations[$sentance][self::$lang]))
        {
            return self::$translations[$sentance][self::$lang];
        } else
        {
            return $sentance;
        }
    }
}