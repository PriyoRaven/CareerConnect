<?php
session_start();
if (!isset($_SESSION['mail'])) {
    header("Location: ../../../LoginandRegister/adminLogin.php");
}
?>

<?php
require '../../../../dbconnect.php';

// Pagination parameters
$recordsPerPage = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Search term
$search = isset($_GET['search']) ? $_GET['search'] : '';
$status = "Company shortlisted your application";

// Fetch records for the current page with search
$query = "SELECT a.id, a.profile, a.location, a.duration, i.stipend, p.name, s.F_name, s.L_name, s.dept, s.email, s.start_year, s.end_year, s.pin, s.city, s.state, s.country 
    FROM internship_applied a 
    LEFT JOIN internships i ON a.internship_id = i.id
    LEFT JOIN com_personal_details p ON a.com_id = p.com_id
    LEFT JOIN stu_personal_details s ON a.stu_id = s.stu_id
    WHERE a.status = ? AND CONCAT(a.id, ' ', a.profile, ' ', a.location, ' ', a.duration, ' ', i.stipend, ' ', p.name, ' ', s.F_name, ' ', s.L_name, ' ', s.dept, ' ', s.email, ' ', s.start_year, ' ', s.end_year, ' ', s.pin, ' ', s.city, ' ', s.state, ' ', s.country, ' ') LIKE ? LIMIT ?, ?";
$stmt = mysqli_prepare($conn, $query);
$searchParam = "%" . $search . "%";
mysqli_stmt_bind_param($stmt, "ssii", $status, $searchParam, $offset, $recordsPerPage);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Count total number of records with search
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM internship_applied a 
    LEFT JOIN internships i ON a.internship_id = i.id
    LEFT JOIN com_personal_details p ON a.com_id = p.com_id
    LEFT JOIN stu_personal_details s ON a.stu_id = s.stu_id 
    WHERE a.status = ? AND CONCAT(a.id, ' ', a.profile, ' ', a.location, ' ', a.duration, ' ', i.stipend, ' ', p.name, ' ', s.F_name, ' ', s.L_name, ' ', s.dept, ' ', s.email, ' ', s.start_year, ' ', s.end_year, ' ', s.pin, ' ', s.city, ' ', s.state, ' ', s.country, ' ') LIKE ?";
$stmtTotal = mysqli_prepare($conn, $totalRecordsQuery);
mysqli_stmt_bind_param($stmtTotal, "ss", $status, $searchParam);
mysqli_stmt_execute($stmtTotal);
$totalRecordsResult = mysqli_stmt_get_result($stmtTotal);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
?>

<?php
    if(isset($_POST["Export"])){
         
        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=Intern_Shortlisted_Student.csv');  
        $output = fopen("php://output", "w");  
		
        fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Start Year', 'End Year', 'ZIP Code', 'City', 'State', 'Country', 'Company Name', 'Internship Topic', 'Work Location', 'Duration', 'Stipend'));
        $status = "Company shortlisted your application";  
        $query = "SELECT a.id, s.F_name, s.L_name, s.email, s.start_year, s.end_year, s.pin, s.city, s.state, s.country, p.name, a.profile, a.location, a.duration, i.stipend 
                FROM internship_applied a 
                LEFT JOIN internships i ON a.internship_id = i.id
                LEFT JOIN com_personal_details p ON a.com_id = p.com_id
                LEFT JOIN stu_personal_details s ON a.stu_id = s.stu_id
                WHERE a.status = '$status'
                ORDER BY a.id DESC" ;  
        $result = mysqli_query($conn, $query);  
        while($row = mysqli_fetch_assoc($result))  
        {  
             fputcsv($output, $row);  
        }  
        fclose($output);
        exit();  
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intern Shortlisted Student</title>
    <link rel="stylesheet" href="../applications/newlist.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/f540fd6d80.js" crossorigin="anonymous"></script>
    <script src="../../../../javaScripts/tableascdesc.js"></script>
</head>

<body>
    <div class="heading1">
        <h1>Intern Shortlisted Student</h1>
    </div>
    <a href="../shortlistandselected.php">
        <div class="regallclosebtn"><i class="fa-solid fa-caret-left" title="back to dashboard"></i></div>
    </a>
    <div class="search-container">
        
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search by anything" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>

        <div>
            <form action="#" method="post" name="upload_excel" enctype="multipart/form-data">
                <input type="submit" name="Export" class="regallexportbtn" value="Export to excel"/>                   
            </form>           
        </div>

    </div>
    <div class="whole-body">
        <div class="inner-whole-body">
            <table class="tablebody" border="1">
                <tr>
                    <th onclick="sortTable(0)" data-column="0">UID<span class="sort-icon"></span></th>
                    <th onclick="sortTable(1)" data-column="1">Student Name<span class="sort-icon"></span></th>
                    <th onclick="sortTable(2)" data-column="2">Department<span class="sort-icon"></span></th>
                    <th onclick="sortTable(3)" data-column="3">Email<span class="sort-icon"></span></th>
                    <th onclick="sortTable(4)" data-column="4">Batch<span class="sort-icon"></span></th>
                    <th onclick="sortTable(5)" data-column="5">ZIP Code<span class="sort-icon"></span></th>
                    <th onclick="sortTable(6)" data-column="6">City<span class="sort-icon"></span></th>
                    <th onclick="sortTable(7)" data-column="7">State<span class="sort-icon"></span></th>
                    <th onclick="sortTable(8)" data-column="8">Country<span class="sort-icon"></span></th>
                    <!-- company personal details table -->
                    <th onclick="sortTable(9)" data-column="9">Company Name<span class="sort-icon"></span></th>
                    <!-- internship applied table -->
                    <th onclick="sortTable(10)" data-column="10">Internship Topic<span class="sort-icon"></span></th>
                    <th onclick="sortTable(11)" data-column="11">Work Location<span class="sort-icon"></span></th>
                    <th onclick="sortTable(12)" data-column="12">Duration<span class="sort-icon"></span></th>
                    <!-- internship table -->
                    <th onclick="sortTable(13)" data-column="13">Stipend<span class="sort-icon"></span></th>
                </tr>

                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['F_name'] . " " . $row['L_name'] . "</td>";
                        echo "<td>" . $row['dept'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['start_year'] . " - " . $row['end_year'] . "</td>";
                        echo "<td>" . $row['pin'] . "</td>";
                        echo "<td>" . $row['city'] . "</td>";
                        echo "<td>" . $row['state'] . "</td>";
                        echo "<td>" . $row['country'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['profile'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "<td>" . $row['duration'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='14'>No records found.</td></tr>";
                }
                ?>
            </table>
            
            </div>
            
        </div>
        <div class="pagination-container">
                <?php
                // Display pagination links
                $totalPages = ceil($totalRecords / $recordsPerPage);
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $totalPages; $i++) {
                    $activeClass = $i == $page ? 'active' : '';
                    echo "<a class='$activeClass' href='?page=$i&search=$search'>$i</a>";
                }
                echo "</div>";
                ?>
                <div class="record-info">
                    <?php
                    // Display number of records in the current page out of all records
                    $startRecord = ($page - 1) * $recordsPerPage + 1;
                    $endRecord = min($page * $recordsPerPage, $totalRecords);
                    echo "Showing $startRecord - $endRecord of $totalRecords records.";
                    ?>
                </div>
    </div>
    
    <!-- script links -->
</body>

</html>
