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
        var userName = "<?php echo ($user_login); ?>";

        if(userName !== "") {
            logoutButton.style.display = "block";
            userButtons.style.display = "none";
        }

        mobileMenuButton.addEventListener("click", function(){
            if (mobileMenu.style.display === "block"){
                mobileMenu.style.display = "none";
            }
            else {
                mobileMenu.style.display = "block";
            }
        });
    </script>
