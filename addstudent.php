<?php
$redirect_url = "display.php";
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$grade = $_POST['grade'];
if(!$name || !$mobile || !$grade){
    // Error handling will be done here
    echo "Error: Blank Form Details";
}else{
    @$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
    if(!mysqli_connect_errno()){
        $query = "INSERT INTO std_record (Name, MobileNumber, Grade) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sss', $name, $mobile, $grade);
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
