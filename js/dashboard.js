async function getUserData() {
  var jConnection = await fetch("api/api-get-user.php");
  var userData = await jConnection.json();

  spanIntroName.innerHTML = " " + userData.firstName;
  inputUserFirst.value = userData.firstName;
  inputUserLast.value = userData.lastName;
  inputUserEmail.value = userData.email;
  inputUserPassword.value = userData.password;
}

document.addEventListener("DOMContentLoaded", getUserData, false);

async function updateUser() {
  var url = "api/api-update-user.php";
  var oForm = document.querySelector("#form--userInfo");
  var jConnection = await fetch(url, {
    method: "POST",
    body: new FormData(oForm),
  });
  var jData = await jConnection.json();
  console.log(jData);
  // temporary
  alert("Your info has been updated.");
}

async function deleteUser() {
  console.log("delete");
  var jConnection = await fetch("api/api-delete-user.php");
  var userData = await jConnection.text();
  // temporary
  alert("Your account has been deleted.");
  window.location = "signup.php";
}
