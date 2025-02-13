<?php $tweets = $data['tweets']; $user = $data['user'];
//print_r($tweets); exit;
?>
<?php if(empty($tweets)): ?>
<p class="center-align">No Review from you yet.</p>
<?php else: ?>
<?php foreach($tweets as $tweet): ?>
  <div class="card horizontal no-shadow">
    <div class="card-image">
      <a href="#" class="white-text"><span class="avatar"><i class="fa fa-user fa-2x circle"></i></span></a>
    </div>
    <div class="card-stacked">
      <div class="card-content">
      
      <p class="tweet-body"><?php echo h($tweet->review); ?> <span style="color:red; float:right;"><?php echo h($tweet->result_dominated); ?></span></p>
      </div>
      
    </div>
  </div>
<?php endforeach; endif;?>