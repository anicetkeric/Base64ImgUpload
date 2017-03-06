<?php

/**
 * Created by PhpStorm.
 * User: ANICET ERIC KOUAME
 * Date: 20/01/2017
 * Time: 09:47
 *
 * This file is part of CORE API.
 *
 * CORE API is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 *
 */

require_once("Manager.php");

class DataManager extends Manager
{

    /**
     * @var Manager
     */
    private $_db;

    public function __construct() {
        try{
            $this->_db = parent::__construct();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }


    public function insert_file($img,$ex) {

        $sql = "INSERT INTO `file`(`image`, `ext`) VALUES (:image,:ext)";

        $requete= $this->_db->prepare($sql);
        $requete->bindValue(":image",$img);
        $requete->bindValue(":ext",  $ex);
        if($requete->execute()){

            return $this->_db->lastInsertId();

        }else{ return   null;}
    }




}