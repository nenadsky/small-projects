const form = document.querySelector(".verify form");
verifyBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

verifyBtn.onclick = () => {
  // Lets start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/verify.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success activating") {
          location.href = "users.php";
        } else if (data === "success reseting") {
          location.href = "new-password.php";
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };

  let formData = new FormData(form); // creating new formData object
  xhr.send(formData);
};
