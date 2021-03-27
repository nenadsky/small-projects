const form = document.querySelector(".new-pass form");
newPassBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

newPassBtn.onclick = () => {
  // Lets start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/new-pass.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "Success updating password!") {
          errorText.textContent = data;
          errorText.style.display = "block";
          setTimeout(function () {
            location.href = "login.php";
          }, 2000);
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
