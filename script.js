const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const id = urlParams.get("id");
const token = urlParams.get("token");

const form = document.querySelector("form");
const inputId = document.getElementById("id");
const inputToken = document.getElementById("token");
let submitted = false;

document.addEventListener("DOMContentLoaded", () => {
  inputId.value = id;
  inputToken.value = token;

  if (!id || !token) {
    document.getElementById("message").innerHTML = "Invalid Parameters";
  } else if (id && token) {
    document.getElementById("message").innerHTML =
      "Refresh your list to see changes";
  }

  form.onsubmit = (e) => {
    e.preventDefault();
    console.log(response);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "verify-registration.php", true);
    xhr.onload = () => {
      if (xhr.readyState == 4 && xhr.status == 200) {
        let response = xhr.responseText;
        console.log(response);
        form.submit(); // submit the form after successful AJAX submission
      }
    };
    let formData = new FormData(form);
    xhr.send(formData);
  };
});
