<?php

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $des_lay = $_POST['des_lay'];
    $conqual = $_POST['conqual'];
    $lospeed = $_POST['lospeed'];
    $mobres = $_POST['mobres'];
    $ux = $_POST['ux'];
    $access = $_POST['access'];
    $source = $_POST['source'];
    $suggestions = $_POST['suggestions'];

    $conn = new mysqli('localhost:3310', 'root', '', 'feedback');

    if($conn->connect_error){
        die('Connection Failed: ' .$conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("Insert into feedback_form(fullname, email, des_lay, conqual, lospeed, mobres, ux, access, source, suggestions) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiiiiiss", $fullname, $email, $des_lay, $conqual, $lospeed, $mobres, $ux, $access, $source, $suggestions);
        $stmt->execute();
        echo "Feedback form submitted successfully <br>";
        $stmt->close();
        $conn->close();
    }

    $to_email = $_POST['email'];
    $subject = "Acknowledgement";
    $body = "Thank you for using OS Web Simulators. The developers of Team3 have recieved your feedback and assure you to refine thier website based on it.
    
    The list of your responses is given below-
    
    Name: $fullname
    Email ID: $email
    Design and Layout score: $des_lay
    Content Quality score: $conqual
    Loading Speed score: $lospeed
    Mobile Responsiveness score: $mobres
    User Experience score: $ux
    Source of Awareness: $source
    Suggestions: $suggestions
    
    Hope you visit again : )";
    $headers = "From: malhar311002@gmail.com";

    if(mail($to_email, $subject, $body, $headers)){
        echo "Email sent successfully to: $to_email";
    }

    else{
        echo "Email not sent successfully. <br>";
    }

    header("Location: Thankyou.html");
    exit();

?>