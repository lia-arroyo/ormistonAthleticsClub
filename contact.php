<!DOCTYPE html>
<html lang="en">
    
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
            <a href="contact.php" class="active">Contact</a>
            
            
            <?php 
    
                include "Stylesheet_PHP_Files/loginSys.php";
            
                if(!(isset($_SESSION['loggedIn']))) {
                    echo '<a href="login.php">Login</a>';
                }
            
                else {
                    echo '<div class="dropdownLogin">
                            <a href="login.php">'.$_SESSION['adminName'].'<i class="fas fa-chevron-down"></i></a> <!-- fas fa-chevron down is an arrow pointing down -->

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
        
        
        <div class="content" id="contactPage"> 
            <h1>Contact</h1>
            
            <div id="contactFlex"> 
                <div id="contactDetails">

                    <h2>Address</h2>
                    <a>275 Ormiston Rd, Flat Bush, 2016</a>
                    <h2>Email</h2>
                    <a href="mailto:st18002@ormiston.school.nz">st18002@ormiston.school.nz</a>
                    <h2>Phone</h2>
                    <a>Telephone: (09)5554-099</a>
                    <br>
                    <a>Mobile: +643203403924</a>
                </div> <!-- end of contactDetails div -->


                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3187.786008227486!2d174.91592021517826!3d-36.967167293846096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d0d4ce772894c11%3A0xfdb207d4b3a93aed!2s275+Ormiston+Rd%2C+Flat+Bush%2C+Auckland+2016!5e0!3m2!1sen!2snz!4v1563156728121!5m2!1sen!2snz" allowfullscreen></iframe>


            
            </div><!-- end of contactFlex div-->
            
        
            </div> <!-- end of content, contactPage div -->
        
        <footer>
            <img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club logo" class="footerLogo">
            <p>Copyright 2019
            <br> Created my free logo @ <a href="https://logomakr.com/" target="_blank">logomakr.com</a></p>
        
        
        </footer>

    </body>
    

</html>