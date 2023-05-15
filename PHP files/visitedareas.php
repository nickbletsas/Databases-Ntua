<?php
$customer_id = $_REQUEST["id"];

$sql = "SELECT areas_id, Entrance_Date_Time, Exit_Date_Time
FROM visit AS V, customers AS C, areas AS A
WHERE V.areas_id = A.Area_ID AND V.customer_id = C.NFCID AND NFCID = $customer_id;";


$query = "Select First_Name, Last_Name from customers
where NFCID = $customer_id;";

?>
<!DOCTYPE html>
<meta charset="utf-8">


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Record</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{
                width: 500px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <?php
                            require_once "config.php";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);
                            ?>

                            <h2>Areas visited by: <?php echo $row['First_Name'] . " " . $row['Last_Name'] ?></h2>
                        </div>

                        <?php

                        if ($result = mysqli_query($conn, $sql)) {
                            //echo $result -> num_rows;
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Area ID</th>";
                                echo "<th>Entrance Date Time</th>";
                                echo "<th>Exit Date time</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['areas_id'] . "</td>";
                                    echo "<td>" . $row['Entrance_Date_Time'] . "</td>";
                                    echo "<td>" . $row['Exit_Date_Time'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else {
                                echo "<p class='lead'><em>No records were found.</em></p>";
                            }
                        } else {
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                        }

// Close connection
                        mysqli_close($conn);
                        ?>
                        <p><a href="customers.php" class="btn btn-primary">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
