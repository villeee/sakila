<?php
    require('funktiot.php');
?>

<!DOCTYPE html>
<!--
1. Toteuta yksinkertainen hakulomake, jolla voi hakea elokuvan nimellä tai nimen osalla.
 Hakutuloksissa näytetään elokuvan nimi, kuvaus, ikäraja ja julkaisuvuosi.
2. Toteuta navigointivalikko, jonka avulla voi selata elokuvia genreittäin.
3. Toteuta lomake, jolla voi lisätä tietokantaan uuden elokuvan (nimi, kuvaus, julkaisuvuosi,
   kieli, vuokra-aika, vuokrahinta, pituus, korvaushinta, ikäraja, special features).
   Vihje: kieltä varten tee pudotusvalikko, jonka value-arvoina käytät tietokannasta löytyviä language_id-arvoja
   ja näytettävänä tekstinä vastaavaa kielen nimeä. Tätä ei tarvitse hakea tietokannasta, vaan voit ns. "kovakoodata" arvot lomakkeeseen.
HUOM! film_list on näkymä, ei "oikea" taulu. Älä tee lisäyksiä siihen.
Tee tarvittavat virheentarkistukset lomakkeenkäsittelijässä, jotta yksikään kentistä ei ole tyhjä 
ja numeeriset arvot ovat oikeasti numeerisia.
Jos haluat lisähaastetta, hae kieliarvot tietokannasta sekä lisää samalla tavalla
 pudotusvalikko genreille. Lisäksi special features voisi tekstikentän sijaan olla ryhmä valintaruutuja.
Lisätty kommentti/test github
-->

<html>
    <head>
          
        <title>Elokuvat</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">    

        <link rel="stylesheet" href="styles.css">
    
    </head>
    <body>

        <p><a href="create.php">Lisää elokuva</a></p>

       <br>
     
        <!-- <form action="db_palvelin.php" method="post">-->
        <form method="post"> 

            <fieldset>
                <legend>Elokuvahaku</legend>

                <input type="text" name="nimi" class="txtBox" id="txtFilmName" placeholder="nimi">
                             
                <?php callFunctions("fetchCategories"); ?>
              
                <input type="submit" name="button"  class="sButton" id="bSearch" value="Hae">
           </fieldset>

   
       </form>
      
    </body>

 
</html>

<?php
    if(isset($_POST['button'])) // button name
    {      
        echo callFunctions("fetchFilms");
    }

?>