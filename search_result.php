<?php
require("partials/header.html");
$queryType = $_GET['queryType'];
$queryText = $_GET['queryText'];
if(!$queryType || !$queryText){
    // Empty Query Error
    echo "Empty query error";
}else{
switch($queryType){
    case "name":
    case "mobile_number":
    case "grade": break;
    default:
        // Wrong query type error
        echo "Wrong query type error";
}
// Create a connection to MySQL database on localhost
$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
if(!mysqli_connect_errno()){
    $query = "SELECT Name, MobileNumber, Grade FROM std_record
                WHERE $queryType=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $queryText);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($std_name, $mobile_number, $grade);
    $result_count = $stmt->num_rows;
    if($result_count > 0){
        ?>
<h2 id="record_heading">Search Result</h2>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="row justify-content-center">
            <div class="col-8" id="student_list">

                <?
        while($stmt->fetch()){
            // Show resuts Over here
            ?>
                <h3 class="my-4 student_name">
                    <? echo $std_name ?>
                </h3>
                <div class="student_data container">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Mobile Number</h5>
                            <p class="card-text">
                                <?echo $mobile_number?>
                            </p>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Grade</h5>
                            <p class="card-text">
                                <?echo $grade?>
                            </p>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editStudentData">Edit</button>
                            <!-- Add edit student modal -->
                            <div class="modal fade" id="editStudentData" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editStudentModalLabel">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="editstudent.php" method="post">
                                                <div class="form-group row">
                                                    <label for="editStudentName" class="col-sm-2 col-form-label">Name:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="editStudentName"
                                                            name="name" require=true value="<?echo $std_name?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="editStudentMobile" class="col-sm-2 col-form-label">Contact:</label>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <div class="input-group-prepen">
                                                                <div class="input-group-text">
                                                                    +91
                                                                </div>
                                                            </div>
                                                            <input type="text" class="form-control" id="editStudentMobile"
                                                                maxlength="10" name="mobile" require=true value="<?echo $mobile_number?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="editStudentGrade" class="col-sm-2 col-form-label">Grade:</label>
                                                    <div class="col-sm-10">
                                                        <select name="grade" id="editStudentGrade" class="form-control">
                                                            <option value="<?echo $grade?>">
                                                                <?echo $grade?>
                                                            </option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="text" name="student_id" class="d-none" value="<?echo $std_id?>">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary" value="Save changes">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="deleteStudent.php" method="post" class="d-inline">
                                <input type="text" name="student_id" class="d-none" value="<?echo $std_id?>">
                                <input type="submit" name="SubmitDelete" class="btn btn-sm btn-danger" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                }  // While close
                ?>
            </div>
        </div>
    </div>
</div>
<?
    }
    else{
        // No result found
        ?>
<h2 id="record_heading">No matching result</h2>
<?
    }

?>
<?php
}else{
    // DB CONNECTION ERROR
    echo "Databsae connection error";
}
$db->close();
}
require("partials/footer.html");
?>