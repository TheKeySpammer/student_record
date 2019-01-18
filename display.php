<?php
require("partials/header.html");

$db = new mysqli('localhost', 'ursa', 'ulsafar', 'dbLab');
if(mysqli_connect_errno()){
?>
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
        <a href="#" class="btn btn-primary btn-lg rounded-pill ml-3"><i class="fas fa-plus-circle mr-2"></i>Add Student</a>
    </div>
    <div class = "col d-flex justify-content-start">
        <a href="#" class="btn btn-success rounded-pill btn-lg mr-3"><i class="fas fa-search mr-2"></i>Search</a>
    </div>
    </div>
</div>

<h2 id="record_heading">List of archived students</h2>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="row justify-content-center">
        <div class="col-8">
            <?php
            $query = "select Name, MobileNumber, Grade from std_record";
            $stmt = $db->prepare($query);
            if($stmt->execute()){
            $stmt->bind_result($std_name, $mobile_number, $grade);
            while($stmt->fetch()){
            ?>
            <div class="student">
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
                        </div>
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