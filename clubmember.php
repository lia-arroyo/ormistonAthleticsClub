<!DOCTYPE html>
<html lang="en">
    
<?php 
    include "Stylesheet_PHP_Files/loginSys.php";
    
    if(!(isset($_SESSION['loggedIn']))) {
        header("Location: login.php");

    }
    ?>        
    
    <head>

        <!-- metadata allows search engines to efficiently index the content -->
        <meta charset="UTF-8">
        <meta name="description" content="about Ormiston Athletics Club">
        <meta name="keywords" content="Ormiston Athletics Club, athletics, club">
        <meta name="author" content="Lia">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- linking to css stylesheet -->
        <link rel="stylesheet" type="text/css" href="Stylesheet_PHP_Files/style.css">
        
        <!-- Varela Round font --->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
        
        <!-- Linking to Fontawesome's icon library -->
        <script src="https://kit.fontawesome.com/26c8b54824.js"></script>

        <title>Ormiston Athletics Club</title>

    </head>

    <body>
        <header>
            <div id="logo"><a href="index.php"><img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club Logo" class="logoImage"></a></div>
            
            <a href="index.php">Home</a>
            <a href="contact.php">Contact</a>
            
            
            <?php 
    
                include "Stylesheet_PHP_Files/loginSys.php";
            
                if(!(isset($_SESSION['loggedIn']))) {
                    echo '<a href="login.php">Login</a>';
                }
            
                else {
                    echo '<div class="dropdownLogin">
                            <a href="login.php" class="active">'.$_SESSION['adminName'].'<i class="fas fa-chevron-down"></i></a> <!-- fas fa-chevron down is an arrow pointing down -->

                            <div class="dropdownContent">
                                <a href="members.php">Members</a>
                                <a href="fees.php">Fees</a>
                                <a href="events.php">Events</a>
                                <form method="post">
                                    <button name="logout" type="submit">Logout</button>
                                    </form>


                                </div> <!-- end of dropdownContent div --> 

                        </div> <!-- end of dropdownLogin div-- >';
                }

                ?>
         <!-- end of navLinks div -->
        </header>
        
        <button id="backButton" onclick="location.href='members.php'"> &lt;&lt;&lt; Back to members page... </button>
        
        
        <div class="adminContent" id="memberPage"> 
           
            <?php   
            
            $ID = $_POST['submitID'];
            
            $sql = "SELECT members.*, SUM(memberevents.points) as points
            FROM members 
            JOIN memberevents ON memberevents.memberID = members.ID
            WHERE members.ID = '$ID'";
            $query = mysqli_query($conn, $sql); 
            $member = mysqli_fetch_array($query);
            
            $firstName = $member['firstName'];
            $lastName = $member['lastName'];
            $grade = $member['grade'];
            $phone = $member['telephone'];
            $annualFee = $member['annualFee'];
            $address = $member['streetAddress'];
            $birthday = $member['dateOfBirth'];
            $mother = $member['motherInitial'];
            $father = $member['fatherInitial'];
            $parents = $father." and ".$mother." ".$lastName; 
            $totalPoints = $member['points'];
            $amountPaid = $member['amountPaid'];
            $overdue = $annualFee - $amountPaid;
            $lastPaid = $member['datePaid'];
            
            $suburbID = $member['suburbID'];
            
            
            $suburbSQL = "SELECT * FROM suburb WHERE suburb.ID = '$suburbID'";
            $suburbQuery = mysqli_query($conn, $suburbSQL);
            $suburbFetch = mysqli_fetch_array($suburbQuery);
            $suburb = $suburbFetch['name'];
            
            
            ?>
            
             
            
            <div id="memberDetails">
                <div id="memberInfo">
                    
                    <h1><?php echo $firstName." ".$lastName; ?> </h1><button type="button" onclick="show('editDetails')" >Edit Details</button>
                    <br><br>
                    
                    
                    <p><label>Grade:</label> <?php echo $grade;?></p>
                    <p><label>Telephone:</label> <?php echo $phone;?></p>
                    <p><label>Annual Fee:</label> $<?php echo number_format($annualFee, 2);?></p>
                    <br>
                    <p><label>Address:</label> <?php echo $address;?></p>
                    <p><label>Suburb:</label> <?php echo $suburb;?></p>
                    <p><label>Date Of Birth:</label> <?php echo $birthday;?></p>
                    <p><label>Legal Guardian/s:</label> <?php echo $parents;?></p>

                    </div> <!-- end of memberInfo -->
                
                
                <div id="memberTotal">
                
                    <div class="memberTotalBlock" id="memberPoints">

                        <h3>Total Points</h3>
                        <p><?php echo $totalPoints?></p>


                        </div> <!-- end of memberTotalBlock -->

                    <div class="memberTotalBlock" id="memberOutstandingFees">

                        <h3>Outstanding Fees</h3>
                        <?php 

                        if($overdue < $annualFee){
                            echo "<p>$".number_format($overdue,2)."</p>";
                            echo "Last Paid: ".$lastPaid;
                        }
                        
                        else{
                            echo "<p id='overdue'>$".number_format($overdue,2)."</p>";
                        }

                        ?>
                        </div> <!-- end of memberTotalBlock -->
                    
                    </div> <!-- end of memberTotal -->

                </div> <!-- end of memberDetails div -->
            
            </div> <!-- end of adminContent, memberPage div -->
        
        <div class="adminContent" id="editDetails">
            
            <h2>Edit Member Details</h2>
            <form action="Stylesheet_PHP_Files/editingMember.php" method="post">
                <input type="hidden" value="<?php echo $ID; ?>" name="ID">
                <!-- this is to post the member ID in order to edit their details -->   
                
                <div id="editFlex">
                
                    <div id="formLabels">
                        <label>First Name:</label>
                        <br>
                        <label>Last Name: </label>
                        <br>
                        <label>Grade: </label>
                        <br>
                        <label>Telephone</label>
                        <br>
                        <label>Annual Fee: </label>
                        <br>
                        <label>Address:</label>
                        <br>
                        <label>Suburb:</label>
                        <br>
                        <label>Date of Birth:</label>
                        <br>
                        <label>Parents' First Initial:</label>

                        </div><!-- end of formLabels -->

                    <div id="formInput">

                        <input type="text" value="<?php echo $firstName; ?>" name="newFirstName">
                        <br>
                        <input type="text" value="<?php echo $lastName;?>" name="newLastName">
                        <br>
                        <select name="newGrade">
                            <option value="<?php echo $grade;?>"><?php echo $grade;?></option>
                            <option value="Junior">Junior</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Senior">Senior</option>
                        </select>
                        <br> 
                        <input type="text" value="<?php echo $phone;?>" name="newPhone">
                        <br>
                        $<input type="number" value="<?php echo $annualFee;?>" name ="newAnnualFee">
                        <br>
                        <input type="text" value="<?php echo $address; ?>" name="newAddress">
                        <br>
                        <select name="newSuburb">
                            <option value="<?php echo $suburbID;?>"><?php echo $suburb;?></option>
                            <?php 

                            $suburbsSQL = "SELECT * FROM suburb";
                            $suburbsQuery = mysqli_query($conn, $suburbsSQL);

                            while ($suburbs = mysqli_fetch_array($suburbsQuery)){
                                echo "<option value='".$suburbs['ID']."'>".$suburbs['name']."</option>";    
                            }
                            ?>
                        </select>
                        <br>
                        <input type="date" value="<?php echo $birthday; ?>" name="newBirthday">
                        <br>
                        <input type="text" name="newFather" value="<?php echo $father;?>" id="formInitials">
                        and
                        <input type="text" name="newMother" value="<?php echo $mother;?>" id="formInitials">

                        </div><!-- end of formInput -->
                    
                    </div> <!-- end of editFlex -->

                <br>
                <button type="submit" name="edit">Update Details</button>
            </form>
        
        
            </div><!-- end of editDetails div -->
        
        <div class="adminContent" id="memberEvents">
        
            <h2>Events Attended</h2>
            <button onclick="show('editMemberEvent')">Edit Event</button>
            <br>
            <br>
            
            <table>
                <tr>
                <th>Event Date</th>
                <th>Points</th>
                </tr>
            
                <?php 

                $eventsSQL = "SELECT memberevents.*, events.* FROM memberevents INNER JOIN events ON memberevents.eventID = events.ID WHERE memberevents.memberID = '$ID'";
                $eventsQuery = mysqli_query($conn, $eventsSQL);

                while($events = mysqli_fetch_array($eventsQuery)){
                    echo "<tr>";
                    echo "<td>".$events['eventDate']."</td>";
                    echo "<td>".$events['points']."</td>";
                    echo "</tr>";
                }
            
            
                ?>
            </table>
            </div><!-- end of adminContent, memberEvents div -->
            
        <div class="adminContent" id="editMemberEvent">
            
            <h2>Edit Event</h2>
        
                <form method="post" id="editEventForm" action="Stylesheet_PHP_Files/editingMember.php">
                    <label>Choose Event: </label>
                    <select name="eventDate">
                        <?php 

                            $eventsSQL = "SELECT memberevents.*, events.* FROM memberevents INNER JOIN events ON memberevents.eventID = events.ID WHERE memberevents.memberID = '$ID'";
                            $eventsQuery = mysqli_query($conn, $eventsSQL); 

                            while($events = mysqli_fetch_array($eventsQuery)){
                                
                                echo "<option value='".$events['eventID']."'>".$events['eventDate']."</option>";
                                
                                $memberID = $events['memberID'];
                        }
                    
                        ?>
                        </select>
                    <br><br>
                    <input type="hidden" name="memberID" value="<?php echo $memberID;?>">
                    <label>Points: </label>
                    <input type="number" name="newPoints">
                    <br>
                    <br>
                    <button type="submit" name="updateEvent">Update Event</button>
                    </form> <!-- end of submitDate form -->
        
            </div><!--end of editMemberEvent -->
        
        <footer>
            <img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club logo" class="footerLogo">
            <p>Copyright 2019
            <br> Created my free logo @ <a href="https://logomakr.com/" target="_blank">logomakr.com</a></p>
        
        
        </footer>

    </body>
    <script>
        
        function show(active) {
            // this function opens the separate edit containers for both editing member details and editing member events.

            var active = document.getElementById(active);
            
            if(active.style.display === "block") {
                active.style.display = "none";
            }
            
            else{
                active.style.display = "block";
            }
            

        }
        
    </script>
</html>