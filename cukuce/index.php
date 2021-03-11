<?php
  session_start();
  if(isset($_SESSION['unique_id'])) {
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
  <body>
    <div class="wrapper">
      <section class="form signup">
        <header>Realtime chat app</header>
        <form action="#" enctype="multipart/form-data">
          <div class="error-txt">This is an error message</div>
          <div class="name-details">
            <div class="field input">
              <label for="name">First name</label>
              <input
                type="text"
                name="name"
                id="name"
                placeholder="First name"
                required
              />
            </div>
            <div class="field input">
              <label for="last-name">Last name</label>
              <input
                type="text"
                name="last-name"
                id="last-name"
                placeholder="Last name"
                required
              />
            </div>
          </div>
          <div class="field input">
            <label for="email">Email address</label>
            <input
              type="email"
              name="email"
              id="email"
              placeholder="Email address"
              required
            />
          </div>
          <div class="field input">
            <label for="password">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password"
              required
            />
            <div class="eye"><i class="fas fa-eye"></i></div>
          </div>
          <div class="field image">
            <label for="user-img">Select image</label>
            <input type="file" name="user-img" id="user-img" />
          </div>
          <div class="field button">
            <input type="submit" value="Continue to chat" />
          </div>
        </form>
        <div class="link">Already singed up? <a href="login.php">Login now</a></div>
      </section>
    </div>

    <script src="js/all.js"></script>
    <script src="js/pass-show-hide.js"></script>
    <script src="js/signup.js"></script>
  </body>
</html>
