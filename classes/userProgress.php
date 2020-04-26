<?php
require_once('db.php');

class UserProgress extends Dbh
{
    public function createModuleProgress($userID, $moduleID) // called when user is created
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO moduleprogress(userID, moduleID) VALUES(:userID, :moduleID)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            echo 'Module progress created. Rows: ' . $q->rowCount();
            // FIX ME: create trigger when testScore > 80 module is completed
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function completeModule($userID, $moduleID) // at end of the test
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('UPDATE moduleprogress SET completed= true WHERE userID= :userID AND moduleID= :moduleID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            echo 'Module is completed. Rows: ' . $q->rowCount();
            // FIX ME: trigger to unlock next module
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function unlockModule($userID, $moduleID) // at end of the test
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('UPDATE moduleprogress SET unlocked= true WHERE userID= :userID AND moduleID= :moduleID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            echo 'Module is unlocked. Rows: ' . $q->rowCount();
            // FIX ME: trigger to unlock next module
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function createSegmentProgress($userID, $segmentID) // called when user is created
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO segmentprogress(userID, segmentID) VALUES(:userID, :segmentID)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
            echo 'Segment progress created. Rows: ' . $q->rowCount();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function completeSegment($userID, $segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('UPDATE segmentprogress SET completed= true WHERE userID= :userID AND segmentID= :segmentID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
            echo 'New segment completed. Rows: ' . $q->rowCount();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function addTestResult($userID, $testID, $testScore) // when test is submitted and all questions answered
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO usertestresult VALUES(:userID, :testID, :testScore)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':testID', $testID);
            $q->bindValue(':testScore', $testScore);
            $q->execute();
            echo 'Module test finished. Rows: ' . $q->rowCount();
            // FIX ME: create trigger when testScore > 80 module is completed
            // FIX ME: add update function in case user has already done (and failed) test before
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function addTestAnswer($userID, $questionID, $answeredCorrect) // when user submits answer
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO usertestanswer VALUES(:userID, :questionID, :correct)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':questionID', $questionID);
            $q->bindValue(':correct', $answeredCorrect); // boolean
            $q->execute();
            echo 'TestAnswer saved. Rows: ' . $q->rowCount();
            // FIX ME: add update function in case user has already done (and failed) question before
            // REMINDER: answeredCorrect = true then add points to testTotal in frontend
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
