<?php
require_once('db.php');

class Achievement extends Dbh
{
    // userAchievements are added by triggers + stored procedure bc it's a requirement
    // public function addUserAchievement($userID, $achievementID)
    // {
    //     try {
    //         $db = $this->connectDB();
    //         $q = $db->prepare('INSERT INTO userachievement VALUES(:userID, :achievementID)');
    //         $q->bindValue(':userID', $userID);
    //         $q->bindValue(':achievementID', $achievementID);
    //         $q->execute();
    //         echo 'New achievement added. Rows: ' . $q->rowCount();
    //     } catch (PDOException $ex) {
    //         echo $ex;
    //     }
    // }

    public function getUserAchievement($userID, $achID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM userachievement WHERE userID= :userID AND achievementID= :achID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':achID', $achID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getUserAchievements($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM achievement JOIN userachievement ON achievement.achievementID = userachievement.achievementID WHERE userachievement.userID = :userID');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function markReadUserAchievement($userID, $achID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('UPDATE userachievement SET unread= false WHERE userID= :userID AND achievementID= :achID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':achID', $achID);
            $q->execute();
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
            $data = $q->fetchAll();
            return $data;
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
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
