<div class="reply">
  <h4 class="reply-name"><b><?php echo $data['name']; ?></b></h4>
  <p class="reply-comment"><?php echo $data['comment']; ?></p>
  <p class="reply-date"><?php echo $data['date']; ?></p>
  <p><?php $reply_id = $data['id']; ?></p>
  <!-- <button class="reply" onclick = "reply(<?php echo $reply_id; ?>, '<?php echo $data['name']; ?>');">Reply</button> -->
  <?php
  unset($datas);
  $datas = mysqli_query($conn, "SELECT * FROM chat WHERE reply_id = $reply_id");
  if(mysqli_num_rows($datas) > 0) {
    foreach($datas as $data){
      require 'reply.php';
    }
  }
  ?>
</div>