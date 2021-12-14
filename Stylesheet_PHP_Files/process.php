<?php 

include "connections.php";

// ADDING NEW MEMBERS through members page (add new tab)

if(isset($_POST['addMember'])){
    
    $firstName = ucwords($_POST['firstName']);
    $lastName = ucwords($_POST['lastName']);
    $fatherInitial = $_POST['father'];
    $motherInitial = $_POST['mother'];
    $address = $_POST['address'];
    $suburbID = $_POST['suburb'];
    $telephone = "(09)".$_POST['tel1']."-".$_POST['tel2'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $grade = $_POST['grade'];
    $annualFee = $_POST['annualFee'];
    
    $sql = "INSERT INTO 
    members(firstName, lastName, streetAddress, suburbID, fatherInitial, motherInitial, telephone, grade, dateOfBirth, annualFee) 
    VALUES ('$firstName', '$lastName', '$address', '$suburbID', '$fatherInitial', '$motherInitial', '$telephone', '$grade', '$dateOfBirth', '$annualFee')";
    
    //to test if data is entered to the database successfully
    if ($conn->query($sql) === TRUE) {
        echo "Entered details successfully";
        $lastID = $conn->insert_id;
    }
    else {
        echo "Error " .$sql. "<br>" .$conn->error;
    }
    
    // this ensures that the member starts off with 0 points.
    $sql2 = "INSERT INTO memberevents(memberID) VALUES ('$lastID')";
    
    //to test if data is entered to the database successfully
    if ($conn->query($sql2) === TRUE) {
        echo "Member has 0 points.";
    }
    else {
        echo "Error " .$sql2. "<br>" .$conn->error;
    }
}

// ADDING A NEW EVENT 

if(isset($_POST['addEvent'])){
    
    $eventDate = $_POST['eventDate'];
    
    // Inserting the event date into events table before inserting the members
    
    $insertEvent = "INSERT INTO events(eventDate) VALUES     ('$eventDate')";
    
    // ensuring that the event is inserted into the database properly
    
    if ($conn->query($insertEvent) === TRUE) {
        echo "Entered Event successfully. Last ID:";
        $lastID = $conn->insert_id;
        echo $lastID;
        echo "<br>";
        header("Location: ../events.php");
    }
    else {
        echo "Error " .$insertEvent. "<br>" .$conn->error;
    }
    
    $points = $_POST['points'];
    $members = $_POST['eventMember'];
    
    $i = 0;
    $max = count($members); // max is the num of members is being added 
    echo "Max: ".$max;
    
    while($i <= $max){
        
        $insertMembers = "INSERT INTO memberevents(memberID, eventID, points) VALUES('$members[$i]','$lastID','$points[$i]')";
        
        if ($conn->query($insertMembers) === TRUE) {
        echo "Entered Event members successfully.";
        echo "<br>";
        
        }
        else {
            echo "Error " .$insertMembers. "<br>" .$conn->error;
        }
        
        $i++;
    }
}

?>

