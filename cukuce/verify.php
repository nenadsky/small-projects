<?php
  session_start();
  if(isset($_SESSION['unique_id'])) {
    header("location: login.php");
  }
?>


<?php include_once "header.php"; ?>

  <body>
    <div class="wrapper">
      <section class="form verify">
        <header>Realtime chat app</header>
        <form action="#">
          <div class="error-txt"></div>
          <div class="field input">
            <label for="otp">Verification code</label>
            <input
              type="otp"
              name="otp"
              id="otp"
              placeholder="Enter verification code..."
            />
          </div>
          <div class="field button">
            <input type="submit" value="Verify" />
          </div>
        </form>
        <div class="link">Not yet singed up? <a href="index.php">Sign Up now</a></div>
      </section>
    </div>

    <script src="js/all.js"></script>
    <script src="js/verify.js"></script>

  </body>
</html>
