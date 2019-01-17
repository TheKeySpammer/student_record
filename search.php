<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Search</title>
    </head>
    <body>
        <h3>Search student record</h3>
        <form class="student_form" action="search_result.php" method="post">
            <select name="search">
                <option value="s_id">student_id</option>
                <option value="name">Name</option>
                <option value="mobile_no">mobile number</option>
                <option value="grade">grade</option>
            </select>
            <p> <strong>Query</strong> </p>
            <input type="text" name="name" required = true>
            <input type="submit" name="submit" value="Submit">
        </form>
    </body>
</html>
