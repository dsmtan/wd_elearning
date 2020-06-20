<?php
require_once('db.php');

class ClassRoom extends Dbh
{

    public function getClassRoom($teacherID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT classRoomID FROM classroom WHERE teacherID= :teacherID');
            $q->bindValue(':teacherID', $teacherID);
            $q->execute();
            $data = $q->fetch();
            return $data->classRoomID;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getStudentsByTeacher($teacherID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM user JOIN classroom ON classroom.classRoomID = user.classRoomID WHERE classroom.teacherID = :teacherID AND user.teacherAccess=0');
            $q->bindValue(':teacherID', $teacherID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function addStudentToClass($classRoomID, $studentEmail)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('UPDATE user SET classRoomID= :classRoomID WHERE email= :studentEmail AND teacherAccess=0');
            $q->bindValue(':classRoomID', $classRoomID);
            $q->bindValue(':studentEmail', $studentEmail);
            $q->execute();
            return $q->rowCount();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function removeStudentFromClass($classRoomID, $studentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('UPDATE user SET classRoomID= NULL WHERE userID= :studentID AND classRoomID= :classRoomID');
            $q->bindValue(':classRoomID', $classRoomID);
            $q->bindValue(':studentID', $studentID);
            $q->execute();
            return $q->rowCount();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
