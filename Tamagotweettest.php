<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="tama.css">
    <title>TAMAGOTWEET</title>
  </head>
  <header>
    <h1>TAMAGOTWEET</h1>
  </header>
  <body>
        <form class="" method="post">
          <textarea type="text" name="tweet" value="Ecrir le tweet"></textarea>
          <input type="submit" name="compteur" value="Publier le tweets" >
        </form>
        <div   class="container">
          <img id="sky" src="tama.gif" alt="">
        </div>
        <div class="hero">
          <p></p>
        </div>
        <?php
            $nbTweet=0;
            if(!empty($_POST['compteur'])) {
                $monfichier = fopen("/var/www/html/MesProjetsPHP/MesExos/TamagoTweet/SauvegardeTamago.txt", 'r+');
                $nbTweet =(int)fgets($monfichier); // On lit la première ligne
                if ($nbTweet!=5){
                $nbTweet += 1; // On augmente de 1
                fseek($monfichier, 0); // On remet le curseur au début du fichier
                fputs($monfichier, $nbTweet); // On écrit le nouveau nombre
                fclose($monfichier);
              }else{
                $nbTweet=0; // On initialise a 0
                fseek($monfichier, 0); // On remet le curseur au début du fichier
                fputs($monfichier, $nbTweet); // On écrit le 0
                fclose($monfichier);
                require_once('TwitterAPIExchange.php');

                $settings = array('oauth_access_token'=>'3238659609-6X9uGUkxpYhmqQSQqqix4Ewc2uTPdD9nskI45F8',
                'oauth_access_token_secret'=>'QEY4nk2YMueFDACd5nVZiqGkdT8HI5LiW4dKHoi7ZiYth',
                'consumer_key'=>'w3S89uW36ocTHuxTG7nfCjoVK',
                'consumer_secret'=>'fHcG0TZCbF8KRPl7uhyKi1lVhJxQnGm3tc3C2XcXgCVOsjbgjJ');

                $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

                $requestMethod = "GET";

                $getfield = "?screen_name=kaa_sha&count=10";

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

              }
            }
            $text=$_POST["tweet"];
            require_once('TwitterAPIExchange.php');
            /*authentification du compte tweeter=   token */
            $settings = array('oauth_access_token'=>'3238659609-6X9uGUkxpYhmqQSQqqix4Ewc2uTPdD9nskI45F8',
            'oauth_access_token_secret'=>'QEY4nk2YMueFDACd5nVZiqGkdT8HI5LiW4dKHoi7ZiYth',
            'consumer_key'=>'w3S89uW36ocTHuxTG7nfCjoVK',
            'consumer_secret'=>'fHcG0TZCbF8KRPl7uhyKi1lVhJxQnGm3tc3C2XcXgCVOsjbgjJ');
            /*construction URL pour envoi de tweet*/
            $url = "https://api.twitter.com/1.1/statuses/update.json";
            $requestMethod = "POST";
            $postfields = ["status"=>"$text"]; /*Ecrire un tweet*/
            $twitter = new TwitterAPIExchange($settings);
             $twitter->buildOauth($url, $requestMethod)
                         ->setPostfields($postfields)
                         ->performRequest();

        $taille=150;
       if(!empty($_POST['compteur'])) {
           $monfichierTaille = fopen("/var/www/html/MesProjetsPHP/MesExos/TamagoTweet/SauvegardeTamagoTaille.txt", 'r+');
           $taille =(int) fgets($monfichierTaille); // On lit la première ligne
           if ($taille<750){
           $taille = $taille + 100; // On augmente de 1
           fseek($monfichierTaille, 0); // On remet le curseur au début du fichier
           fputs($monfichierTaille, $taille); // On écrit le nouveau nombre
           fclose($monfichierTaille);
         }else{
           $taille=150; // On initialise a 0
           fseek($monfichierTaille, 0); // On remet le curseur au début du fichier
           fputs($monfichierTaille, $taille); // On écrit le 0
           fclose($monfichierTaille);
        }
      }
        ?>
        <script>
        var taille = <?php echo json_encode($taille); ?>;
        console.log (taille);
        var myImg = document.getElementById("sky");

    		if(taille==750){
                myImg.style.height= 150 + "px";
                myImg.style.width= 150 + "px";
    		} else {
                myImg.style.height = taille + "px";
                myImg.style.width =  taille + "px";
    		}



      </script>
  </body>
</html>
