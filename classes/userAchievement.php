<?php
require_once('db.php');

class UserAchievement extends Dbh
{
    public function addAchievement($userID, $achievementID)
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

    public function getAchievements($userID)
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
}
