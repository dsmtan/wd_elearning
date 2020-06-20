const addStudent = async (classRoomID) => {
  let url = `api/api-add-student.php?classID=${classRoomID}`;
  let oForm = document.querySelector("#form--newStudent");
  let jConnection = await fetch(url, {
    method: "POST",
    body: new FormData(oForm),
  });
  let studentData = await jConnection.text();

  if (studentData === "success") {
    location.reload();
  } else if (studentData === "alreadyAdded") {
    pAddError.innerHTML = "This student is already in your classroom.";
  } else if (studentData === "isTeacher") {
    pAddError.innerHTML = "You can't add a teacher.";
  } else {
    pAddError.innerHTML = "No user account found with this email.";
  }
};

const deleteStudent = async (studentID, classRoomID) => {
  let jConnection = await fetch(
    `api/api-delete-student.php?studentID=${studentID}&classID=${classRoomID}`
  );
  let studentData = await jConnection.text();
  if (studentData === "success") {
    location.reload();
  } else {
    console.log("couldn't delete student");
  }
};
