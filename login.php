<?php 
include_once("config.php");


if(isset($_POST["Submit"]))
{  

     
          $user=mysqli_real_escape_string($mysqli, $_POST['uname']);  
          $pass=mysqli_real_escape_string($mysqli, $_POST['psw']);
  
          if(empty($user) || empty($pass) )
            {	
			
                if(empty($user)) 
                {
                     echo "<font color='red'>user name field is empty.</font><br/>";
                }
            
                if(empty($pass))
                {
                    echo "<font color='red'>pass field is empty.</font><br/>";
                }
            } 
          else
          {
            $result=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$user' AND pass='$pass'");  
            $numrows= mysqli_num_rows($result);
            if ($numrows=!0)
            {
               while($res= mysqli_fetch_array($result))  //mysqli_fetch_assoc($query))  
                        {
                              $dbusername=$res['username'];  
                              $dbpassword=$res['pass'];  
                        }    
  
                               if($user == $dbusername && $pass == $dbpassword)  
                                 {  
                                     
                                      setcookie("sess_user",$user,time()+60*60*24); 
                                      header("Location: indexlo.php");  
                                  }  
                                 
                                else {  
                                  header("Location: loginfail.html");
                                      } 
              }     
          }            
          
}  
?>  


