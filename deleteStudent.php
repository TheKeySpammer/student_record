<?php
$redirect_url = "display.php";
$stdID = $_POST['student_id'];
@$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
if(!mysqli_connect_errno()){
    $query = "DELETE FROM std_record
              WHERE StudentId=?
    ";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $stdID);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        // Redirect to display page
        header("Location: ".$redirect_url);
    }else{
        // Error handling
        echo "Erorr while deleting";
    }
}
$db->close();
?>
