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
                echo '<div class="dropdownLogin">
                    <a href="login.php" class="active">'.$_SESSION['adminName'].'<i class="fas fa-chevron-down"></i></a> <!-- fas fa-chevron down is an arrow pointing down -->

                    <div class="dropdownContent">
                        <a href="members.php">Members</a>
                        <a href="fees.php">Fees</a>
                        <a href="events.php" class="active" >Events</a>
                        <form method="post">
                            <button name="logout" type="submit">Logout</button>
                            </form>


                        </div> <!-- end of dropdownContent div --> 
                        </div> <!-- end of dropdownLogin div-- >';

                ?>
            
         <!-- end of navLinks div -->
        </header>
            
        <div class="tabs">
            <button id="eventsTab" onclick="tabs('events'); tabButton('eventsTab')" class="tab">Events</button>
            <button id="addNewEventTab" onclick="tabs('addNewEvent');  tabButton('addNewEventTab')" class="tab">Add New</button>
            </div> <!-- end of tabs tabs div -->
        
        
        <div class="adminContent" id="events"> 
            
            <h2>Search Event</h2>
            
            <form method="post" action="#">
                <label>Event Date: </label>
                <input type="date" name="eventDate">
                <button type="submit" name="searchEvent">Search</button>
            </form>
            
            <h3>OR</h3>
            
            <form method="post" action="#">
                <label>Select Event: </label>
                <select name="eventDate">
                    <?php
                        $eventSQL = "SELECT events.eventDate from events";
                        $eventQuery = mysqli_query($conn, $eventSQL);
                    
                    while($events = mysqli_fetch_array($eventQuery)){
                        echo "<option value='".$events['eventDate']."'>".$events['eventDate']."</option>";
                    }
                    
                    ?>
                </select>
                 <button type="submit" name="searchEvent">Search</button>
            </form>
            
            <?php
            
            if(isset($_POST['searchEvent'])){
                $eventDate = $_POST['eventDate'];
            }
                    ?> 
            <br>
            
            <h2>Event Members</h2>
            <div id="eventDetails">
                
                
                <div id="searchFilter-events">
                    <h2>Search Member</h2>
                    <form method="post" action="#">
                        <input type="hidden" value="<?php echo $eventDate; ?>" name="eventDate"> <!-- this is posting the event date so that the search and filter can work after the event members are displayed -->
                        <input type="text" name="search-events" placeholder="Search by member name...">
                        <button type="submit" name="searchButton-events">Search</button>
                    </form>
                    <h2>Filter Members</h2>
                    <form method="post" action="#">
                        <input type="hidden" value="<?php echo $eventDate; ?>" name="eventDate"> <!-- this is posting the event date so that the search and filter can work after the event members are displayed -->
                        <label>Grade:</label>
                        <select name="gradeDropdown-events">
                            <option value="">Select grade</option>
                            <option value="Junior">Junior</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Senior">Senior</option>
                        </select>
                        <br>
                        
                        <button type="submit" name="filterButton-events">Filter</button>
                    </form>
                    </div><!-- end of searchFilter -->
                
                <div id="eventMembersTable">
                 <?php 
                    
                    if(isset($_POST['pageButton-events'])){
                        $page = $_POST['pageButton-events'];
                    }
                    
                    else {
                        $page = 1;
                    }
                    
                    
                    ?>
                    <table>
                        <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Grade</th>
                        <th>Points</th>
                        <th>View Details</th>
                        </tr>

                    <?php

        
    
                        include "Stylesheet_PHP_Files/filterSearch.php";
                        
                        if(isset($eventsSQL)) {
                            $query = mysqli_query($conn, $eventsSQL);
                            
                            $totalRows = mysqli_num_rows($query);
                            
                            if($totalRows === 0){
                                echo "<script> alert('No records found for that event date.') </script>";
                            }
                            
                            while($row = mysqli_fetch_array($query)){
                                echo "<tr>";
                                echo "<td>".$row['memberID']."</td>";
                                echo "<td>".$row['firstName']."</td>";
                                echo "<td>".$row['lastName']."</td>";
                                echo "<td>".$row['grade']."</td>";
                                echo "<td>".$row['points']."</td>";
                                echo "<td><form method='post' action='clubmember.php'><button value='".$row['ID']."' type='submit' name='submitID'>>>></button></form></td>";
                            }   
                        }
                    ?>
                    </table>
                    <br>
                    <?php
                    if(isset($_POST['searchButton-events']) or isset($_POST['filterButton-events'])){
                        echo "<div class='hidden'>";
                    }
                    
                    else {
                        echo "<div class='pagination'>";
                    }
                    
                    ?>
                        
                        <form method="post" action="#">
                            <input type="hidden" value="<?php echo $eventDate;?>" name="eventDate">
                        
                            <?php
                            
                            if(isset($eventsSQL)){
                                if($page == 1){ // to prevent negative pages
                                echo "<button class='hidden'    type='submit' name='pageButton-events' value='1'></button>";
                                }
                                else {
                                echo "<button type='submit' name='pageButton-events' value='".($page - 1)."'><i class='fas fa-arrow-left'></i></button>";}

                                $totalSQL = "SELECT * from members";
                                $totalQuery = mysqli_query($conn, $totalSQL);

                                $totalRows = mysqli_num_rows($totalQuery);
                                
                                $totalPages = ceil($totalRows / $limit);

                                for($i = 1; $i <= $totalPages; $i++){

                                    if($i == $page){
                                        echo "<button type='submit' name='pageButton-events' class='activePage' value='".$i."'>".$i."</button>";
                                    }
                                    else{
                                        echo "<button type='submit' name='pageButton-events' value='".$i."'>".$i."</button>";
                                    }

                                }

                                if($page == $totalPages){ // to prevent exceeding the total pages
                                    echo "<button class='hidden' type='submit' name='pageButton-events' value='".$totalPages."'></button>";
                                }
                                else {
                                echo "<button type='submit' name='pageButton-events' value='".($page + 1)."'><i class='fas fa-arrow-right'></i></button>";}
                            }
                            
                            
                            
                            ?>
                            </form>
                        
                        </div> <!-- end of pagination -->

                    </div><!-- end of eventMembersTable -->
                
                </div> <!-- end of eventDetails -->
    
            </div> <!-- end of content, members div -->
        
        
        <div class="adminContent" id="addNewEvent"> 
            <h2>Add New Event</h2>
            
            <form method="post" action="Stylesheet_PHP_Files/process.php">
                    <div id="moreMembers"> <!-- this is where the extra forms will be added -->
                        <label>Event Date:</label>
                        <input type="date" name="eventDate"> 
                        <br>
                        <br>
                        <button type="button" onclick="addMember()">Add Event Members</button>
                        <br>
                        
                            <p id="eventMemberDetails">
                            <br>
                            <label>Club Member:</label>
                            <select name="eventMember[]"> 
                                <!-- the [] makes it easier to sift through the posted values later, as they have the same name in the form -->
                                <option value="">Choose Member</option>
                                <?php 

                                $memberSQL = "SELECT members.firstName, members.lastName, members.ID FROM members";
                                $memberQuery = mysqli_query($conn, $memberSQL);

                                while($membersDropdown = mysqli_fetch_array($memberQuery)){
                                    echo "<option value='".$membersDropdown['ID']."'>".$membersDropdown['firstName']." ".$membersDropdown['lastName']."</option>";
                                }?>
                            </select>
                            <br>
                            <label>Points: </label>
                            <input type="number" name="points[]">
                                <br>
                            </p>
                        
                        </div> <!-- end of moreMembers -->
                <br>
                <button type="submit" name="addEvent">Add Event</button>

            
            </form>
            <?php 
                include "Stylesheet_PHP_Files/process.php";
            ?>
            </div> <!-- end of content, addNewEvent div -->
        
        <footer>
            <img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club logo" class="footerLogo">
            <p>Copyright 2019
            <br> Created my free logo @ <a href="https://logomakr.com/" target="_blank">logomakr.com</a></p>
        
        </footer>


    </body>
    <script>
        
        function tabs(active) {
            // this function opens the active tab and hides the others 

            var active = document.getElementById(active)
            var tab1 = document.getElementById("events");
            var tab2 = document.getElementById("addNewEvent");

            tab1.style.display = "none";
            tab2.style.display = "none";
            active.style.display = "block";

        }
        
        function tabButton(activeButton) {
            
            // tab buttons + color when active
            var active = document.getElementById(activeButton);
            var button1 = document.getElementById("eventsTab");
            var button2 = document.getElementById("addNewEventTab");

                button1.style.backgroundColor = "#C8F2B2";
                button1.style.fontWeight = "500";
                button1.style.textDecoration = "none";
                button2.style.backgroundColor = "#C8F2B2";
                button2.style.fontWeight = "500";
                button2.style.textDecoration = "none";
                active.style.backgroundColor = "white";
                active.style.fontWeight = "600";
                active.style.textDecoration = "underline";
            }
    
        
        function addMember() {
            var div = document.getElementById('moreMembers')
            var p = document.getElementById('eventMemberDetails');
            
            div.innerHTML += p.innerHTML; 
        }
        
        </script>

</html>