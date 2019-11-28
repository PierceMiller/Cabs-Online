//XMLHttpRequest object
		function xhrRequest() {
			var xhr = false;  
			if (window.XMLHttpRequest) {
				
				xhr = new XMLHttpRequest();
			}
			else if (window.ActiveXObject) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
			return xhr;
		}
		var xhr = xhrRequest();
	//load booking will be sent to the php and used as key to start a condition in the php file
function pickUpRequests(){
	
	var status ="loadBooking"; 
	statusData={status,status};
	requestBookingnfo(statusData);
}

function requestBookingnfo(temp){
			if (xhr) {
			
				xhr.open("POST", "passengerStatus.php", true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						document.getElementById("pickup_request").innerHTML = xhr.responseText;
						
						
					}
						
					else{
						//error message indicating fault in xhr object
						xhr.onerror = function(){ alert (xhr.responseText); }
					}
				}
				
				console.log(); 
				
				//send all the booking info to php via post
				xhr.send("status="+temp.status);
			}
			
				
		}