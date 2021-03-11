<?php
  session_start();
  if(isset($_SESSION['unique_id'])) {
    header("location: users.php");
  }
?>


<?php include_once "header.php"; ?>

  <body>
    <div class="wrapper">
      <section class="form login">
        <header>Realtime chat app</header>
        <form action="#">
          <div class="error-txt"></div>

          <div class="field input">
            <label for="email">Email address</label>
            <input
              type="email"
              name="email"
              id="email"
              placeholder="Email address"
            />
          </div>
          <div class="field input">
            <label for="password">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password"
            />
            <div class="eye"><i class="fas fa-eye"></i></div>
          </div>

          <div class="field button">
            <input type="submit" value="Continue to chat" />
          </div>
        </form>
        <div class="link">Not yet singed up? <a href="index.php">Sign Up now</a></div>
      </section>
    </div>

    <script src="js/all.js"></script>
    <script src="js/pass-show-hide.js"></script>
    <script src="js/login.js"></script>

  </body>
</html>
