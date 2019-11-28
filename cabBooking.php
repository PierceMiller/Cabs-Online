<?php
	
	require_once ("Configure/settings.php");    
	
	$db = mysqli_connect($servername,$username,$password,$dbname) 
	OR die(' Error unable to connect to cab booking database'); //replies back to user if connection was unsucessful 
	
	$name = $_POST['name'];  
	$phoneNum = $_POST['phone_num'];
	$streetNum = $_POST['street_num'];  
	$streetName = $_POST['street_name']; 
	$suburb = $_POST['suburb'];   
	$destination = $_POST['destination'];  
	$pickupDate =$_POST['pickup_date'];  
	$pickupTime = $_POST['pickup_time'];	
	$bookingStatus = "unassigned";
	
	$displayDate = date("d-m-Y",strtotime($_POST['pickup_date']));
	$displayTime = date("H:i A",strtotime($_POST['pickup_time']));
	
	$bookingNum = "";
	
	date_default_timezone_set('Pacific/Auckland');
	$processedDate = date('Y/m/d');
	$processedTime = date('H:i');
	

	 //searches if table cabbooking exsists if not, initializes the table
	if(!mysqli_query($db,"DESCRIBE `cabbooking`")) 
	{	
		mysqli_query($db,"CREATE TABLE cabbooking( `booking_number` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
							   `name` VARCHAR(20) NOT NULL , 
							   `phone_number` INT NOT NULL,
							   `street_number` INT NOT NULL ,
							   `street_name` VARCHAR(100) NOT NULL , 
							   `suburb` VARCHAR(100) NOT NULL ,
							   `destination` VARCHAR(100) NOT NULL,
							   `booking_date` DATE NOT NULL , 
							   `booking_time` TIME(6) NOT NULL ,
							   `booking_status` VARCHAR(20) NOT NULL,
							   `processed_date` DATE NOT NULL , 
							   `processed_time` TIME(6) NOT NULL ) ENGINE = InnoDB;");
		mysqli_query($db,"INSERT INTO cabbooking (name,
							  phone_number,
							  street_number,
							  street_name,
							  suburb,
							  destination,
							  booking_date,
							  booking_time,
							  booking_status,
							  processed_date,
							  processed_time ) VALUES ('$name',
										   '$phoneNum',
          									   '$streetNum',
										   '$streetName',
										   '$suburb',
										   '$destination',
								                   '$pickupDate',
										   '$pickupTime',
										   '$bookingStatus',
										   '$processedDate',
										   '$processedTime' )");
		
		//gets last inputted primary key/booking number from table and assigns it to booking num
		$bookingNum =mysqli_insert_id($db);
		
		
						echo"<table border='4' class='stats' cellspacing='0' align='center'>

						<tr>
						<td class='hed' colspan='1'>Cab Booking Response</td>
						  </tr>
						<tr>
						
						

						</tr>";

						  echo "<tr>";
						  echo "<td>" . "Thank you! Your booking reference number is $bookingNum You will be picked up in front of your provided address at $displayTime on $displayDate. Please press refresh to create a new booking" . "</td>";
						 

						  echo "</tr>";

						 

						echo "</table>";
		
	
		
	}
	else 
	{ 	
		
		//message when booking is complete
		mysqli_query($db,"INSERT INTO cabbooking (name,
							  phone_number,
							  street_number,
							  street_name,
							  suburb,
							  destination,
							  booking_date,
							  booking_time,
							  booking_status,
							  processed_date,
							  processed_time ) VALUES ('$name',
										   '$phoneNum',
          									   '$streetNum',
										   '$streetName',
										   '$suburb',
										   '$destination',
								                   '$pickupDate',
										   '$pickupTime',
										   '$bookingStatus',
										   '$processedDate',
										   '$processedTime' )");
		$bookingNum =mysqli_insert_id($db);
		
		
						echo"<table border='4' class='stats' cellspacing='0' align='center'>

						<tr>
						<td class='hed' colspan='1'>Cab Booking Response</td>
						  </tr>
						<tr>
						
						

						</tr>";

						  echo "<tr>";
						  echo "<td>" . "Thank you! Your booking reference number is $bookingNum You will be picked up in front of your provided address at $displayTime on $displayDate. Please press refresh to create a new booking" . "</td>";
						 

						  echo "</tr>";

						 

						echo "</table>";
		
	
	}
	
	
	

?>


