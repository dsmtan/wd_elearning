<?php
require_once('db.php');

class Module extends Dbh
{
    public function getAllModules()
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM module');
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getModuleTitle($moduleID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM module WHERE moduleID= :moduleID');
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $data = $q->fetch();
            return $data->title;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
