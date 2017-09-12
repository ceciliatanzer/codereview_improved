<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
}else{
  $_SESSION['login'] = True;
}
 // select logged-in users detail
 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome - <?php echo $userRow['firstName']; ?></title>
<style>
  .imgrow{
    margin-top: 5vh;
  }
  .imgrow img{
    border:2px solid blue;
    max-height: 40vh;
    max-width: 35vh;
  }
  .container-fluid{
    background-color: #713A1B;
    color: white;
  }
  #title{
    font-size: 25px;
  }
  p{
    font-size: 18px;
    font-family: : curier;
  }
  a {
      color: white;
    }
  @import url('https://fonts.googleapis.com/css?family=Raleway');
    h1{
      font-family: 'Raleway', sans-serif;
      font-size:15pt;
    }
    #header img{
      max-height: 300px;
      width: 100%;
    }

</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<form action="exerciseajax.php" method="POST" id="myform">
 <input type="number" id="ISBN" placeholder="ISBN">
 <input type="text" id="titel" placeholder="Titel">
 <input type="text" id ="author" placeholder="Author">
 <input type="text" id ="status" placeholder="Status">
 <input type="text" id="description" placeholder="Description">
 <input type="text" id="photoLink" placeholder="Photo link">
 <select id="genre">
   <option value="fantasy">Fantasy</option>
   <option value="crimi">Crimi</option>
   <option value="drama">Drama</option>
   <option value="siencefiction">Sience fiction</option>
   <option value="biography">Biography</option>
</select>
<input type="button" id="submit" value="Submit">
</form>


            <?php echo "<div class=\"container-fluid\">";
            echo "<div class=\"row\" id=\"header\" >";
            echo "<img src=\"http://img.medscapestatic.com/pi/features/slideshow-slide/summerreading2017/fig1.jpg?resize=500:*\" alt=\"problem loading :((\">";
            echo" </div>" ; //header 
            echo "<div class=\"row\">";
            echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-9\">";
            echo "<img class=\"img-responsive\" src=\"0.png"."\">";
            echo "</div>";
            echo "</div>";
            echo "<div class=\"row\">";
              echo "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
              echo "<h1>" . "Welcome" ." ".$userRow['firstName']. "!"."</h1>";
              echo "</div>";
              echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-3\">";
              echo "<img class=\"img-responsive\" src=\"".$userRow['photolink'] ."\">";
              echo "<a href=\"logout.php?logout\">Sign Out</a>";
              echo "</div>";
              echo "</div>";
            ?>

   <!-- <?php
    /*  $sql = "SELECT * FROM book";
      $result = $conn->query($sql);
            if($result->num_rows > 0){
            while ($row = $result-> fetch_assoc()) {
                echo "<a href='profile.php?id=" . 
                                $row[ISBN] . 
                                            "'>" . 
                             $row["titel"]. "</a>"."<br>";
  }
}else{
  echo "no result";
}*/

?>-->

             <?php   
           
              $sqlstatement = "SELECT * FROM book";
              $photos = mysqli_query($conn,$sqlstatement);
              $linkArray = Array();
              $counter = 0;

              $row = mysqli_fetch_array($photos, MYSQLI_NUM);
              while ($row != NULL){
                 $id = $row[0];
                echo "<div class=\"row imgrow\">";
                  echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\">";
                     echo "<img class=\"img-responsive\" src=\"".$row[5] ."\">";
                echo "</div>";
                  echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\">";
                    echo "<a id=\"title\" href='profile.php?id=" . $row[0] . "'>" . $row[1]. "</a>"."<br>";
                    echo "<p>".$row[2]."</p>";
                    echo '<button class="delete_video" value="'.$id.'" id="'.$videoId.'" type="button">Delete</button>';
                    echo "</div>";
                /*  echo "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3\">";
                    echo "<p>".$row[3]."</p>";
                  echo "</div>";*/
                echo "</div>";
                $linkArray[$counter] = $row[0];
                $counter += 1;
                $row = mysqli_fetch_array($photos, MYSQLI_NUM);
              }
              echo "</div>";
             // var_dump($_SESSION);
        

              

            ?>

<script>
            $(document).ready(function(){
            $("#submit").click(function(){
            var ISBN = $("#ISBN").val();
            var titel = $("#titel").val();
            var author = $("#author").val();
            var status = $("#status").val();
            var description = $("#description").val();
            var photo = $("#photoLink").val();
           var genre = $("#genre").val();
           // console.log(genre);
          // Returns successful data submission message when the entered information is stored in database.
            var dataString = 'ISBN1='+ ISBN;
            var dataString1 = '&titel1='+ titel;
            var dataString2 = '&author1='+ author;
            var dataString3 = '&status1='+ status;
            var dataString4 = '&description1='+ description;
            var dataString5 = '&photoLink1='+ photo;
           var dataString6 = '&genre1='+ genre;
           
            /*var dataString8 = dataString + "&" + dataString1 + "&" + dataString2 + "&" + dataString3 + "&" + dataString4 + "&" + dataString5 + "&" + dataString6;*/
            
            dataString7=dataString;
            dataString7+=dataString1;
            dataString7+=dataString2;
            dataString7+=dataString3;
            dataString7+=dataString4;
            dataString7+=dataString5;
            dataString7+=dataString6;


            //var data = {"name" : name, "position" : position, "salary" : salary};

            if(ISBN==''){
            alert("Please Fill All Fields");
            }else{
            // AJAX Code To Submit Form.
              $.ajax({
                type: "POST",
                url: "exerciseajax.php",
                data: dataString7,
                cache: false,
                success: function(result){
                  alert(result);
                  window.location.reload();
                }
            });
            }
 return false;
       });
      });

    $(document).ready(function()
    {
        $(".delete_video").click(function()
        { console.log("Hallo");
            var del_id = $(this).val();

            console.log(del_id);
            $.ajax({
                type:'POST',
                url:'delete.php',
                data:'delete_id='+del_id,
                cache: false,
                success: function(data)
                {
                  alert(data);
                    window.location.reload();
                }
            });
        });
    });





</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="script-ajax.js" type="text/javascript"></script>
</body>
</html>
<?php ob_end_flush(); ?>