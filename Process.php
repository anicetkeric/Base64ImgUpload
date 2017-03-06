<?php
/**
 * Created by PhpStorm.
 * User: ANICET ERIC KOUAME
 * Date: 05/03/2017
 * Time: 22:28
 */
require_once("DataManager.php");
//continue only if $_POST is set and it is a Ajax request
if(isset($_POST)){


$manager=new DataManager();
    $return=0;

    $return= $manager->insert_file($_POST["img"],$_POST["ex"]);
    if(intval($return)>0) echo $_POST["img"];
    else $return;
}