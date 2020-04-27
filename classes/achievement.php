<?php
require_once('db.php');

class Achievement extends Dbh
{
    public function addUserAchievement($userID, $achievementID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO userachievement VALUES(:userID, :achievementID)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':achievementID', $achievementID);
            $q->execute();
            echo 'New achievement added. Rows: ' . $q->rowCount();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getUserAchievements($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM userachievement WHERE userID= :userID');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetchAll(); // returns array
            print_r($data);
            echo 'Fetched achievements. Rows: ' . $q->rowCount();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getAllAchievements()
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM achievement');
            $q->execute();
            $data = $q->fetchAll(); // returns array
            print_r($data);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getAchievement($achievementID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM achievement WHERE achievementID= :achievementID');
            $q->bindValue(':achievementID', $achievementID);
            $q->execute();
            $data = $q->fetch(); // returns array
            echo json_encode($data);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
