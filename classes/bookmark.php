<?php
require_once('db.php');

class Bookmark extends Dbh
{
    public function createBookmark($userID, $segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO bookmark VALUES(:userID, :segmentID)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function deleteBookmark($userID, $segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('DELETE FROM bookmark WHERE userID= :userID and segmentID= :segmentID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSingleBookmark($userID, $segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM bookmark WHERE userID= :userID AND segmentID= :segmentID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getBookmarks($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM bookmark WHERE userID= :userID');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
