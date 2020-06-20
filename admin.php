<?php
include 'includes/autoloader.php';
include 'includes/calc-course-progress.php';
$deleteIcon = file_get_contents('assets/delete-button.svg');

session_start();

$userID = $_SESSION['userID'];

$classRoom = new ClassRoom();
$classRoomID = $classRoom->getClassRoom($userID);
$students = $classRoom->getStudentsByTeacher($userID);

$studentsHTML = '';

if ($students) {
    function compare($a, $b)
    {
        return strcmp($a->firstName, $b->firstName);
    }
    usort($students, "compare");

    foreach ($students as $student) {
        $studentProgress = calcCourseProgress($student->userID);
        $studentsHTML .=
            "<div class='div--studentRow'>
            <p class='p--sfName'>$student->firstName</p>
            <p class='p--slName'>$student->lastName</p>
            <p class='p--semail'>$student->email</p>
            <progress max='100' value='$studentProgress'></progress>
            <a onclick='deleteStudent($student->userID, $classRoomID)'>$deleteIcon</a>
        </div>";
    }
} else {
    $studentsHTML .=
        "<div class='div--emptyStudents'>
        No students in your classroom yet.
        </div>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <main class="main--adminWrapper">
        <?php
        require_once('components/navigation.php');
        ?>
        <section class="section--adminContent">
            <h1>Classroom Lounge</h1>

            <div class="div--backgroundWrapper">
                <form id="form--newStudent" method="POST" onsubmit="return false">
                    <label for="studentEmail">Add students to your classroom with their email address.</label>
                    <input name="studentEmail" type="text" placeholder="e.g. student@uni.com">
                    <button type="submit" onclick="addStudent(<?= $classRoomID ?>)">Add student</button>
                    <p id="pAddError"></p>
                </form>

                <h2>Your students</h2>

                <div class="div--studentWrapper">
                    <div class="div--studentHeaders">
                        <p>First name</p>
                        <p>Last name</p>
                        <p>Email</p>
                        <p>Course progress</p>
                    </div>
                    <?= $studentsHTML ?>
                </div>
            </div>
        </section>
    </main>
    <script src="js/admin.js"> </script>

</body>

</html>