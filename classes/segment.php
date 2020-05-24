<?php
require_once('db.php');

class Segment extends Dbh
{
    public function getAllSegments($moduleID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segment WHERE moduleID= :moduleID');
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $data = $q->fetchAll(); // returns array
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSegmentContent($segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segment WHERE segmentID= :segmentID');
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSegmentExercise($segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM exercise WHERE segmentID= :segmentID');
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
            $data = $q->fetch();
            echo json_encode($data);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
