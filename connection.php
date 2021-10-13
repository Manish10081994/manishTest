<?php
#Hostname : localhost
#Username : root
#Password : 
#DB Name  : test
$conn = mysqli_connect('localhost','root','','test');
if(!$conn) //check if connected or not
{ ?>
	<div class="alert alert-danger" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Oppsss!</strong> Your database is not connected !
	</div>
<?php }
?>
