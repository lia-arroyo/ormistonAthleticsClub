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
        
        <!-- Varela Round font -->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
        
        <!-- Linking to Fontawesome's icon library -->
        <script src="https://kit.fontawesome.com/26c8b54824.js"></script>

        <title>Ormiston Athletics Club</title>

    </head>

    <body>
        <header>
            <div id="logo"><a href="index.php"><img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club Logo" class="logoImage"></a></div>
            
            <a href="index.php" class="active">Home</a>
            <a href="contact.php">Contact</a>
            
            
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

                        </div> <!-- end of dropdownLogin div -->';
                }

                ?>
            
            
         <!-- end of navLinks div -->
        </header>
        
        <div class="slideshow"> 
            
            <!-- buttons for next and prev photo -->
            <button id="prev" class="slideshowButton" onclick="slideshowButtons(-1)">&#10094;</button>
            <button id="next" class="slideshowButton" onclick="slideshowButtons(1)">&#10095;</button>
            
            
            <!--- these are the header images for the slideshow -->
        
            
            <img src="Images/editedImages/golfbottomhalf.pexels-edited.jpg" alt="A man playing golf on the grass; only his legs and the golf club are showing." class="slides">
            <a href="https://www.pexels.com/photo/club-course-equipment-exercise-424732/" target="_blank" class="imgSource">Image Source</a>
            
            
            <img src="Images/editedImages/cycling.pexels-edited.jpg" class="slides" alt="Blurred in-action photo of a cyclist on his bicycle.">
            <a href="https://www.pexels.com/photo/time-lapse-photo-of-man-riding-on-bicycle-733748/" target="_blank" class="imgSource">Image Source</a>
            
            
            <img src="Images/editedImages/golf.pexels-edited.jpg" class="slides" alt="Golfer standing on a field with trees in the background.">
            <a href="https://www.pexels.com/photo/activity-adult-alone-athlete-424762/" target="_blank" class="imgSource">Image Source</a>
            
            
            <img src="Images/editedImages/sprints.pexels-edited.jpg" class="slides" alt="People getting ready to run a sprint.">
            <a href="https://www.pexels.com/photo/people-doing-marathon-618612/" target="_blank" class="imgSource">Image Source</a>
            
            
            <img src="Images/editedImages/golfmenongrass.pexels-edited.jpg" class="slides" alt="Two men playing golf, with the trees in the background.">
            <a href="https://www.pexels.com/photo/active-activity-adults-athlete-424725/" target="_blank" class="imgSource">Image Source</a>
            
        
            <img src="Images/editedImages/trackandfield.pexels.edited.jpg" class="slides" alt="Empty track and field.">
            <a href="https://www.pexels.com/photo/track-and-fields-2079612/" target="_blank" class="imgSource">Image Source</a>
            
        
            </div> <!-- end of slideshow div -->
        
        <div class="content" id="webDesc"> <!-- web description -->
            <h1>Ormiston Athletics Club</h1>
            
            <p> With over 500 members and counting, Ormiston Athletics is one of Auckland's biggest athletics clubs. We at Ormiston Athletics promote healthy living and wellbeing through the many great facilities at our club. Our facilities are not only geared towards Athletics, but also a wide range of physical activities guaranteed to keep you healthy and happy - making us a one-of-a-kind club! </p>
            
            <br>
            <a href="login.php" id="indexLogin">Admin Login</a>
        
        
        
        
            </div> <!-- end of content, webDesc div -->
        
        <footer>
            <img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club logo" class="footerLogo">
            <p>Copyright 2019
            <br> Created my free logo @ <a href="https://logomakr.com/" target="_blank">logomakr.com</a></p>
        
        
        </footer>

    </body>
    
    <script>
    
        var index = 1;
        
        function slideshowButtons(n) {
            slideshow(index += n);
        }
        
        slideshow(index);
        
        function slideshow(n) {
            var i;
            var images = document.getElementsByClassName("slides");
            var imgSource = document.getElementsByClassName("imgSource");
            
            
            if (n > images.length) { // when u click next on last pic, it goes to first
                index = 1;}
            
            if (n < 1) { // when u click prev on the first pic, it goes to last
                index = images.length;}
            
            for (i = 0; i < images.length; i++){ // hides the other pics
                images[i].style.display = "none";
                imgSource[i].style.display = "none";
            }
            
            images[index-1].style.display = "block";
            imgSource[index-1].style.display = "block";

        }
        
        
        
    
    
    </script>


</html>