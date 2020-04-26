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
            echo 'New bookmark created';
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
            echo 'Deleted number of rows: ' . $q->rowCount();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
