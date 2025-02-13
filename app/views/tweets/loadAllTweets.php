<?php 
  $user = $data['user']; 
  $tweets = $data['tweets']; 
  $user_tweets = $data['user_tweets'];
  $like = $data['likes'];
?>
<?php if(empty($tweets) && empty($user_tweets) ): ?>
<p class="center-align">Welcome to twitter, no tweets yet.</p>
<?php else: 
if (!$tweets) {
  $tweets = $user_tweets; 
} 
foreach($tweets as $tweet): ?>
<div class="card horizontal no-shadow">
  
  <div class="card-stacked">
    <div class="card-content">
    
    <p class="tweet-body"><a href="<?php echo url_for('users/company/') .($tweet->username). '/'.($tweet->id) ?>"><?php echo h($tweet->body); ?></a></p>
    </div>
   
  </div>
</div>
<?php endforeach; endif;?>