<?php
    require 'headerall.php';
    checkSession(False);
?>
    <style>
        @media screen and (max-width: 481px) {

            input, #loginbutton {
            margin: 45px 10px 18px 10px;
            }

            #signindiv {
                width: 340px;
            }

        }

        #divcontainer {
            text-align: center;
            display: flex;
            width: 100%;
            margin-top: 50px;
        }

        input, #loginbutton {
            display: block;
            width: 260px;
            height: 50px;
            margin: 45px 10px 18px 95px;
        }


        #loginbutton{
            border: 1px solid lightgrey;
            background-color: #E2C044;
            transition: 0.6s ease;
        }

        #loginbutton:hover {
            background-color: #b22222;
        } 

        #signindiv {
            margin: auto;
            background-color: #EAF1E4;
            width: 450px;
            box-shadow: 10px 10px 5px grey;
            border: 1px solid grey;
        }

        #signintext {
            margin-top: 10px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <?php require 'navbar.php'; ?>

    <div id="divcontainer">
        <div id="signindiv">
            <div id="signintext">SIGN IN</div>
            <input placeholder="Email Adress Or Username" id="user"><!--user name-->
            <input placeholder="Password" id="password" type="password"><!--password-->
            <button id="loginbutton">Log In</button><!--log in button-->
            <div>Dont have an account? <a href="signup.php">Signup</a></div><!--dont have an account?-->
        </div>
    </div>

    <script>
        var logInButton = document.querySelector("#loginbutton")
        var logInName = document.querySelector("#user")
        var logInPass = document.querySelector("#password")

        String.prototype.hashCode = function() {
            var hash = 0;
            if (this.length == 0) {
                return hash;
            }
            for (var i = 0; i < this.length; i++) {
                var char = this.charCodeAt(i);
                hash = ((hash<<5)-hash)+char; // bitwise operation left shift
                hash = hash & hash; // Convert to 32bit integer
            }
            return hash;
        };        
        
        logInButton.addEventListener("click", function(){
            if(logInName.value !== "" && logInPass.value !== "" ){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        var gotThis = xhttp.responseText;
                        if(gotThis === "YAY"){
                            window.location.href = "homepage.php"
                        }
                        else {
                            alert("Wrong Username or Password")
                            logInName.value = ""
                            logInPass.value = "" 
                        }
                        // console.log(gotThis);
                    }
                };
                xhttp.open("POST", "../backend/sign_log.php");
                
                var user = {
                    user_login: logInName.value,
                    user_pswrd: logInPass.value.hashCode()
                }
                var sendUser = JSON.stringify(user);
                console.log(sendUser)
                xhttp.send(sendUser);
            }
            else{
                alert("Please make sure to fill out the fileds.")
            }
        })
    </script>
</body>
</html>