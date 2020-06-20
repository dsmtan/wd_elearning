<?php
require_once('db.php');

class UserProgress extends Dbh
{

    public function getModuleProgress($userID, $moduleID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM moduleprogress WHERE userID= :userID AND moduleID= :moduleID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getCompletedModulesByUser($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM moduleprogress WHERE userID= :userID AND completed= 1');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function getLatestModuleByUser($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM module JOIN moduleprogress ON module.moduleID = moduleprogress.moduleID WHERE moduleprogress.userID = :userID AND unlocked= 1 AND completed= 0 LIMIT 1');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getModuleProgressJoin($userID, $moduleID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare(
                'SELECT segment.segmentID, segment.moduleID, segmentprogress.userID, segmentprogress.completed
            FROM segment
            JOIN segmentprogress
            ON segment.segmentID = segmentprogress.segmentID
            WHERE userID= :userID AND moduleID= :moduleID AND completed=1'
            );
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function createModuleProgress($userID, $moduleID, $unlocked) // called when user is created
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO moduleprogress(userID, moduleID, unlocked) VALUES(:userID, :moduleID, :unlocked)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->bindValue(':unlocked', $unlocked);
            $q->execute();
            echo "Module progress $moduleID created for user $userID.\n";
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSegmentProgressByUser($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segmentprogress WHERE userID= :userID');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSegmentProgressByModule($userID, $moduleID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segmentprogress WHERE userID= :userID  AND segmentID IN 
            (SELECT segment.segmentID FROM segment WHERE moduleID= :moduleID)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function getSegmentProgress($userID, $segmentID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segmentprogress WHERE userID= :userID AND segmentID= :segmentID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':segmentID', $segmentID);
            $q->execute();
            $data = $q->fetch();
            echo json_encode($data);
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getCompletedSegmentsByUser($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM segmentprogress WHERE userID= :userID AND completed= true');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function createSegmentProgress($userID, $segmentID) // when user is created
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
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getPassedTestsByUser($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM usertestresult WHERE userID= :userID AND testScore > 79');
            $q->bindValue(':userID', $userID);
            $q->execute();
            $data = $q->fetchAll();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getTestResult($userID, $testID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM usertestresult WHERE userID= :userID AND testID= :testID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':testID', $testID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function getTestAnswer($userID, $questionID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM usertestanswer WHERE userID= :userID AND questionID= :questionID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':questionID', $questionID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function addTestAnswer($userID, $questionID, $answeredCorrect) // when user submits answer
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO usertestanswer VALUES(:userID, :questionID, :correct) ON DUPLICATE KEY UPDATE correct= :correct');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':questionID', $questionID);
            $q->bindValue(':correct', $answeredCorrect);
            $q->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function handleTestSubmission($userID, $testID)
    {
        try {
            $db = $this->connectDB();
            $db->beginTransaction();

            // CALCULATE TEST SCORE
            $q = $db->prepare('SELECT usertestanswer.questionID, usertestanswer.correct FROM usertestanswer
            JOIN testquestion
            ON usertestanswer.questionID = testquestion.questionID AND testquestion.testID = :testID
            WHERE usertestanswer.userID = :userID AND usertestanswer.correct = 1');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':testID', $testID);
            $q->execute();
            $data = $q->fetchAll();
            $testScore = (count($data) * 20);
            $q->closeCursor();

            // ADD TEST RESULT TO USERTESTRESULT
            $q = $db->prepare('INSERT INTO usertestresult VALUES(:userID, :testID, :testScore) ON DUPLICATE KEY UPDATE testScore= :testScore');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':testID', $testID);
            $q->bindValue(':testScore', $testScore);
            $q->execute();
            $db->commit();
            return $testScore;
        } catch (PDOException $ex) {
            $db->rollBack();
            echo $ex;
            exit();
        }
    }


    public function handlePassedTest($userID, $moduleID, $isLastModule)
    {
        try {
            $db = $this->connectDB();
            $db->beginTransaction();

            // COMPLETE MODULE
            $q = $db->prepare('UPDATE moduleprogress SET completed= true WHERE userID= :userID AND moduleID= :moduleID');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $q->closeCursor();

            if (!$isLastModule) {
                // UNLOCK NEXT MODULE
                $nextModuleID = strval($moduleID + 1);
                $q = $db->prepare('UPDATE moduleprogress SET unlocked= true WHERE userID= :userID AND moduleID= :moduleID');
                $q->bindValue(':userID', $userID);
                $q->bindValue(':moduleID', $nextModuleID);
                $q->execute();
                $q->closeCursor();
            }

            // COMPLETE ALL SEGMENTS IN MODULE (in case user skipped exercise)
            $q = $db->prepare('UPDATE segmentprogress SET completed= true WHERE userID= :userID AND segmentID IN 
            (SELECT segment.segmentID FROM segment WHERE moduleID= :moduleID)');
            $q->bindValue(':userID', $userID);
            $q->bindValue(':moduleID', $moduleID);
            $q->execute();
            $db->commit();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    // public function addTestResult($userID, $testID, $testScore)
    // {
    //     try {
    //         $db = $this->connectDB();
    //         $q = $db->prepare('INSERT INTO usertestresult VALUES(:userID, :testID, :testScore) ON DUPLICATE KEY UPDATE testScore= :testScore');
    //         $q->bindValue(':userID', $userID);
    //         $q->bindValue(':testID', $testID);
    //         $q->bindValue(':testScore', $testScore);
    //         $q->execute();
    //     } catch (PDOException $ex) {
    //         echo $ex;
    //     }
    // }


    // public function calculateTestScore($userID, $testID)
    // {
    //     try {
    //         $db = $this->connectDB();
    //         $q = $db->prepare('SELECT usertestanswer.questionID, usertestanswer.correct FROM usertestanswer
    //         JOIN testquestion
    //         ON usertestanswer.questionID = testquestion.questionID AND testquestion.testID = :testID
    //         WHERE usertestanswer.userID = :userID AND usertestanswer.correct = 1');
    //         $q->bindValue(':userID', $userID);
    //         $q->bindValue(':testID', $testID);
    //         $q->execute();
    //         $data = $q->fetchAll();
    //         $testScore = (count($data) * 20);
    //         return $testScore;
    //     } catch (PDOException $ex) {
    //         echo $ex;
    //     }
    // }

    // public function completeModule($userID, $moduleID)
    // {
    //     try {
    //         $db = $this->connectDB();
    //         $q = $db->prepare('UPDATE moduleprogress SET completed= true WHERE userID= :userID AND moduleID= :moduleID');
    //         $q->bindValue(':userID', $userID);
    //         $q->bindValue(':moduleID', $moduleID);
    //         $q->execute();
    //     } catch (PDOException $ex) {
    //         echo $ex;
    //     }
    // }

    // public function unlockModule($userID, $moduleID) // at end of the test
    // {
    //     try {
    //         $db = $this->connectDB();
    //         $q = $db->prepare('UPDATE moduleprogress SET unlocked= true WHERE userID= :userID AND moduleID= :moduleID');
    //         $q->bindValue(':userID', $userID);
    //         $q->bindValue(':moduleID', $moduleID);
    //         $q->execute();
    //     } catch (PDOException $ex) {
    //         echo $ex;
    //     }
    // }

    // public function completeAllSegments($userID, $moduleID)
    // {
    //     try {
    //         $db = $this->connectDB();
    //         $q = $db->prepare('UPDATE segmentprogress SET completed= true WHERE userID= :userID AND segmentID IN 
    //         (SELECT segment.segmentID FROM segment WHERE moduleID= :moduleID)');
    //         $q->bindValue(':userID', $userID);
    //         $q->bindValue(':moduleID', $moduleID);
    //         $q->execute();
    //     } catch (PDOException $ex) {
    //         echo $ex;
    //     }
    // }


}
