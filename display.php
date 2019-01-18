<?php
require("partials/header.html");

// Create a connection to MySQL database on localhost
$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
if(mysqli_connect_errno()){
?>  
    <!-- Displaying error message if connection not successful -->
    <div class="text-center"> 
    <h2 class="alert alert-danger">
        Something went wrong with the database. Please Try again later.
    </h2>
    <a href="index.html" class="btn btn-primary">Go Back</a>
    </div>
    <?php
}else{
?>
<div class="jumbotron text-center">
    <h3 class="display-2 mb-3">Student Records</h3>
    <div class="row">
    <div class="col">
    <!-- This button Create a modal form to add new Student -->
        <button type="button" class="btn btn-primary btn-lg rounded-pill ml-3" data-toggle="modal" data-target="#AddStudentModal"><i class="fas fa-plus-circle mr-2"></i>Add Student</button>
        <!-- Add Student Modal -->
        <div class="modal fade" id="AddStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="addstudent.php" method="post">
                        <div class="form-group row">
                            <label for="addStudentName" class="col-sm-2 col-form-label">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="addStudentName" name="name" require=true>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addStudentMobile" class="col-sm-2 col-form-label">Contact:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepen">
                                        <div class="input-group-text">
                                            +91
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="addStudentMobile" maxlength="10" name="mobile" require=true>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="addStudentGrade" class="col-sm-2 col-form-label">Grade:</label>
                            <div class="col-sm-10">
                                <select name="grade" id="addStudentGrade" class="form-control">
                                    <option value="">-Select-</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value = "Add">
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "col d-flex justify-content-start">
    <!-- This opens a Modal form to search a Student record -->
        <button type="button" class="btn btn-success rounded-pill btn-lg mr-3" data-toggle="modal" data-target="#SearchQueryModal"><i class="fas fa-search mr-2"></i>Search</button>
    </div>
    </div>
</div>

<h2 id="record_heading">List of archived students</h2>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="row justify-content-center">
            <div class="col-8" id="student_list">
                <?php
                // Displaying student records 
                $query = "select Name, MobileNumber, Grade from std_record";
                $stmt = $db->prepare($query);
                if($stmt->execute()){
                $stmt->bind_result($std_name, $mobile_number, $grade);
                while($stmt->fetch()){
                ?>
                <h3 class="my-4 student_name"><? echo $std_name ?></h3>
                <div class="student_data container">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title">Mobile Number</h5>
                            <p class="card-text"><?echo $mobile_number?></p>
                        </div>
                        <div class="col">
                            <h5 class="card-title">Grade</h5>
                            <p class="card-text"><?echo $grade?></p>
                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
<?php
$db->close();
require("partials/footer.html");
?>