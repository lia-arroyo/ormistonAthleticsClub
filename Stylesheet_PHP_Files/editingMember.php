<?php

include "connections.php";

// UPDATING/EDITING CURRENT MEMBER'S DETAILS through individual member page

if(isset($_POST['edit'])){
    $ID = $_POST['ID'];
    $newFirstName = ucwords($_POST['newFirstName']);
    $newLastName = ucwords($_POST['newLastName']);
    $newGrade = $_POST['newGrade'];
    $newPhone = $_POST['newPhone'];
    $newAnnualFee = $_POST['newAnnualFee'];
    $newAddress = $_POST['newAddress'];
    $newSuburb = $_POST['newSuburb'];
    $newBirthday = $_POST['newBirthday'];
    $newMother = $_POST['newMother'];
    $newFather = $_POST['newFather'];
    
    $editSQL = "UPDATE members SET 
    firstName='$newFirstName', 
    lastName='$newLastName', 
    grade='$newGrade', 
    telephone='$newPhone', 
    annualFee='$newAnnualFee',
    streetAddress='$newAddress',
    suburbID='$newSuburb',
    dateOfBirth='$newBirthday',
    motherInitial='$newMother',
    fatherInitial='$newFather'
    WHERE ID='$ID'
    ";

    // to test whether the edit was updated or not
    if($conn->query($editSQL) === TRUE) {
        echo "Changed details successfully";
    }
    else {
        echo "Error " .$editSQL. "<br>" .$conn->error;
}
}


// EDITING EVENT POINTS FOR INDIVIDUAL MEMBER 

if(isset($_POST['updateEvent']) and $_POST['newPoints'] != ""){ 
    
    $newPoints = $_POST['newPoints'];
    $eventID = $_POST['eventDate'];
    $memberID = $_POST['memberID'];
    
    
    $editPointsSQL = "UPDATE memberevents SET points='$newPoints' WHERE memberID = '$memberID' AND eventID = '$eventID'";
    
    // to test whether the edit was updated or not
    if($conn->query($editPointsSQL) === TRUE) {
        echo "Changed points successfully";
    }
    else {
        echo "Error " .$editPointsSQL. "<br>" .$conn->error;
}
    
}    

header("location: ../members.php");
?>
