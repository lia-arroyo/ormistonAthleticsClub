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
                                <a href="fees.php" class="active">Fees</a>
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
        
        
        <div class="adminContent" id="feesPage"> 
            
            
            <!--- PHP SQL STATEMENTS AND CALCULATIONS FOR CLUB'S TOTAL FEES -->
            <?php
            
                include "Stylesheet_PHP_Files/connections.php";
                
                $sql = "SELECT SUM(members.annualFee) AS totalAnnual, SUM(members.amountPaid) AS totalPaid FROM members";
            
                $query = mysqli_query($conn, $sql);
                $fees = mysqli_fetch_array($query);
                $totalPaid = $fees['totalPaid'];
                $totalAnnual = $fees['totalAnnual'];
                $totalOutstanding = $totalAnnual - $totalPaid;
            
            
            ?>
            
            <h2>Total Club Fees</h2>
            <div id="totalFees"> <!-- Total club fees -->
            
                <div class="feesBlock">
                    <h3>Total Fees Received</h3>
                    <p>$<?php echo number_format($totalPaid, 2) ?></p>
                </div> <!-- end of feesBlock -->

                <div class="feesBlock" id="outstanding">
                    <h3>Total Fees Outstanding</h3>
                    <p>$<?php echo number_format($totalOutstanding, 2); ?></p>
                </div> <!-- end of feesBlock -->
            </div> <!-- end of total div -->
            
            <h2> Individual Members' Fees</h2>
            
            <div id="memberFees"> <!-- individual members' fees -->
                
                <div id="searchFilter-fees">
                    <h2>Search Member</h2>
                    <form method="post" action="">
                        <input type="text" name="search-fees" placeholder="Search by member name...">
                        <button type="submit" name="searchButton-fees">Search</button>
                    </form>
                    <h2>Filter Members</h2>
                    <form method="post" action="">
                        <label>Grade:</label>
                        <select name="gradeDropdown-fees">
                            <option value="">All Grades</option>
                            <option value="Junior">Junior</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Senior">Senior</option>
                        </select>
                        <br>
                        
                        <label>Fees:</label>
                        <select name="overdueFees">
                            <option value="">Both</option>
                            <option value="with">With Outstanding Fees</option>
                            <option value="without">Without Outstanding Fees</option>
                        </select>
                        <button type="submit" name="filterButton-fees">Filter</button>
                        
                    </form>
                    </div><!-- end of searchFilter-fees -->
                
                <div id="memberFeesTable">
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
                        <th>Outstanding Fees</th>
                        <th>View Details</th>
                        </tr>
                        
                        <?php 
                        
                        include "Stylesheet_PHP_Files/filterSearch.php";
                        
                            
                        $tablequery = mysqli_query($conn, $tablesql);
                        
                        while($row = mysqli_fetch_array($tablequery)){
                            
                            $outstandingFees = number_format((float)$row['annualFee'] - $row['amountPaid'], 2, '.','');
                            
                            echo "<tr>";
                            echo "<td>".$row['ID']."</td>";
                            echo "<td>".$row['firstName']."</td>";
                            echo "<td>".$row['lastName']."</td>";
                            echo "<td>".$row['grade']."</td>";
                            
                            if($outstandingFees > 0){
                                echo "<td id='red'> $".$outstandingFees."</td>";
                            }
                            else{
                                echo "<td> $".$outstandingFees."</td>";
                            }
                            
                            
                            echo "<td><form method='post' action='clubmember.php'><button value='".$row['ID']."' type='submit' name='submitID'>>>></button></form></td>";
                        }
                        
                        
                        
                        ?> 
                    
                    </table>
                
                    <br><?php
                    if(isset($_POST['searchButton-fees']) or isset($_POST['filterButton-fees'])){
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
                </div> <!-- end of memberFeesTable -->
            
            
                </div> <!--- end of memberFees div -->

            </div> <!-- end of content, feesPage div -->
        
        <footer>
            <img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club logo" class="footerLogo">
            <p>Copyright 2019
            <br> Created my free logo @ <a href="https://logomakr.com/" target="_blank">logomakr.com</a></p>
        
        
        </footer>

    </body>
    

</html>