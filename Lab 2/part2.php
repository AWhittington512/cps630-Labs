<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="part2.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
        rel="stylesheet"
        />
        <title>Lab02</title>
    </head>
    <body>
        <?php
            // Takes query and returns resulting array from database
            function get_data($sql) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "testnew";

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //echo "Connected successfully<br>";

                    //$sql = "SELECT * FROM StRec";
                    $result = $conn->query($sql)->fetchAll();

                    $conn = null; // end connection
                    return $result;
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
            }
        ?> 
		<div class="heading">
			<h1>Student Records 👨‍🎓</h1>
		</div>

        <div class="container">
			<h3>Students</h3>
			<!-- <form action="part2.php" method="post">
				<div class="inp">
					<label>table name:</label>
					<input type="text" name="table-name">
				</div>	
				<div class="inp">
					<label>field 1:</label>
					<input type="text" name="field1">
				</div>
				<div class="inp">
					<label>field 2:</label>
					<input type="text" name="field2">
				</div>	
				<div class="inp">
					<label>field 3:</label>
					<input type="text" name="field3">
				</div>
				<input type="submit" name="create-table" value="create table" />
			</form> -->
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>

                <?php
                    $result = get_data("select * from StRec");
                    foreach ($result as $row) {
                        echo "<tr><td>".$row["StudentID"]."</td><td>".$row["FirstName"]." ".$row["LastName"]."</td><td>".$row["Email"]."</td></tr>";
                    }
                ?>
            </table>
		</div>

        <div class="container">
            <h3>Course Offerings</h3>
            <table>
                <tr>
                    <th>Semester</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Professor</th>
                    <th>Department</th>
                </tr>

                <?php
                    $result = get_data("select O.Semester, C.CourseCode, C.CourseName, C.Dept, O.Prof from Courses C, CourseOfferings O where C.CourseCode = O.CourseCode order by O.Semester asc, C.Dept asc");
                    foreach ($result as $row) {
                        echo "<tr><td>".$row["Semester"]."</td><td>".$row["CourseCode"]."</td><td>".$row["CourseName"]."</td><td>".$row["Prof"]."</td><td>".$row["Dept"]."</td></tr>";
                    }
                ?>
            </table>
        </div>

        <div class="container">
			<h3>Courses taught by Prof. Smith</h3>
            <table>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Department</th>
                    <th>Semester Offered</th>
                </tr>

                <?php
                    $result = get_data("select C.CourseCode, O.Prof, C.Dept, O.Semester, C.CourseName from Courses C, CourseOfferings O where C.CourseCode = O.CourseCode and O.Prof = 'Smith'");
                    foreach ($result as $row) {
                        echo "<tr><td>".$row["CourseCode"]."</td><td>".$row["CourseName"]."</td><td>".$row["Dept"]."</td><td>".$row["Semester"]."</td></tr>";
                    }
                ?>
            </table>
		</div>

        <div class="container">
			<h3># of students in each major</h3>
            <table>
                <tr>
                    <th>Major</th>
                    <th>Student Count</th>
                </tr>

                <?php
                    $result = get_data("select Major, count(*) as Ct from StRec group by Major order by Ct desc, Major asc");
                    foreach ($result as $row) {
                        echo "<tr><td>".$row["Major"]."</td><td>".$row["Ct"]."</td></tr>";
                    }
                ?>
            </table>
		</div>

		<!-- <div class="button-container">
			<input type="submit" name="show-records" value="show records" />
		</div> -->
	</body>

</html>
