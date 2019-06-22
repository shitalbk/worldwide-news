
<?php   
 //load_data_select.php  
 $connect = mysqli_connect("localhost", "root", "root", "news_app");  
 function region($connect)  
 {  
      $output = '';  
      $sql = "SELECT * FROM region";    
      $result = mysqli_query($connect, $sql);  
     while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["region_id"].'">'.$row["region_name"].'</option>';  
      }  
      return $output;      
 }  
 function newspaper($connect)  
 {   
      $output = '';  
      $sql = "SELECT * FROM newspaper";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-3">';   
           $output .= '<div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["title"].',  '.$row["country"].''; 
           $output .=     '</div>';  
           $output .=     '</div>';   
      }  
     
      return $output;  
 } 
 
 ?> 
<!DOCTYPE html>
<html>
    <head>
        <title>My News App</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            
                body{
                    
                    margin-left: 900px;
                }
               
        
        </style>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
    </head>
    <body>
        <h3>WNWS</h3>
        <h2>Worldwide News App</h2>
        <form>
             <label>Select a region: </label>
             <select name = "region" id="region">
               <option value = "  ">All</option>
               <?php echo region($connect); ?>   
             </select>
             <br/><br/>
            <div class="row" id="show_news">  
                          <?php echo newspaper($connect);?>  
                     </div> 
        </form>
       
    </body>
</html>
  <script>  
 $(document).ready(function(){  
      $('#region').change(function(){  
           var region_id = $(this).val();  
           $.ajax({  
                url:"load_data.php",  
                method:"POST",  
                data:{region_id:region_id},  
                success:function(data){  
                     $('#show_news').html(data);  
                }  
           });  
      });  
 });  
 </script>