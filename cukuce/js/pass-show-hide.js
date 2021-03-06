const pswrdField = document.querySelector(
  ".form .field input[type='password']"
);
toggleBtn = document.querySelector(".form .field .eye");

fontAwesome = document.querySelector(".form .field .eye i");

toggleBtn.onclick = () => {
  if (pswrdField.type == "password") {
    pswrdField.type = "text";
    fontAwesome.classList.add("active");
  } else {
    pswrdField.type = "password";
    fontAwesome.classList.remove("active");
  }
};
