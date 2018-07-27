<?php 
include '../backend/_navbarSession.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <title>Document</title>

    <style>
        * {outline: 1px solid red;}


    body {
        padding: 0px;
        margin: 0px;
        /* width: 100vw; */
        height: 100vh;
        background-color: #E7E5E2;
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
        height: 390px;
        width: 150px;
        margin: 60px 20px 20px 20px;
        /* padding-left: 20px; */
        background-color: #393E41;
        color: #EAF1E4;
        position: fixed;
    }

    #mobile {
        display:none;
    }

    .menuoption {
        height: 33px;
        padding-top: 11px;
        margin: 10;
        margin-top: 10px;
        border-bottom: 1px solid;
    }


    @media screen and (max-width: 481px) {
        #mobilemenu{
            display: none;
            background-color: #EAF1E4;
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
            <div><a href="homepage.php">logo</a></div>
            <div id="slogan"><a href="homepage.php">WEventory</a></div>
            <div id="userdiv">
                <div><a href="signup.php">sign up</a></div>
                <div><a href="login.php">sign in</a></div>
            </div>
        </div>

        <div id="sidebar">
            <div class="menuoption">Search<i class="fas fa-search"></i></div>
            <div class="menuoption" ><a href="newevent.php">New Event <i class="far fa-plus-square"></i></a></div>
            <div class="menuoption"><a href="newgroup.php">New Group <i class="far fa-plus-square"></i></a></div>
            <div class="menuoption"><a href="profile.php">My Profile</a></div>
            <div class="menuoption">Chat <i class="far fa-comments"></i></div>
        </div>
    </div>

    <div id="mobile">
        <div id="navbar"><!--sidebar or nav bar for mobile-->
            <div id="mobilemenubutton" class="icon"> <i class="fas fa-bars"></i><!--burger menu on mobile--></div>
            <div class="icon"><i class="far fa-comments"></i></div>
        </div>
        <div id="mobilemenu">
                <div class="mobileoption"><a href="newevent.php">New Event <i class="far fa-plus-square"></i></a></div>
                <div class="mobileoption"><a href="newgroup.php">New Group <i class="far fa-plus-square"></i></a></div>
        </div>
        <div id="fixedmenu">
            <div class="icon"><a href="homepage.php"><i class="fas fa-home"></i></a></div>
            <div class="icon"><a href="search.php"><i class="fas fa-search"></i></a></div>
            <div class="icon"><a href="profile.php"><i class="fas fa-user"></i></a></div>
        </div>
    </div>

    <script>
        var mobileMenuButton = document.querySelector("#mobilemenubutton");
        var mobileMenu = document.querySelector("#mobilemenu");
        var userButtons = document.querySelector("#userdiv");


        mobileMenuButton.addEventListener("click", function(){
            if (mobileMenu.style.display === "block"){
                mobileMenu.style.display = "none"
            }
            else {
                mobileMenu.style.display = "block"
            }
        });
    </script>
