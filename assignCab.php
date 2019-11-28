<?php
error_reporting(0);
require_once("Configure/settings.php");

$db = mysqli_connect($servername, $username, $password, $dbname) OR die(' Error unable to connect to cab booking database'); //replies back to user if connection was unsucessful 
$bookingRef = $_POST['bookingR'];
if ($bookingRef > 0) {
    $result = mysqli_query($db, "SELECT booking_status FROM cabbooking WHERE booking_number ='$bookingRef'");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) //loops through the returned rows
            { 
            $bookingstat = $rows["booking_status"];
            if ($bookingstat == "unassigned") {
		//when a user requests to see the rides within the next 2 hours, a table is created as a response for each ride
                $result = mysqli_query($db, "UPDATE cabbooking SET booking_status='assigned' WHERE booking_number='$bookingRef'");
                echo "<table border='4' class='stats' cellspacing='0' align='center'>
						<tr>
						<td class='hed' colspan='1'>Assign Booking Response</td>
						  </tr>
						<tr>
						</tr>";
                echo "<tr>";
                echo "<td>" . "The booking request $bookingRef has been properly assigned. " . "</td>";
                echo "</tr>";
                echo "</table>";
            } else {
                echo "<table border='4' class='stats' cellspacing='0' align='center'>
						<tr>
						<td class='hed' colspan='1'>Assign Booking Response</td>
						  </tr>
						<tr>
						</tr>";
                echo "<tr>";
                echo "<td>" . "A driver has already been assigned to this job please refresh and input a valid booking number" . "</td>";
                echo "</tr>";
                echo "</table>";
            }
        }
    } else {
        echo "<table border='4' class='stats' cellspacing='0' align='center'>
						<tr>
						<td class='hed' colspan='1'>Assign Booking Response</td>
						  </tr>
						<tr>
						</tr>";
        echo "<tr>";
        echo "<td>" . "Please enter a valid booking reference" . "</td>";
        echo "</tr>";
        echo "</table>";
    }
} else {
    echo "<table border='4' class='stats' cellspacing='0' align='center'>
						<tr>
						<td class='hed' colspan='1'>Assign Booking Response</td>
						  </tr>
						<tr>
						</tr>";
    echo "<tr>";
    echo "<td>" . "Please enter a valid booking reference" . "</td>";
    echo "</tr>";
    echo "</table>";
}
?>

