const pswrdField = document.querySelector(
  ".form .field input[type='password']"
);
toggleBtn = document.querySelector(".form .field .eye i");

console.log(pswrdField, toggleBtn);

toggleBtn.onclick = () => {
  console.log("clicked");
};
