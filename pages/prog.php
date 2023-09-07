<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fggs_rs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//$id = $_GET['id'];

$prog = $conn->query("SELECT * FROM project_progress natural join project_division where project_id = '$id' ");
    $prog2 = $conn->query("SELECT SUM(progress) as total FROM project_progress natural join project_division where project_id = '$id' ");
    $progress2 = $prog2 ->fetch_assoc();
$total = $progress2['total'] / $prog->num_rows ;
$tots= number_format($total,0);
              $colors='rgba(0, 241, 5, 0.39)';  
            
        echo '{"progress":'.'"'. $tots.'"'.','.'"name":"Total"'.','.'"color":"'. $colors.'"}';
 	 
	



$conn->close();

?>
<!-- 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fggs_rs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



	$prog = $conn->query("SELECT * FROM project_progress natural join project_division where project_id = '$id' ");
    while($progress = $prog ->fetch_assoc()){

    $name = $progress['division'];
	$count = $progress['progress'];

	if ($prog && $prog->num_rows > 0)
	{

        if($count <= 50){
            $color='rgba(251, 159, 118, 0.53)';
            }elseif ($count > 50  ) {
              $color='rgba(120, 151, 239, 0.53)';  
            }
			$array[] ='{"progress":'.'"'.$count.'"'.','.'"name":"'. $name.'"'.','.'"color":"'. $color.'"}';
        
				
			
		
	}
	else
	{
		 $array[] ='{"progress":"0","name":"0"}';
		
	}
    $prog2 = $conn->query("SELECT SUM(progress) as total FROM project_progress natural join project_division where project_id = '$id' ");
    $progress2 = $prog2 ->fetch_assoc();
$total = $progress2['total'] / $prog->num_rows ;
$tots= number_format($total,0);
              $colors='rgba(0, 241, 5, 0.39)';  
            
        $data2 = ',{"progress":'.'"'. $tots.'"'.','.'"name":"Total"'.','.'"color":"'. $colors.'"}';
 	 
	
}



$conn->close(); -->