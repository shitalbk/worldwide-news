
<?php    
 $connect = mysqli_connect("localhost", "root", "root", "news_app");  
 function region_options()  
 {  
     global $connect;
      $output = '';  
      $sql = "SELECT * FROM region";    
      $result = mysqli_query($connect, $sql);  
     while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["region_id"].'">'.$row["region_name"].'</option>';  
      }  
      return $output;      
 }  
 function news_website_list($region_id = 0)  
 {   
     global $connect;
      $output = '';  
      $sql = "SELECT * FROM newspaper"; 
      if(!empty($region_id)){
          $sql.= " WHERE region_id = '".(int)$region_id."'";
      }
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-4">';   
           $output .= '<div style="border:1px groove #ccc; border-radius:5px; padding:10px; margin-bottom:20px;">'
                   . '<button style="padding:25px;" type="button" class="btn btn-info"><a target="_blank"style="color:white;" href="'.$row["website"].'">'.$row["title"].',  '.$row["country"].'</button>'; 
           $output .=     '</a></div>';  
           $output .=     '</div>';   
      }  
     
      return $output;  
 } 
    
   
 if(isset($_POST["region_id"]))  
 {  
     echo news_website_list($_POST["region_id"]); 
     exit();
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
                    
                    padding-left: 100px;
                    padding-right: 100px;
                    
                }
               h3{
                    padding-left: 590px;
                    font-family: monospace;
                }
                h2{
                    padding-left: 480px;
                }
        
        </style>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
    </head>
    <body>
        <h3 style="font-family: monospace;">WNWS</h3>
        <h2 style="align-content: center; font-family: monospace;">Worldwide News App</h2>
        <form>
             <label>Select a region: </label>
             <select name = "region" id="region">
               <option value = "  ">All</option>
               <?php echo region_options(); ?>   
             </select>
             <br/><br/>
            <div class="row" id="show_news">  
                          <?php echo news_website_list();?>  
                     </div> 
        </form>
       
    </body>
</html>
  <script>  
 $(document).ready(function(){  
      $('#region').change(function(){  
           var region_id = $(this).val();  
           $.ajax({  
                  
                method:"POST",  
                data:{region_id:region_id},  
                success:function(data){  
                     $('#show_news').html(data);  
                }  
           });  
      });  
 });  
 </script>