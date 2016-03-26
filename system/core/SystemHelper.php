<?php

/*
 * Constantes nécessaires
 */
define('APP',1);
define('SYS',2);
define('ALL',3);

/*
 * APP/core/SystemHelper.php
 * Fonctions générales nécessaires au fonctionnement du système
 * ------------------------------------------------------------
 */
    
    /*
     * Attrape les exceptions & les affiche en stoppant l'exécution du système
     * $exception > Objet exception
     * Merci @SgtFatality, auteur de la fonction
     */
    function exception_handler($exception)
    {
        if(!DEBUG_MODE)
            exit('<script>alert(\'Une erreur est survenue, veuillez excuser la potentielle gêne occasionnée.\');</script>');
        
        $trace = '';
        foreach($exception->getTrace() as $k => $v)
        {
            if(!empty($v['line']) AND !empty($v['file']))
            {
                $function = !empty($v['function']) ? ' <strong> dans la fonction </strong>'. $v['function'] .'('. @implode(', ',$v['args']) .')' : '';
                $class = !empty($v['class']) ? ' <strong> de la classe</strong> '. $v['class'] : '';
                $trace .= '<strong>Ligne : </strong>' . $v['line'] . ' <strong>du fichier : </strong> ' . $v['file'] . $function . $class .'<br />';
            }
        }
        
        exit('<html lang="fr"><head><meta charset="utf-8" /> <title>Exception survenue</title > </head>
              <div style="background-color: #F6DDDD; border: 1px solid #FD1717; color: #8C2E0B; padding: 10px;">
              <h4>Une exception est survenue</h4>
              <strong>Message : </strong>' . $exception->getMessage() . '<br /><br />
              <strong>Ligne : </strong>' . $exception->getLine() . ' <strong>du fichier : </strong> ' . $exception->getFile() . '<br /><br />
              <strong>Appel : </strong><br /><pre>'
              . $trace .
              '</pre></div>
               </html>');
    }
    
    /*
     * Inclu tous les fichiers $fileName situés dans APP_DIR/$filePath ou SYS_DIR/$filePath
     * $app > Définit si on include le $fileName situé dans le dossier application
     * $sys > Définit si on include le $fileName situé dans le dossier système
     * $filePath > Chemin du fichier sous forme de chaîne ou de tableau, à partir de APP/SYS
     * $fileName > Nom du fichier,rajoute automatiquement l'extension .php s'il n'en possède pas
     */
    function loadFile($filePath,$fileName,$dirTarget = ALL,$globalVar = "undefined")
    {   
        $filePath  = (is_array($filePath)) ? implode('/',$filePath) : $filePath;
        $fileName .= (!strrchr($fileName,'.')) ? '.php' : NULL;
        $find = FALSE;
        global ${$globalVar};
        
        if(file_exists(APP_PATH.'/'.$filePath.'/'.$fileName) && ($dirTarget == APP || $dirTarget == ALL))
        {
            include APP_PATH.'/'.$filePath.'/'.$fileName;
            $find = TRUE;
        } 
        
        if(file_exists(SYS_PATH.'/'.$filePath.'/'.$fileName) && ($dirTarget == SYS || $dirTarget == ALL))
        {
            include SYS_PATH.'/'.$filePath.'/'.$fileName;
            $find = TRUE;
        } 
     
        if(!$find)
        { 
            throw new Exception("Fichier <em>".$filePath."/<b>".$fileName."</b></em> introuvable !");
        }
    }
    
    /* 
     * Renvoi la vrai ip de l'utilisateur, si derrière un proxy
     * @Author: http://roshanbh.com.np/2007/12/getting-real-ip-address-in-php.html
     */
    function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   // check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //t o check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }