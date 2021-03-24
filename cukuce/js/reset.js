const form = document.querySelector(".reset form");
resetBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

resetBtn.onclick = () => {
  // Lets start Ajax
  let xhr = new XMLHttpRequest(); //creating xml object
  xhr.open("POST", "php/reset.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data === "success") {
          errorText.textContent = data;
          errorText.style.display = "block";
          setTimeout(function () {
            location.href = "verify.php";
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
