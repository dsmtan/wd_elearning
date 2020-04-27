<?php
require_once('db.php');

class Segment extends Dbh
{
    public function getAllSegments()
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segment');
            $q->execute();
            $data = $q->fetchAll(); // returns array
            print_r($data);
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
            echo json_encode($data);
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
