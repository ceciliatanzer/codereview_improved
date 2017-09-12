<?php 

$id = $_POST['delete_id'];
include('dbconnect.php');
echo var_dump($_POST);
echo $id . "<br>";

$sql=('DELETE FROM book WHERE ISBN = "'.$id.'"');

if (mysqli_query($conn,$sql)){
	echo "delete";
}
else {echo "Error" .$sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>