<?php
require_once 'php/connection.php';
require_once 'php/config.php';

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: login.php?not_logged_in=1');
}

$user_ID = $_SESSION['gebruikerID'];

$sql = "SELECT * FROM gebruikers WHERE gebruikerID = '$user_ID'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_ID = $row["gebruikerID"];
    $firstname = $row["voornaam"];
    $lastname = $row['achternaam'];
    $username = $row["gebruikersnaam"];
}
// Check if the form was submitted
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $timeslot = $_POST['time_slot'];
    $people = $_POST['Person'];
    $sqldate=date('Y-m-d',strtotime($date));

    $sql = "INSERT INTO reserveringen (datum, tijdslot, gebruikersnaam, gebruikerID, personen) VALUES ('$sqldate', '$timeslot', '$username', '$user_ID', '$people')";


    if ($connection->query($sql) === TRUE) {
          // send an email to the user that the account has been created
        $sql = "SELECT email FROM gebruikers WHERE gebruikerID = '$user_ID'"; 
        $email_result = $connection->query($sql);
        $email_row = $email_result->fetch_assoc();
        $email = $email_row["email"];

        $to = $email;
        $subject = "Your SKI.I.P. reservation is confirmed!";
        $message = "Hi $firstname $lastname, <br><br> Your SKI.I.P. reservation is confirmed!<br><br> <strong>Reservation details:</strong><br>Date: $date <br> Timeslot: $timeslot <br> Amount of spaces: $people <br><br> If you want to cancel or get an overview of all your reservations click ou want to change your password you can click <a href=\"https://webtech-ki59.webtech-uva.nl/loggedin-myreservations.php\">here</a> <br>The SKI.I.P. team";
        $message = wordwrap($message, 70, "\r\n");
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        $headers .= 'From: SKI.I.P. <noreply@skiip.com>';
        mail($to, $subject, $message, $headers);
        header('Location: loggedin-reservation.php?status=success');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reservations</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- API-key-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7tTtgSMOA_yFVqkh1zFZrpvouCorDXvE&callback=initMap"
    async defer></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
<!-- Navbar Start -->
<div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
        <a href="loggedin-index.php" class="navbar-brand px-lg-4 m-0">
            <h1 class="m-0 display-4 text-uppercase text-white">Ski. I. P.</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto p-4">
                <a href="loggedin-index.php" class="nav-item nav-link">Home</a>
                <a href="loggedin-reservation.php" class="nav-item nav-link active">Reserve</a>
                <a href="loggedin-about.php" class="nav-item nav-link">About</a>
                <a href="loggedin-account.php" class="nav-item nav-link">Account</a>
                <a href="loggedin-myreservations.php" class="nav-item nav-link">My Reservations</a>
                <a href="php/logout.php" class="nav-item nav-link">Log Out</a>               
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Reservation</h1>
        <div class="d-inline-flex mb-lg-5">
            <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
            <p class="m-0 text-white px-2">/</p>
            <p class="m-0 text-white">Reservation</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


    <!-- Reservation Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-6 my-5 my-lg-0">
                        <div class="row">
                            <div class="col-md-12 pb-5">
                                <div id="map" style="height:400px;width:100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                            <h1 class="text-white mb-4 mt-5">Book Your Skilift</h1>
                            <form action='loggedin-reservation.php' method='post' class="mb-5">
                                <div class="form-group">
                                    <div class="date" name="date" id="date" type="date" data-target-input="nearest">
                                        <input type="text" name="date" id="date" class="form-control bg-transparent border-primary p-4 datetimepicker-input" placeholder="Date" data-target="#date" data-toggle="datetimepicker"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="time_slot" id="time_slot" class="custom-select bg-transparent border-primary px-4" style="height: 49px;">
                                        <option value="">Select a time slot</option>
                                        <?php
                                        $start = strtotime('10:00am');
                                        $end = strtotime('5:00pm');
                                        for ($i = $start; $i <= $end; $i += 900) {
                                            $time = date('H:i', $i);
                                            echo "<option value='$time'>$time</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="Person" id="time_slot" class="custom-select bg-transparent border-primary px-4" style="height: 49px;">
                                        <option selected>Person</option>
                                        <?php
                                        for ($i = 1; $i <= 10; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div>
                                    <button class="btn btn-primary btn-block font-weight-bold py-3" type="submit" name="submit">Book Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation End -->
    
    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Get In Touch</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Science Park 904, Amsterdam</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+31 6 12345678</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>Skiliftreservations@gmail.com</p>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Domain</a>. All Rights Reserved.</a></p>
            <p class="m-0 text-white">Designed by <a class="font-weight-bold" href="https://htmlcodex.com">HTML Codex</a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Google API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7tTtgSMOA_yFVqkh1zFZrpvouCorDXvE&callback=initMap"></script>

    <script>
        function initMap() {
          var map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 45.892417, lng: 7.540064 },
            zoom: 8
          });
        
        var marker = new google.maps.Marker({
    position: {lat: 45.892417, lng: 7.540064},
    map: map,
    title: 'Pian della Volpe ski lift '
});
        }
      </script>

<?php
if (isset($_GET['status'])){
    if ($_GET['status'] == 'success') {
        echo("<script type='text/JavaScript'> 
        alert(`Your reservation has been made!`); 
        </script>");
    }
    }
?>
</body>

</html>
