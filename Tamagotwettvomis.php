<    <?php

    require_once('TwitterAPIExchange.php');
    /*authentification du compte tweeter=   token */
    $settings = array('oauth_access_token'=>'3238659609-6X9uGUkxpYhmqQSQqqix4Ewc2uTPdD9nskI45F8',
    'oauth_access_token_secret'=>'QEY4nk2YMueFDACd5nVZiqGkdT8HI5LiW4dKHoi7ZiYth',
    'consumer_key'=>'w3S89uW36ocTHuxTG7nfCjoVK',
    'consumer_secret'=>'fHcG0TZCbF8KRPl7uhyKi1lVhJxQnGm3tc3C2XcXgCVOsjbgjJ');

    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

    $requestMethod = "GET";

    $getfield = "?screen_name=kaa_sha&count=10"; /*20 derniers tweets*/

    $twitter = new TwitterAPIExchange($settings);

    $str = json_decode(
                    $twitter -> setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest(), $assoc=TRUE);

        if (array_key_exists("errors", $str)){
          echo "Vous avez une erreur:".$str[errors];
        }

        $i=0;
        foreach($str as $items){
                $textTweet=$items['text'];
                $lesMots = explode(" ", $textTweet);
                if (isset($lesMots[$i])){
                echo "$lesMots[$i] ";
                $i++;
              }
        }

?>
