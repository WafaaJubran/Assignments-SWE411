<?php
	session_start();
?>
<html>
    <head>
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
       <?php 

       $username = $_SESSION['username'];
       $email = $_SESSION['email'];
       $password = $_SESSION['password'];
       $remember = $_SESSION['remember'];

   ?>

    <table>
<tr>
     <td class="red"> <b> Username </b> </td> 
  <td> <?php echo $username; ?> </td>
</tr>

<tr>
     <td class="red"> <b> Email </b> </td> 
  <td> <?php echo $email; ?> </td>
</tr>

<tr> 
    <td class="red"> <b> Password </b> </td> 
  <td> <?php echo $password; ?> </td>
</tr>


<tr> 
    <td class="red"> <b> Remember me? </b></td> 
  <td> <?php echo $remember; ?> </td>
</tr>


</table>

    </body>
</html>
