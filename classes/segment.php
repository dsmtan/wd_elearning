<?php
require_once('db.php');

class Segment extends Dbh
{
    public function getAllSegments()
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segment'); // all segments in entire course
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSegmentsByModule($moduleID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segment WHERE moduleID= :moduleID');
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSegmentContent($segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segment JOIN exercise ON segment.segmentID = exercise.segmentID WHERE exercise.segmentID= :segmentID');
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getExerciseByID($exerciseID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM exercise WHERE exerciseID= :exerciseID');
            $q->bindValue(':exerciseID', $exerciseID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
