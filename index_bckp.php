
<?php
    include "db.php";
    include "links/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>SAKILA</title>
        <link rel="stylesheet" href="links/styles.css"> 
        <meta name="viewport" content="width = device-width">  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script  type="text/javascript" src="links/functions.js"></script>

</head>
<body>

    <div class="header">
         <button class="tablinks" onclick="openContent(event, 'Find')" id="defaultOpen">Find</button>
         <button class="tablinks" onclick="openContent(event, 'Add')" >Add</button>      
    </div>


        <div class="container"> 
  
            <div id="Find" class="tabcontent">
                
                <div class="menu">
                    <?php   // GENRE-VALIKKO
                        genreMenu();
                    ?> 
                </div>
                <div class="results">
                <h2>Find movies by genre</h2>
                </div>
            </div>

            <div id="Add" class="tabcontent">
                <h2>Add movie to Sakila</h2>
                <form id="addFilm" name="form1" method="post">
                <div class="form-group">
                        <label>Name:</label><br>
                        <input type="text" class="form-control" id="title" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Description:</label><br>
                        <input type="text" class="form-control" id="desc" placeholder="Description">
                    </div>
                    <div class="form-group" >
                        <label>Release year:</label><br>
                        <input type="text" class="form-control" id="year" placeholder="Release year">
                    </div>
                    <div class="form-group">
                        <label>Language id:</label><br>
                        <input type="text" class="form-control" id="lang_id" placeholder="lang_id">
                    </div>
                    <div class="form-group">
                    <label>Original language id:</label><br>
                        <input type="text" class="form-control" id="orig_lang_id" placeholder="orig_lang_id">
                    </div>
                    <div class="form-group">
                        <label>Rental duration:</label><br>
                        <input type="text" class="form-control" id="rent_dur" placeholder="Rental duration">
                    </div>
                    <div class="form-group">
                        <label>Rental rate:</label><br>
                        <input type="text" class="form-control" id="rent_rate" placeholder="Rental rate">
                    </div>
                    <div class="form-group" >
                        <label>Length:</label><br>
                        <input type="text" class="form-control" id="length" placeholder="Lenght">
                    </div>
                    <div class="form-group">
                        <label>Replacement cost:</label><br>
                        <input type="text" class="form-control" id="replace_cost" placeholder="Rental duration">
                    </div>
                    <div class="form-group">
                        <label>Rating:</label><br>
                        <input type="text" class="form-control" id="rate" placeholder="Rating">
                    </div>
                    <div class="form-group" >
                        <label>Special features:</label><br>
                        <input type="text" class="form-control" id="special_feat" placeholder="Special features">
                    </div>

                    <input type="button" name="save" class="btn btn-primary" value="Save" id="butsave">
                </form>
            </div>
            
        </div>    
        
        <script>
            // Get the element with id="defaultOpen" and click on it -> FIND näkyy defaulttina
            document.getElementById("defaultOpen").click();


        // AJAX-TALLENNUS TIETOKANTAAN:
            
        $(document).ready(function() {
            $("#butsave").click(function() {  
                $("#butsave").attr("disabled", "disabled");        
                var title = $("#title").val();
                var desc = $("#desc").val();  
                var year = $("#year").val();             
                var lang_id = $("#lang_id").val();
                var orig_lang_id = $("#orig_lang_id").val();
                var rent_dur = $("#rent_dur").val();
                var rent_rate = $("#rent_rate").val();
                var length = $("#length").val();               
                var replace_cost = $("#replace_cost").val();
                var rate = $("#rate").val();
                var special_feat = $("#special_feat").val();
                console.log(title, desc, rate, year);
                if(title!="" && desc!="" && rate!="" && year!=""){
                    $.ajax({
                        url: 'save-data.php',
                        type: "POST",
                        data: {
                            title: title,
                            desc: desc,
                            year: year,
                            lang_id: lang_id,
                            orig_lang_id: orig_lang_id,
                            rent_dur: rent_dur,
                            rent_rate: rent_rate,
                            length: length,
                            replace_cost: replace_cost,
                            rate: rate,
                            special_feat: special_feat				
                        },
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                $("#butsave").removeAttr("disabled");
                                $('#addFilm').find('input:text').val('');
                                $("#success").show();
                                $('#success').html('Data added successfully !'); 						
                            }
                            else if(dataResult.statusCode==201){ 
                            alert("Error occured !");
                            } 
                            alert(data);
                        }
                    });
                }
                else{
                    alert('Please fill all the field !');
                }
            });
        });
        </script>
    </body>

</html>