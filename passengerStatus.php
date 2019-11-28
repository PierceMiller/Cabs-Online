<?php
require_once("Configure/settings.php");

$db = mysqli_connect($servername, $username, $password, $dbname) OR die(' Error unable to connect to cab booking database');
$status = $_POST['status'];

if ($status == "loadBooking") {
    $result = mysqli_query($db, "SELECT booking_number,
                        name,phone_number,
                        street_number,
                        street_name,
                        suburb,
                        destination,
                        booking_date,
                        booking_time FROM cabbooking WHERE booking_date = CURDATE() AND booking_time > CURTIME() 
                                                    AND booking_time < (CURTIME() + INTERVAL 2 HOUR) 
                                                    AND booking_status = 'unassigned'");
    if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) //loops through the returned rows
            {
            echo "<table border='4' class='stats' cellspacing='0' align='center'>

                        <tr>
                        <td class='hed' colspan='8'>PICK UP REQUESTS WITHIN THE NEXT 2 HOURS</td>
                          </tr>
                        <tr>
                        <th>BOOKING ID</th>
                        <th>NAME</th>
                        <th>STREET NUMBER</th>
                        <th>STREET NAME</th>
                        <th>SUBURB</th>
                        <th>DESTINATION</th>
                        <th>PICKUP DATE</th>
                        <th>PICKUP TIME</th>

                        </tr>";
            
            echo "<tr>";
            echo "<td>" . $rows["booking_number"] . "</td>";
            echo "<td>" . $rows["name"] . "</td>";
            echo "<td>" . $rows["street_number"] . "</td>";
            echo "<td>" . $rows["street_name"] . "</td>";
            echo "<td>" . $rows["suburb"] . "</td>";
            echo "<td>" . $rows["destination"] . "</td>";
            echo "<td>" . date("d-m-Y", strtotime($rows["booking_date"])) . "</td>";
            echo "<td>" . date("H:i:s A", strtotime($rows["booking_time"])) . "</td>";
            
            echo "</tr>";
            echo "</table>";

        }
    } else { //message if no books are present within the next 2 hours
      
        echo "<table border='4' class='stats' cellspacing='0' align='center'>
        <tr>
        	<td class='hed' colspan='1'>Pickup Request Response</td>
        </tr>
        <tr>
        </tr>";
        echo "<tr>";
        echo "<td>" . "No bookings are due within the next two hours" . "</td>";
        echo "</tr>";
        echo "</table>";
    }
}
?>
