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

        <title>Ormiston Athletics Club | Login Page</title>

    </head>

    <body>
        <header>
            <div id="logo"><a href="index.php"><img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club Logo" class="logoImage"></a></div>
            
            <a href="index.php">Home</a>
            <a href="contact.php">Contact</a>
            <a href="login.php" class="active">Login</a>
            
        </header>
        
        <div class="content" id="login"> <!-- web description -->
            
            <h1>Admin Login</h1>
            
            <form method="post" id="loginForm">
                
                <input type="text" name="username" placeholder="Username"> 
                <br>
                <input type="password" name="password" placeholder="Password">
                <br>
                
                <button type="submit" name="loginSubmit" id="loginButton">Login</button>
            
            </form>
        
            </div> <!-- end of content, webDesc div -->
        
        <?php 
        
            include "Stylesheet_PHP_Files/loginSys.php"; 
        
        ?>
        
        <footer>
            <img src="Images/editedImages/Logo.png" alt="Ormiston Athletics Club logo" class="footerLogo">
            <p>Copyright 2019
            <br> Created my free logo @ <a href="https://logomakr.com/" target="_blank">logomakr.com</a></p>
        
        
        </footer>

    </body>


</html>