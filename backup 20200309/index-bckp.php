
<?php
    include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ABC</title>
       <!-- <link rel="stylesheet" href="style.css"> -->
       <meta name="viewport" content="width = device-width">

       <style>
           .container {
               padding: 30 30 0 30;             
           }
           .results {            
              /*  line-height: 1.25rem;
               padding-top: 15; 
              /* width: 45%;   */   
              overflow: auto;  
              width: 90%;
               
              background-color: #faaaff;  
           }

           .leffa {            
                line-height: 1.25rem;
               padding: 10; 
               margin-right: 20;
               margin-bottom: 15;
               width: 25%;
               height: 200;   
               float: left;    
               border: 1px solid #444;
                box-sizing: border-box;
                box-shadow: 5px 5px #ddd;
                background-color: #fff;
             
              
           }
           
           body {
                font-family: tahoma;
                font-size:  0.875rem;
                letter-spacing: 0.75;
                color: #333;
                background-color: #ffffff;
           }

           h2 {
               margin-bottom: 30;
           }

           input[type=submit] {
                background-color: #00d29b;
                border: none;
                color: white;
                padding: 3 20 3 20;
                text-decoration: none;
                font-weight: bold;
                cursor: pointer;
                letter-spacing: 1;
            }

            input[type=text] {
                 margin: 0 5 7 0; 
            }
            
            .nappi {
                border: none;
                background-color: #222;
                width: 100;
                padding: 4;
                margin-bottom: 1;
                font-size: 12px;
                cursor: pointer;
                display: inline-block;
                color: white;
                font-weight: bold;
                
            }
       </style>

    </head>

    <script></script>

    <body>

    <div class="container"> 

   

        <h2>FIND MOVIES</h3>
        <div >   
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" target="_blank">
            <label for="fname"></label>
            <input type="text" name="nimi" placeholder="movie's name">
            <input type="hidden" name="kuvaus">
            <input type="hidden" name="ika">
            <input type="hidden" name="vuosi">
            <input type="Submit" value="SUBMIT">
        </form>      
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" target="_blank">
            <input type="hidden" name="genre">
            <input type="Submit" value="GENRET">
        </form> 
        </div>

        <div class="results">

        <?php 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

           /* $server = "localhost";
            $user = "root";  
            $pw = "root";
            $database = "sakila";
/*
            $nimi = strtoupper(trim(strip_tags( $_POST['nimi'] )));

            // 1. Toteuta yksinkertainen hakulomake, jolla voi hakea elokuvan nimellä
            // tai nimen osalla. Hakutuloksissa näytetään elokuvan nimi, kuvaus, ikäraja ja julkaisuvuosi.
 
   
                $sql_leffat = "SELECT f.title, f.description, f.rating, f.release_year FROM film f " . " WHERE UPPER(f.title) LIKE '%$nimi%' ORDER BY title";

                $tulos = $mysqli -> query($sql_leffat);
                if ($tulos -> num_rows > 0) {
                    while($rivi = $tulos -> fetch_assoc()) {

                        $title = $rivi['title'];
                        $description = $rivi["description"];
                        $rating = $rivi["rating"];
                        $release_year = $rivi["release_year"];

                    echo '<div class="leffa">';
                    echo "<b>Film</b>: ". $title . "<br><b>Description</b>: " . $description . "<br><b>Rating</b>: " . $rating . "<br><b>Release year</b>: " . $release_year . "<br><br>";
                    echo '</div>';
                }
                    } 
                  
                }
         */
           

            // 2. NÄYTÄ LEFFOJA GENREITTÄIN

                $mysqli = new mysqli("$server","$user","","$database");
                if($mysqli -> connect_error) {
                    die("Liian hapokasta: " . $mysqli -> connect_error);
                }
                $mysqli -> set_charset("utf8");

            $nimi = strtoupper(trim(strip_tags( $_POST['genre'] )));
              $sql = "SELECT * FROM category";
              $sql_leffat = "SELECT c.name, f.title, f.description, f.rating, f.release_year FROM (film f LEFT JOIN film_category fc on f.film_id = fc.film_id) INNER JOIN category c on fc.category_id = c.category_id";
            $tulos = $mysqli -> query($sql);
            if ($tulos -> num_rows > 0) {
                while($rivi = $tulos -> fetch_assoc()){
                   
                    $genre = $rivi["name"];
                  // echo '<div class="leffa">';
                   // echo "<li><a href='?genrenLeffat()'>$genre</a></li>";
                 //  echo "<li><a href='?genrenLeffat()'>$genre</a></li>";
                 echo "<button class='nappi'>$genre</button></br>";
                   // echo '</div>';
                }
            } else {
                echo "Ei tuloksia";
            }       
            $mysqli -> close();
        
        }
    /*    function genrenLeffat($res) {
             echo '<div class="leffa">';
            echo $res;
             echo '</div>';
        }     */  
        
        ?>
        </div>
    </div> 
    
    </body>

</html>