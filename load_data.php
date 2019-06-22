

<?php  
 //load_data.php  
 $connect = mysqli_connect("localhost", "root", "root", "news_app");  
 $output = '';  
 if(isset($_POST["region_id"]))  
 {  
      if($_POST["region_id"] != '')  
      {  
           $sql = "SELECT * FROM newspaper WHERE region_id = '".$_POST["region_id"]."'";  
      }  
      else  
      {  
           $sql = "SELECT * FROM newspaper";  
      }  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["title"].', '.$row["country"].'</div></div>';  
      }  
      echo $output;  
 }  
 ?> 

