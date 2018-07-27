<head>
    <style>

        @media screen and (max-width: 481px) {

        }

        /* body {
            padding: 0;
            margin: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        } */

        #divcontainer {
                text-align: center;
                position: absolute;
                left: 300px;
        }

        input, #loginbutton {
            display: block;
            width: 260px;
            height: 50px;
            margin: 18px 0px 18px 10px;
        }

        #loginbutton{
            border: 1px solid lightgrey;
        }
    </style>

</head>
    <?php include 'headerandsidebar.php';?>
    
    <div id="divcontainer">
        <div>SIGN IN</div>
        <input placeholder="Email Adress Or Username" id="user"><!--user name-->
        <input placeholder="Password" id="password" type="password"><!--password-->
        <button id="loginbutton">Log In</button><!--log in button-->
        <div>Dont have an account?<a href="signup.php">Signup</a></div><!--dont have an account?-->
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