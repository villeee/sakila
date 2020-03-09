
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
               padding: 30px 30px 0px 30px;             
           }
           .results {            
              /*  line-height: 1.25rem;
               padding-top: 15; 
              /* width: 45%;   */ 
              margin-left: 10px;
              padding-left: 20px;  
              float:left;  
              overflow: auto;  
              width: 80%;    
              color: #444;        
              background-color: #fff;
           }
           .menu {            
              /*  line-height: 1.25rem;
               padding-top: 15; 
              /* width: 45%;   */ 
              float:left; 
              overflow: auto;  
              width: 10%;            
             
           }

           .leffa {            
                line-height: 1.25rem;
               padding: 10px; 
               margin-right: 20px;
               margin-bottom: 15px;
               width: 25%;
               height: 200px;   
               float: left;    
               border: 1px solid #444;
                box-sizing: border-box;
                box-shadow: 5px 5px #ddd;
                background-color: #fff;
  
           }
           
           body {
                font-family: tahoma;
                font-size:  0.875rem;
                letter-spacing: 0.75px;
                color: #333;
                background-color: #ffffff;
           }

           h2 {
               margin-bottom: 30px;
           }
           h1 {
                color:#3300dd;
                padding-top: -50px;
           }
           input[type=submit] {
                background-color: #00d29b;
                border: none;
                color: white;
                padding: 3px 20px 3px 20px;
                text-decoration: none;
                font-weight: bold;
                cursor: pointer;
                letter-spacing: 1px;
            }

            input[type=text] {
                 margin: 0px 5px 7px 0px; 
            }
            
            .btn {
                border: none;
                background-color: #222;
                width: 100px;
                padding: 9px;
                margin-bottom: 1px;
                font-size: 12px;
                cursor: pointer;
                display: inline-block;
                color: white;
                font-weight: bold;             
            }
       </style>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        // jQuery:
 /*   function haeGenrenLeffat(clicked) {
                var genre_id = clicked;
                console.log(genre_id);
                $("button").click(function() {
                    $("#results").load("load-data.php", {
                    genre_id: clicked                  
                });
            });
    };*/

    function haeGenrenLeffat(clicked){
        var genre_id = clicked;
       console.log(genre_id);
        $.ajax({
        type: "POST",
        url: 'load-data.php',
        data: ({"data": genre_id}),
        success: function(data) {
            $(".results").html(data);
        }
        });
     };

    
    </script>
    </head>

    <body>
    <div class="container"> 
        <h2>FIND MOVIES</h3>
        <div class="menu">

        <?php 
             $sql = "SELECT * FROM category";
              //$sql_leffat = "SELECT fc.category_id, c.name, f.title, f.description, f.rating, f.release_year FROM (film f LEFT JOIN film_category fc on f.film_id = fc.film_id) INNER JOIN category c on fc.category_id = c.category_id";
            $tulos = $mysqli -> query($sql);
            if ($tulos -> num_rows > 0) {
                while($rivi = $tulos -> fetch_assoc()){
                    $c_id = $rivi["category_id"];
                    $genre = $rivi["name"];       
                    // Genre-buttonit:                                  
                     echo "<button class='btn' id='$c_id' onClick='haeGenrenLeffat(this.id)'>$genre</button></br>";                   
                }
            } else {
                echo "Ei tuloksia";
            }       
            $mysqli -> close();    
        ?>
        </div>

         <div class="results">
              "Hakutulokset tähän.";
        </div>
    </div>     
    </body>

</html>