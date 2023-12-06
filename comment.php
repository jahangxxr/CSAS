<div class="comment">
  <h4 class="comment-name"><b><?php echo $data['name']; ?></b></h4>

  <p class="comment-comment"><?php echo $data['comment']; ?></p>
  <p class="comment-date"><?php echo $data['date']; ?></p>
  <?php $reply_id = $data['id']; ?>
  <button class="reply" onclick = "reply(<?php echo $reply_id; ?>, '<?php echo $data['name']; ?>');">Reply</button>
  <!-- edit and delete buttons -->
  <!-- <form action="" method="post">
        <input type="hidden" name="comment_id" value="<?php echo $data['id']; ?>">
        <button type="submit" name="edit_comment">Edit</button>
        <button type="submit" name="delete_comment">Delete</button>
    </form> -->
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