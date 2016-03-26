<?php
$json = file_get_contents('langs.json');
echo $json.'<br>';
var_dump(json_decode($json,true));