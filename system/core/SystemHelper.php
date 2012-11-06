<?php

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
          $trace = '';
          foreach($exception->getTrace() as $k => $v)
          if(!empty($v['line']) AND !empty($v['file']))
          $trace .= '<strong>Ligne : </strong>' . $v['line'] . ' <strong>du fichier : </strong> ' . $v['file'] . '<br />';

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
    function loadFile($filePath,$fileName,$app = TRUE,$sys = TRUE)
    {   
        $filePath  = (is_array($filePath)) ? implode('/',$filePath) : $filePath;
        $fileName .= (!strrchr($fileName,'.')) ? '.php' : NULL;
        $find = FALSE;
        
        if(file_exists(APP_DIR.'/'.$filePath.'/'.$fileName) && $app)
        {
            require_once APP_DIR.'/'.$filePath.'/'.$fileName;
            $find = TRUE;
        } 
        
        if(file_exists(SYS_DIR.'/'.$filePath.'/'.$fileName) && $sys)
        {
            require_once SYS_DIR.'/'.$filePath.'/'.$fileName;
            $find = TRUE;
        } 
        
        if(!$find)
        {
            throw new Exception("Fichier <em>".$filePath."/<b>".$fileName."</b></em> introuvable !");
        }
    }