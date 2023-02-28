// Retrieve the id and token parameters from the query string
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get("id");
const token = urlParams.get("token");

// Verify the registration using the student number and token
const registrationSuccessful = verifyRegistration(id, token);

// Display a message to the user indicating whether their registration was successful or not
const messageElement = document.getElementById("message");
if (registrationSuccessful) {
  messageElement.innerHTML =
    "Your registration has been successfully verified. Thank you!";
} else {
  messageElement.innerHTML =
    "Failed to verify your registration. Please contact support for assistance.";
}

// Verify the registration using the student number and token
function verifyRegistration(id, token) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "verify-registration.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const response = xhr.responseText;
      console.log(response);
      if (response === "success") {
        return true;
      } else {
        return false;
      }
    }
  };
  const formData = new FormData();
  formData.append("id", id);
  formData.append("token", token);
  xhr.send(formData);
}
