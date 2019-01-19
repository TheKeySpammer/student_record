<?php
$redirect_url = "display.php";
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$grade = $_POST['grade'];
$stdID = $_POST['student_id'];
if(!$name || !$mobile || !$grade){
    // Error handling will be done here
    echo "Error: Blank Form Details";
}else{
    @$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
    if(!mysqli_connect_errno()){
        $query = "UPDATE std_record
                  SET Name=?, MobileNumber=?, Grade=?
                  WHERE StudentId=?
        ";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssi', $name, $mobile, $grade, $stdID);
        $stmt->execute();
    
        if($stmt->affected_rows > 0){
            // Redirect to display page
            header("Location: ".$redirect_url);
        }else{
            // Error handling
        }
    }
}
$db->close();
?>
