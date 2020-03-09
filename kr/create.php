<?php
    require('funktiot.php');
    //$_POST['virheet']['kuvaus'] = "Kuvaus on jo olemassa";
?>

<!DOCTYPE html>
<!--
3. Toteuta lomake, jolla voi lisätä tietokantaan uuden elokuvan (nimi, kuvaus, julkaisuvuosi,
   kieli, vuokra-aika, vuokrahinta, pituus, korvaushinta, ikäraja, special features).
   Vihje: kieltä varten tee pudotusvalikko, jonka value-arvoina käytät tietokannasta löytyviä language_id-arvoja
   ja näytettävänä tekstinä vastaavaa kielen nimeä. Tätä ei tarvitse hakea tietokannasta, vaan voit ns. "kovakoodata" arvot lomakkeeseen.
HUOM! film_list on näkymä, ei "oikea" taulu. Älä tee lisäyksiä siihen.
Tee tarvittavat virheentarkistukset lomakkeenkäsittelijässä, jotta yksikään kentistä ei ole tyhjä 
ja numeeriset arvot ovat oikeasti numeerisia.
Jos haluat lisähaastetta, hae kieliarvot tietokannasta sekä lisää samalla tavalla
 pudotusvalikko genreille. Lisäksi special features voisi tekstikentän sijaan olla ryhmä valintaruutuja.
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

        <br>
     
        <!-- <form action="db_palvelin.php" method="post">-->
        <form action="create.php" method="post" id="lomake"> 

            <fieldset>
                <legend>Lisää elokuvan tiedot</legend>

                <label for  ="nimi" class="lbTitle">Nimi:</label>
                <input type ="text" id="nimi" name="nimi" class="txtBox" placeholder="nimi" required><br><br>

                <label for  ="kuvaus" class="lbTitle">Kuvaus:</label>
                <input type="text" id="kuvaus" name="kuvaus" class="txtBox" placeholder="kuvaus" value="<?php echo $_POST['kuvaus'];?>" required><br><br>
                <!--<div class="virheilmoitus"><?php echo $_POST['virheet']['kuvaus'];?></div>-->
                
                <label for  ="julkaisuvuosi" class="lbTitle">Julkaisuvuosi:</label>
                <input type="number" min="1901" max="2155" id="julkaisuvuosi" name="julkaisuvuosi" class="txtBox" placeholder="julkaisuvuosi" required><br><br>

                <!-- <label class="lbTitle">Kieli:</label> -->
                <!-- <input type="text" id="kieli" name="kieli" class="txtBox" placeholder="kieli"> -->
              
                <label for  ="vuokraaika" class="lbTitle">Vuokra-aika:</label>
                <input type="number"  min="1" max="1000"id="vuokraaika" name="vuokraaika" class="txtBox" placeholder="vuokra-aika" required><br><br>
               
                <label for  ="vuokrahinta" class="lbTitle">Vuokrahinta:</label>
                <input type="number"   step="any"  id="vuokrahinta" name="vuokrahinta" class="txtBox" placeholder="vuokrahinta" required>
                <br><br>

                <label for  ="pituus" class="lbTitle">Pituus:</label>
                <input type="number" min="1" max="1000"  id="pituus" name="pituus" class="txtBox" placeholder="pituus" required><br><br>

                <label for  ="korvaushinta" class="lbTitle">Korvaushinta:</label>
                <input type="number" step="any" id="korvaushinta" name="korvaushinta" class="txtBox" placeholder="korvaushinta" required><br><br>
                
                <label for  ="ikaraja" class="lbTitle">Ikäraja:</label>
                <!-- <input type="text" id="ikaraja" name="ikaraja" class="txtBox" placeholder="ikäraja" required><br><br> -->

                <!--<input list="ikaraja" name="ikaraja" required>-->
                <select id="ikaraja"  name="ikaraja" required>
                    <option value="G">G</option>
                    <option value="PG">PG</option>
                    <option value="PG-13">PG-13</option>
                    <option value="R">R</option>    
                    <option value="NC-17">NC-17</option>                           
                </select>

                <br><br>

                <label for  ="special_feature" class="lbTitle">Erityispiirteet:</label>

                <input list="special_features" name="special_features"  required>
                <datalist id="special_features" required>
                    <option value="Trailers">
                    <option value="Commentaries">
                    <option value="Deleted Scenes">
                    <option value="Behind the Scenes">                 
                </datalist>

                <br><br>

                <label for  ="kieli" class="lbTitle">Kieli:</label>
                <?php 
                    callFunctions("fetchLanguages");
                   
                ?>
                <br><br>

               
                <input type="submit" name="button"  id="bCreate" class="sButton" value="Tallenna">
 
               
           </fieldset>
           
           <br>

           <p><a href="index.php">Paluu</a></p>

          
       </form>
      
    </body>

 
</html>

<?php
    if(isset($_POST['button'])) // button name
    {      
        echo callFunctions("createFilm");
    }

?>