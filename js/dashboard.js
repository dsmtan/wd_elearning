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
  var userData = await jConnection.json();
  if (userData) {
    divNotification.style.display = "block";
    divNotification.textContent = "Your information is updated!";
    divNotification.onanimationend = () => {
      divNotification.style.display = "none";
    };
  }
}

async function deleteUser() {
  var jConnection = await fetch("api/api-delete-user.php");
  var userData = await jConnection.text();
  if (userData) {
    divNotification.style.display = "block";
    divNotification.style.borderColor = "#f47474";
    divNotification.innerHTML =
      "Your account has been deleted.<br>You'll be redirected.";
    divNotification.onanimationend = () => {
      window.location = "signup.php";
    };
  }
}
