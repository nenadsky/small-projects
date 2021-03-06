<?php
  session_start();
  if(!isset($_SESSION['unique_id'])) {
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>
  <body>
    <div class="wrapper">
      <section class="users">
        <header>
          <div class="content">
            <img src="img/tux.jpg" alt="" />
            <div class="details">
              <span>Nenadsky</span>
              <p>Active now</p>
            </div>
          </div>
          <a href="#" class="logout">Logout</a>
        </header>
        <div class="search">
          <span class="text">Select an user to start chat</span>
          <input type="text" placeholder="Enter name to search..." />
          <button><i class="fas fa-search"></i></button>
        </div>
        <div class="users-list">
          <a href="#">
            <div class="content">
              <img src="img/tux.jpg" alt="" />
              <div class="details">
                <span>Nenadsky</span>
                <p>This is test message</p>
              </div>
            </div>
            <div class="status-dot"><i class="fas fa-circle"></i></div>
          </a>
        </div>
      </section>
    </div>

    <script src="js/all.js"></script>
    <script src="js/users.js"></script>
  </body>
</html>
