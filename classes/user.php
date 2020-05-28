<?php
require_once('db.php');

class User extends Dbh
{

    public function createUser($firstName, $lastName, $email, $password)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('INSERT INTO user(firstName, lastName, email, password) VALUES(:firstName, :lastName, :email, :password)');
            $q->bindValue(':firstName', $firstName);
            $q->bindValue(':lastName', $lastName);
            $q->bindValue(':email', $email);
            $q->bindValue(':password', $password);
            $q->execute();
            echo 'New userID: ' . $db->lastInsertId();
            // FIX ME: create moduleprogress for each module when user is created
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function updateUser($userID, $updatedUser)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare("UPDATE user SET  firstName = :firstName, lastName = :lastName, email = :email, password = :password WHERE userID= :id");
            $q->bindValue(':firstName', $updatedUser->firstName);
            $q->bindValue(':lastName', $updatedUser->lastName);
            $q->bindValue(':email', $updatedUser->email);
            $q->bindValue(':password', $updatedUser->password);
            $q->bindValue(':id', $userID);
            $q->execute();
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function deleteUser($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('DELETE FROM user WHERE userID= :id');
            $q->bindValue(':id', $userID);
            $data = $q->execute();
            echo $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }

    public function getSingleUser($userID)
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM user WHERE userID= :id');
            $q->bindValue(':id', $userID);
            $q->execute();
            $data = $q->fetch();
            return $data;
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function getAllUsers()
    {
        try {
            $db = $this->connectDB();
            $q = $db->prepare('SELECT * FROM user');
            $q->execute();
            $data = $q->fetchAll(); // returns array
            print_r($data);
            // while ($row = $q->fetch()) {
            //     echo "<p>$row->firstName </p>";
            //     echo json_encode($row);
            // }
        } catch (PDOException $ex) {
            echo $ex;
        }
    }


    public function loginUser($email)
    {
        try {
            $db = $this->connectDB();

            $q = $db->prepare('SELECT * FROM user WHERE email= :email');
            $q->bindValue(':email', $email);
            $q->execute();
            while ($row = $q->fetch()) {

                echo json_encode($row->userID);

                if ($_POST["userPassword"] == $row->password  && $_POST["userEmail"] == $row->email) {
                    // Start session with stored userID
                    session_start();
                    $_SESSION['userID'] = $row->userID;
                    header('Location: ../index.php');
                    exit();
                } else if ($_POST["userPassword"] != $row->password) {
                    echo "wrong password";
                } else {
                    echo "wrong password or email";
                }
            }
        } catch (PDOException $ex) {
            echo $ex;
        }
    }
}
