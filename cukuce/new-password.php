<?php
  session_start();
  if(isset($_SESSION['unique_id']))  {
    header("location: users.php");
  } 
?>


<?php include_once "header.php"; ?>

  <body>
    <div class="wrapper">
      <section class="form new-pass">
        <header>Realtime chat app</header>
        <form action="#">
          <div class="error-txt"></div>

          <div class="field input">
            <label for="new-pass">Password</label>
            <input
              type="password"
              name="new-pass"
              id="new-pass"
              placeholder="New Password"
            />
            <div class="eye"><i class="fas fa-eye"></i></div>
          </div>

          <div class="field input">
            <label for="c-new-pass">Password</label>
            <input
              type="password"
              name="c-new-pass"
              id="password"
              placeholder="Repeat New Password"
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
    <script src="js/newPass.js"></script>

  </body>
</html>
