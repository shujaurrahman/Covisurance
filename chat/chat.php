<?php 
  session_start();
  include_once "../partials/conn.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../index.php");
  }

?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../userimages/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
        <button type='submit' onclick='clearChat()' class='logout'>Clear Chat</button>

      </header>
      <?php
        $outgoing_id = $_SESSION['unique_id'];
        if(isset($_GET) and isset($_GET['clearChat'])){
             
             $sql="DELETE
             FROM messages
             WHERE 
             (`outgoing_msg_id`={$outgoing_id} AND `incoming_msg_id`='$user_id')
             OR
             (`outgoing_msg_id`={$user_id} AND `incoming_msg_id`='$outgoing_id')
             ";
             $result=mysqli_query($conn,$sql);
        }
      ?>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>
  <?php
  echo "
    <script>
    function clearChat(){     
        window.location = `chat.php?user_id=$user_id&clearChat`;
}
  </script>"
?>
</body>
</html>
