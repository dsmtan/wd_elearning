<?php
require_once('db.php');

class ModuleTest extends Dbh
{
    public function getTestByModule($moduleID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM moduletest WHERE moduleID= :moduleID');
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $data = $q->fetch(); // returns array
            return $data->testID;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getTestQuestions($testID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM testquestion WHERE testID= :testID');
            $q->bindValue(':testID', $testID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSingleQuestion($questionID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM testquestion WHERE questionID= :questionID');
            $q->bindValue(':questionID', $questionID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
