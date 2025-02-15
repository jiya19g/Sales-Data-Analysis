<?php 

class Tweet {
  public function __construct() {
    $this->db = new Database;
  }

  public function getAllTweets() {
    $this->db->query('SELECT Distinct
                      t.user_id,
                      t.body,
                      t.created_at,
                      t.id,
                      users.firstname,
                      users.lastname,
                      users.username
                      FROM
                          tweets as t
                      JOIN following_sys ON t.user_id = following_sys.following_id OR t.user_id = :user_id
                      join users on users.id = t.user_id
                      where following_sys.follower_id = :user_id
                      ORDER BY t.id DESC
    ');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $tweets = $this->db->resultSet();

    return $tweets;
  }

  public function getAllTweetsByUserSession() {
    $this->db->query('SELECT 
                            t.user_id,
                            t.body,
                            t.created_at,
                            t.id,
                            user.firstname,
                            user.lastname,
                            user.username 
                      FROM tweets as t
                      JOIN users as user  
                      WHERE user.id = :user_id ORDER BY t.id DESC');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $tweets = $this->db->resultSet();

    if($tweets) {
      return $tweets;
    } else {
      return false;
    }
  }

  public function getAllTweetsByUserName($username) {
    $this->db->query('SELECT *, tweets.id as tweet_id FROM tweets 
                      JOIN users as user  
                      WHERE username = :username ORDER BY tweets.id DESC');
    $this->db->bind('username', $username);
    $tweets = $this->db->resultSet();

    if($tweets) {
      return $tweets;
    } else {
      return false;
    }
  }

  public function postTweet($body) {
    $this->db->query('INSERT INTO tweets(user_id, body) VALUES(:user_id, :body)');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->bind('body', $body);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getTotalTweets() {
    $this->db->query('SELECT id FROM TWEETS WHERE user_id = :user_id');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getTotalTweetsByUserName($username) {
    $this->db->query('SELECT tweets.id FROM TWEETS 
                      JOIN users 
                      WHERE users.username = :username
    ');
    $this->db->bind('username', $username);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function like($user_id, $tweet_id) {
    $this->db->query('INSERT INTO likes(user_id, tweet_id) VALUES(:user_id, :tweet_id)');
    $this->db->bind('user_id', $user_id);
    $this->db->bind('tweet_id', $tweet_id);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function unlike($user_id, $tweet_id) {
    $this->db->query('DELETE FROM likes WHERE user_id = :user_id AND tweet_id = :tweet_id LIMIT 1');
    $this->db->bind('user_id', $user_id);
    $this->db->bind('tweet_id', $tweet_id);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function isLike($user_id, $tweet_id) {
    $this->db->query('SELECT id FROM likes WHERE user_id = :user_id AND tweet_id = :tweet_id');
    $this->db->bind('user_id', $user_id);
    $this->db->bind('tweet_id', $tweet_id);
    $user = $this->db->single();
    if($user) {
      return true;
    } else {
      return false;
    }
  }

  public function getTotalLikes($tweet_id) {
    $this->db->query('SELECT id FROM likes WHERE tweet_id = :tweet_id');
    $this->db->bind('tweet_id', $tweet_id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteTweet($id) {
    $this->db->query('DELETE FROM tweets WHERE id = :id LIMIT 1');
    $this->db->bind('id', $id);
    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
public function company_review($review,$company_id,$location) {
 // require_once '../libraries/sentimental/autoload.php';
  $sentiment = new \PHPInsight\Sentiment();
  $scores = $sentiment->score($review);
  $class = $sentiment->categorise($review);
  // echo "String: $string\n";
  //echo "Dominant: $class, scores: ";
  //echo $scores['neg'];
  //echo $scores['neu'];
 // echo $scores['pos'];
  if($class =='pos'){
    $result = '1';
    $result_dominated = 'Positive';
  }
   else if ($class =='neg') {
    $result = '2';
    $result_dominated = 'Negative';
  }
  else if ($class =='neu') {
    $result = '3';
    $result_dominated = 'Netural';
  }
  
    $this->db->query('INSERT INTO company_review(company_id, review,result,result_dominated,positive,negative,netural,location) VALUES(:company_id, :review,:result, :result_dominated,:positive, :negative,:netural,:location)');
    $this->db->bind('company_id', $company_id);
    $this->db->bind('review', $review);
    $this->db->bind('result', $result);
    $this->db->bind('result_dominated', $result_dominated);
    $this->db->bind('positive', $scores['pos']);
    $this->db->bind('negative', $scores['neg']);
    $this->db->bind('netural', $scores['pos']);
     $this->db->bind('location', $location);


    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getcompany_review($company_id) {
    $this->db->query('SELECT * FROM company_review 
                      WHERE company_id = :company_id ORDER BY id DESC');
    $this->db->bind('company_id', $company_id);
    $tweets = $this->db->resultSet();

    if($tweets) {
      return $tweets;
    } else {
      return false;
    }
  }

}