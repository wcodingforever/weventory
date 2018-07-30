<?php 
include '../backend/_navbarSession.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Corben:700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <title>Document</title>

    <style>
        /* * {outline: 1px solid red;} */


    body {
        padding: 0px;
        margin: 0px;
        /* width: 100vw; */
        height: 100vh;
        background-color: #E7E5E2;
    }

    a {
        text-decoration: none;
        /* color: #EAF1E4; */
        color: #E2C044;
    }

    #calendar {
        font-size: 6.3em;
        margin-top: 10px;
    }


    #header {
        width: 100%;
        height: 100px;
        display: flex;
        justify-content: space-around;
    }

    #logindiv {
        display: inline-flex;
        height: 50px;
    }

    #sidebar {
        height: 50px;
        width: 90%;
        margin: 28px 20px 20px 55px;
        background-color: #393E41;
        color: #EAF1E4;
        display: flex;
        justify-content: space-around;
    }

    #mobile {
        display:none;
    }

    .menuoption {
        height: 33px;
        margin: 10;
        display: inline-block;
    }

    #weventory {
        font-family: 'Corben', cursive;
        font-size: 4.3em;
        
    }

    .userbuttons {
        font-size: 20px;
        display: inline-block;
        margin: 10px;
    }

    #logoutbutton {
        display: none;
    }

    .menuoption:hover, #weventory:hover, .userbuttons:hover,  #calendar:hover{
        color: #B22222;
        transition: 0.6s ease;
    }

    


    @media screen and (max-width: 481px) {
        #mobilemenu{
            display: none;
            background-color: #EAF1E4;
            height: 84%;
            font-size: 1.3em;
        }


        #mobile {
            display: block;
        }

        #navbar {
            /* display: flex; */
            height: 50px;
            display: inline-flex;
            width: 100%;
            justify-content: space-between;
        }

        #desktop {
            display: none;
        }

        #fixedmenu {
            position: fixed;
            bottom: 0px;
            width: 100%;
            display: inline-flex;
            justify-content: space-between;
            height:60px;
            background-color: #E7E5E2;
        }

        .mobileoption {
            height: 60px;
            
        }

        .icon {
            font-size: 2.3em;
            height: 40px;
            margin: 10px;
            color: #393E41;
        }

    }
    </style>
</head>
<body>
    
    <div id="desktop">
        <div id="header"><!--header container-->
            <a href="homepage.php"><div id="calendar"><i class="far fa-calendar-alt"></i></div></a>
            <a href="homepage.php"><div id="weventory">WEventory</div></a>
            <div id="userdiv">
                <a href="signup.php"><div class="userbuttons">Sign Up</div></a>
                <a href="login.php"><div class="userbuttons">Sign In</div></a>
                <div id="logoutbutton" >Log Out</div>
            </div>
        </div>

        <div id="sidebar">
            <div class="menuoption">Search<i class="fas fa-search"></i></div>
            <a href="newevent.php"><div class="menuoption" >Create Event </div></a>
            <a href="newgroup.php"><div class="menuoption">Create Group </div></a>
            <a href="profile.php"><div class="menuoption">My Profile</div></a>
            <a href="help.php"><div class="menuoption">Support</div></a>
            <a href="privateMessage.php"><div class="menuoption">Chat <i class="far fa-comments"></i></div></a>
        </div>
    </div>

    <div id="mobile">
        <div id="navbar"><!--sidebar or nav bar for mobile-->
            <div id="mobilemenubutton" class="icon"> <i class="far fa-plus-square"></i><!--burger menu on mobile--></div>
            <div class="icon"><i class="far fa-comments"></i></div>
        </div>
        <div id="mobilemenu">
                <div class="mobileoption"><a href="newevent.php">Create Event</a></div>
                <div class="mobileoption"><a href="newgroup.php">Create Group </a></div>
                <div class="mobileoption"><a href="help.html">Support</a></div>
                
        </div>
        <div id="fixedmenu">
            <a href="homepage.php"><div class="icon"><i class="fas fa-home"></i></div></a>
            <a href="search.php"><div class="icon"><i class="fas fa-search"></i></div></a>
            <a href="profile.php"><div class="icon"><i class="fas fa-user"></i></div></a>
        </div>
    </div>

    <script>
        var mobileMenuButton = document.querySelector("#mobilemenubutton");
        var mobileMenu = document.querySelector("#mobilemenu");
        var userButtons = document.querySelectorAll(".userbuttons");
        var logoutButton =document.querySelector("#logoutbutton");
        var userName = <?php echo ($user_name) ?>

        // if(userName === true) {
        //     logoutButton.style.display = "block"
        //     userButtons.style.display = "none"
        // }


        mobileMenuButton.addEventListener("click", function(){
            if (mobileMenu.style.display === "block"){
                mobileMenu.style.display = "none"
            }
            else {
                mobileMenu.style.display = "block"
            }
        });
    </script>
