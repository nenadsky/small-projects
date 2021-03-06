<?php include_once "header.php"; ?>

  <body>
    <div class="wrapper">
      <section class="chat-area">
        <header>
          <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
          <img src="img/tux.jpg" alt="" />
          <div class="details">
            <span>Nenadsky</span>
            <p>Active now</p>
          </div>
        </header>
        <div class="chat-box">
          <div class="chat outgoing">
            <div class="details">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error,
                omnis.
              </p>
            </div>
          </div>
          <div class="chat incoming">
            <img src="img/tux.jpg" alt="" />
            <div class="details">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error,
                omnis.
              </p>
            </div>
          </div>
        </div>
        <form action="#" class="typing-area">
          <input type="text" placeholder="Type a message here..." />
          <button><i class="fab fa-telegram-plane"></i></button>
        </form>
      </section>
    </div>

    <script src="js/all.js"></script>
  </body>
</html>
