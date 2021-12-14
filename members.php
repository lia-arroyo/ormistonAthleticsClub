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
                        <a href="members.php" class="active" >Members</a>
                        <a href="fees.php">Fees</a>
                        <a href="events.php">Events</a>
                        <form method="post">
                            <button name="logout" type="submit">Logout</button>
                            </form>


                        </div> <!-- end of dropdownContent div --> 
                        </div> <!-- end of dropdownLogin div-- >';

                ?>
            
         <!-- end of navLinks div -->
        </header>
            
        <div class="tabs">
            <button id="membersTab" onclick="tabs('members'); tabButton('membersTab')" class="tab">Members</button>
            <button id="addNewTab" onclick="tabs('addNew');  tabButton('addNewTab')" class="tab">Add New</button>
            </div> <!-- end of tabs tabs div -->
        
        
        <div class="adminContent" id="members"> 
            
            <h2>Club Members</h2>
            
            <div id="membersDetails">
                
                <div id="searchFilter-members">
                    <h2>Search Member</h2>
                    <form method="post" action="">
                        <input type="text" name="search" placeholder="Search by member name...">
                        <button type="submit" name="searchButton">Search</button>
                    </form>
                    <h2>Filter Members</h2>
                    <form method="post" action="">
                        <label>Grade:</label>
                        <select name="gradeDropdown">
                            <option value="">All Grades</option>
                            <option value="Junior">Junior</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Senior">Senior</option>
                        </select>
                        <br>
                        
                        <label>Points:</label>
                        <select name="pointsDropdown">
                            <option value="">All Points Ranges</option>
                            <option value="0">0</option>
                            <option value="1">1 - 20</option>
                            <option value="21">21 - 40</option>
                            <option value="41">41 - 60</option>
                            <option value="61">61 - 80</option>
                            <option value="81">81 - 100</option>
                        </select>
                        <button type="submit" name="filterButton">Filter</button>
                    </form>
                    </div><!-- end of searchFilter -->
                
                <div id="membersTable">
                    
                    <?php 
                    
                    if(isset($_POST['pageButton'])){
                        $page = $_POST['pageButton'];
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
                        <th>Total Points</th>
                        <th>View Details</th>
                        </tr>

                        <?php
                        
                        include "Stylesheet_PHP_Files/filterSearch.php";
                        
                        $query = mysqli_query($conn, $sql);
                        
                        

                        while($row = mysqli_fetch_array($query)){
                            echo "<tr>";
                            echo "<td>".$row['ID']."</td>";
                            echo "<td>".$row['firstName']."</td>";
                            echo "<td>".$row['lastName']."</td>";
                            echo "<td>".$row['grade']."</td>";
                            echo "<td>".$row['totalPoints']."</td>";
                            echo "<td><form method='post' action='clubmember.php'><button value='".$row['ID']."' type='submit' name='submitID'>>>></button></form></td>";
                        }


                        ?>

                    </table>
                    
                    <br> 
                    <?php
                    if(isset($_POST['searchButton']) or isset($_POST['filterButton'])){
                        echo "<div class='hidden'>";
                    }
                    
                    else {
                        echo "<div class='pagination'>";
                    }
                    
                    ?>
                        
                        <form method="post" action="#">
                            <?php
                            
                            if($page == 1){ // to prevent negative pages
                                echo "<button class='hidden'    type='submit' name='pageButton' value='1'></button>";
                            }
                            else {
                            echo "<button type='submit' name='pageButton' value='".($page - 1)."'><i class='fas fa-arrow-left'></i></button>";}
                        
                            
                            $totalSQL = "SELECT * from members";
                            $totalQuery = mysqli_query($conn, $totalSQL);


                            $totalRows = mysqli_num_rows($totalQuery);
                            

                            $totalPages = ceil($totalRows / $limit);

                            for($i = 1; $i <= $totalPages; $i++){
                                
                                if($i == $page){
                                    echo "<button type='submit' name='pageButton' class='activePage' value='".$i."'>".$i."</button>";
                                }
                                else{
                                    echo "<button type='submit' name='pageButton' value='".$i."'>".$i."</button>";
                                }
                                
                            }
            
                            if($page == $totalPages){ // to prevent exceeding the total pages
                                echo "<button class='hidden' type='submit' name='pageButton' value='".$totalPages."'></button>";
                            }
                            else {
                            echo "<button type='submit' name='pageButton' value='".($page + 1)."'><i class='fas fa-arrow-right'></i></button>";}
                            
                            ?>
                            </form>
                        
                        </div> <!-- end of pagination -->
                    
                    
                    </div><!-- end of membersTable -->
                
            
                </div> <!-- end of membersDetails -->
                            
            
            </div> <!-- end of content, members div -->
        
        
        <div class="adminContent" id="addNew"> 
            <h2>Add New Club Member</h2>
            
            <form method="post" action="#">
                <div id="addNewFlex">
                    <div id="formLabels">
                        <label>First Name:</label>
                        <br>
                        <label>Last Name: </label>
                        <br>
                        <label>Parents' First Initial: </label> 
                        <br>
                        <label>Street Address: </label>
                        <br>
                        <label>Suburb: </label>
                        <br>
                        <label>Telephone: </label>
                        <br>
                        <label>Date of Birth: </label>
                        <br>
                        <label>Grade: </label>
                        <br>
                        <label>Annual Fee: </label>

                        </div><!-- end of formLabels -->
                    <div id="formInput">
                        <input type="text" name="firstName" required maxlength="15"> 
                        <br> 
                        <input type="text" name="lastName" required maxlength="15">
                        <br> 
                        <input type="text" name="father" placeholder="Father" id="formInitials" required maxlength="1"> and <input type="text" name="mother" placeholder="Mother" id="formInitials" required maxlength="1">
                        <br> 
                        <input type="text" name="address" placeholder="Street number and name" required maxlength="25">
                        <br> 
                        <select name="suburb" required> 
                            <option value="">Select a suburb</option>
                            <?php 
                            $suburbSQL = "SELECT * FROM suburb";
                            $suburbQuery = mysqli_query($conn, $suburbSQL); 

                            while($suburbs = mysqli_fetch_array($suburbQuery)){
                                echo "<option value='".$suburbs['ID']."'>".$suburbs['name']."</option>";
                            }?>
                        </select>
                        <br> 
                        (09)<input type="number" name="tel1" placeholder="xxxx" required max="9999">-<input type="number" name="tel2" placeholder="xxx" required max="999">
                        <br>
                        <input type="date" name="dateOfBirth" required>
                        <br>
                        <select name="grade" required>
                            <option value="">Select grade</option>
                            <option value="Junior">Junior</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Senior">Senior</option>
                        </select>
                        <br>
                        $<input type="number" name="annualFee" required maxlength="3">
                        <br>
                        </div><!-- end of formInput -->
                </div> <!-- end of addNewFlex -->
                <br>
                <button type="submit" name="addMember">Add Member</button>
            
            </form>
            
            <?php 
                include "Stylesheet_PHP_Files/process.php";
            ?>
            </div> <!-- end of content, addNew div -->
        
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
            var tab1 = document.getElementById("members");
            var tab2 = document.getElementById("addNew");

            tab1.style.display = "none";
            tab2.style.display = "none";
            active.style.display = "block";

        }
        
        function tabButton(activeButton) {
            
            // tab buttons + color when active
            var active = document.getElementById(activeButton);
            var button1 = document.getElementById("membersTab");
            var button2 = document.getElementById("addNewTab");

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
    
        
    
        </script>

</html>