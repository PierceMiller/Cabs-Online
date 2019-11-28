function xhrRequest() {
    var xhr = false;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhr;
}
var xhr = xhrRequest();

function assignDriver() {
  	//assigns the id to booking refrence 
    var bookingR = document.getElementById("ref_num").value;
    bookingData = {
        bookingR,
        bookingR
    };
    sendBookingNum(bookingData);
}
//sends refrence number to database to be checked
function sendBookingNum(num) {
    if (xhr) {
        xhr.open("POST", "assignCab.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("assignTaxi").innerHTML = xhr.responseText;

            } else {
                xhr.onerror = function() {
                    alert(xhr.responseText);
                }
            }
        }

        //send all the booking info to php via post
        xhr.send("bookingR=" + num.bookingR);
    }

}