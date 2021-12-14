<?php

// FOR PAGINATION: 

$limit = 25; // the max number of members per table
$offset = ($page - 1) * $limit; // the ID number the table starts 


// MEMBERS PAGE FILTER AND SEARCH ! 

if(isset($_POST['searchButton']) and $_POST['search'] != "") {
    
    $searchValue = $_POST['search'];
    
    $sql = "SELECT members.ID, members.firstName, members.lastName, members.grade, SUM(memberevents.points) AS totalPoints
    FROM members 
    INNER JOIN memberevents 
    ON memberevents.memberID = members.ID AND (members.firstName = '$searchValue' OR 
    members.lastName = '$searchValue' OR 
    CONCAT(members.firstName, ' ', members.lastName) = '$searchValue')
    GROUP BY members.ID
    ";
}


elseif(isset($_POST['filterButton'])){
    
    if($_POST['gradeDropdown'] != "" and $_POST['pointsDropdown'] != ""){ // if both grade and points are set 
        
        $grade = $_POST['gradeDropdown'];
        $points = $_POST['pointsDropdown'];


        if($points === 0){ // 0 points
           $sql = "SELECT * FROM 
            (SELECT members.ID, members.firstName, members.lastName, members.grade AS grade, SUM(memberevents.points) AS totalPoints
            FROM members 
            INNER JOIN memberevents 
            ON memberevents.memberID = members.ID
            GROUP BY members.ID) AS firstTable
            WHERE grade = '$grade' AND totalPoints = 0
            "; 
        }

        else { 
            $val1 = $points;
            $val2 = $points + 19;

            $sql = "
            SELECT * FROM 
            (SELECT members.ID, members.firstName, members.lastName, members.grade AS grade, SUM(memberevents.points) AS totalPoints
            FROM members 
            INNER JOIN memberevents 
            ON memberevents.memberID = members.ID
            GROUP BY members.ID) AS firstTable
            WHERE grade = '$grade' AND totalPoints BETWEEN $val1 and $val2
                "; 
        }
    }
    
    elseif($_POST['gradeDropdown'] != ""){ // if grade only is set
        $grade = $_POST['gradeDropdown'];
        
        $sql = "SELECT * FROM 
            (SELECT members.ID, members.firstName, members.lastName, members.grade AS grade, SUM(memberevents.points) AS totalPoints
            FROM members 
            INNER JOIN memberevents 
            ON memberevents.memberID = members.ID
            GROUP BY members.ID) AS firstTable
            WHERE grade = '$grade'
            ";
    }
    
    elseif($_POST['pointsDropdown'] != ""){
        $points = $_POST['pointsDropdown'];


        if($points === 0){ // 0 points
           $sql = "SELECT * FROM 
            (SELECT members.ID, members.firstName, members.lastName, members.grade AS grade, SUM(memberevents.points) AS totalPoints
            FROM members 
            INNER JOIN memberevents 
            ON memberevents.memberID = members.ID
            GROUP BY members.ID) AS firstTable
            WHERE totalPoints = 0
            "; 
        }

        else { 
            $val1 = $points;
            $val2 = $points + 19;

            $sql = "SELECT * FROM 
            (SELECT members.ID, members.firstName, members.lastName, members.grade AS grade, SUM(memberevents.points) AS totalPoints
            FROM members 
            INNER JOIN memberevents 
            ON memberevents.memberID = members.ID
            GROUP BY members.ID) AS firstTable
            WHERE totalPoints BETWEEN $val1 and $val2"; 
        }
    }
}

else {
    $sql = "SELECT members.ID, members.firstName, members.lastName, members.grade, SUM(memberevents.points) AS totalPoints
    FROM members 
    INNER JOIN memberevents ON memberevents.memberID = members.ID 
    GROUP BY members.ID 
    LIMIT $limit OFFSET $offset";

}

// END OF MEMBERS PAGE FILTER AND SEARCH


// FEES PAGE FILTER AND SEARCH ! 

if(isset($_POST['searchButton-fees']) and $_POST['search-fees'] != "") {
    
    $searchValue = $_POST['search-fees'];
    
    $tablesql = "SELECT members.ID, members.firstName, members.lastName, members.grade, members.annualFee, members.amountPaid 
    FROM members 
    WHERE members.firstName = '$searchValue' OR 
    members.lastName = '$searchValue' OR 
    CONCAT(members.firstName, ' ', members.lastName) = '$searchValue'
    GROUP BY members.ID
    ";
}

elseif(isset($_POST['filterButton-fees'])){
    
    if(($_POST['gradeDropdown-fees'] != "") and ($_POST['overdueFees'] != "")) {// if they are both set
        
        $fees = $_POST['overdueFees'];
        $grade = $_POST['gradeDropdown-fees'];
        
        if($fees === "with"){
            $tablesql = "
            SELECT * FROM (SELECT members.ID, members.firstName, members.lastName, members.grade as grade, members.annualFee as annualFee, members.amountPaid as amountPaid FROM members) AS innerTable WHERE grade = '$grade' and (annualFee-amountPaid) > 0 
            ";}

        elseif($fees === "without"){
            $tablesql = "SELECT * FROM (SELECT members.ID, members.firstName, members.lastName, members.grade as grade, members.annualFee as annualFee, members.amountPaid as amountPaid FROM members) AS innerTable WHERE grade = '$grade' and (annualFee-amountPaid) = 0
            ";
            }
    }
    
    elseif($_POST['gradeDropdown-fees'] != ""){// if only grade is set
        
        $grade = $_POST['gradeDropdown-fees'];
        
        $tablesql = "SELECT * FROM (SELECT members.ID, members.firstName, members.lastName, members.grade as grade, members.annualFee as annualFee, members.amountPaid as amountPaid FROM members) AS innerTable WHERE grade = '$grade'";
        
    }
    
    elseif($_POST['overdueFees'] != ""){//if only fees is set
        
        $fees = $_POST['overdueFees'];
        
        if($fees === "with"){
            $tablesql = "
            SELECT * FROM (SELECT members.ID, members.firstName, members.lastName, members.grade, members.annualFee as annualFee, members.amountPaid as amountPaid FROM members) AS innerTable WHERE (annualFee-amountPaid) > 0 
            ";
        }

        elseif($fees === "without"){
            $tablesql = "SELECT * FROM (SELECT members.ID, members.firstName, members.lastName, members.grade, members.annualFee as annualFee, members.amountPaid as amountPaid FROM members) AS innerTable WHERE (annualFee-amountPaid) = 0
            ";
            }
        }
}

else {
    $tablesql = "SELECT members.ID, members.firstName, members.lastName, members.grade, members.annualFee, members.amountPaid FROM members LIMIT $limit OFFSET $offset";
}

// END OF FEES PAGE

// EVENTS PAGE 

if(isset($_POST['searchEvent']) or isset($_POST['pageButton-events'])){
    $eventDate = $_POST['eventDate'];
    
    $eventsSQL = "SELECT memberevents.*, members.ID, members.firstName, members.lastName, members.grade, events.* 
    FROM memberevents 
    INNER JOIN members ON members.ID = memberevents.memberID 
    INNER JOIN events ON events.ID = memberevents.eventID
    WHERE events.eventDate = '$eventDate'
    LIMIT $limit OFFSET $offset";
    
    
}

elseif(isset($_POST['searchButton-events']) and $_POST['search-events'] != ""){
    
        
        $eventDate = $_POST['eventDate'];
        $searchValue = $_POST['search-events'];
    
        $eventsSQL = "SELECT memberevents.*, members.ID, members.firstName, members.lastName, members.grade, events.* 
        FROM memberevents 
        INNER JOIN members ON members.ID = memberevents.memberID 
        INNER JOIN events ON events.ID = memberevents.eventID
        WHERE events.eventDate = '$eventDate' AND (members.firstName = '$searchValue' OR 
        members.lastName = '$searchValue' OR 
        CONCAT(members.firstName, ' ', members.lastName) = '$searchValue')";
        
    }

elseif(isset($_POST['filterButton-events']) and $_POST['gradeDropdown-events'] != ""){
    
    $eventDate = $_POST['eventDate'];
    $grade = $_POST['gradeDropdown-events'];
    
    $eventsSQL = "SELECT memberevents.*, members.ID, members.firstName, members.lastName, members.grade, events.* 
    FROM memberevents 
    INNER JOIN members ON members.ID = memberevents.memberID 
    INNER JOIN events ON events.ID = memberevents.eventID
    WHERE events.eventDate = '$eventDate' AND members.grade = '$grade'";
    
}