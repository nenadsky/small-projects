const pswrdField = document.querySelector(".form input[type='password']"),
  toggleBtn = document.querySelector(".form .field .eye");

toggleBtn.onclick = () => {
  if (pswrdField.type == "password") {
    pswrdField.type = "text";
    toggleBtn.classList.add("active");
  } else {
    pswrdField.type = "password";
    toggleBtn.classList.remove("active");
  }
};
