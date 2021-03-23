<?php
  session_start();
  if(isset($_SESSION['unique_id']))  {
    header("location: users.php");
  } 
?>


<?php include_once "header.php"; ?>

  <body>
    <div class="wrapper">
      <section class="form reset">
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
         
          <div class="field button">
            <input type="submit" value="Reset password" />
          </div>
        </form>

      </section>
    </div>

    <script src="js/all.js"></script>
    <script src="js/reset.js"></script>

  </body>
</html>
