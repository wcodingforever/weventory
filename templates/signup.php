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
        }

        input, #signbutton {
            display: block;
            width: 260px;
            height: 50px;
            margin: 18px 0px 18px 10px;
        }

        #signupbutton{
            border: 1px solid lightgrey;
        }
        #loader{
            display: none;
            position: absolute;
            width: 100%;
            height: 100%;
            filter: opacity(40%);
            background-color: black;
            z-index: 100
        }
        .sk-cube-grid {
            width: 40px;
            height: 40px;
            margin: 450px auto;
        }

        .sk-cube-grid .sk-cube {
            width: 33%;
            height: 33%;
            background-color:aquamarine;
            float: left;
            -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
            animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; 
        }
        .sk-cube-grid .sk-cube1 {
        -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s; }
        .sk-cube-grid .sk-cube2 {
        -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s; }
        .sk-cube-grid .sk-cube3 {
        -webkit-animation-delay: 0.4s;
                animation-delay: 0.4s; }
        .sk-cube-grid .sk-cube4 {
        -webkit-animation-delay: 0.1s;
                animation-delay: 0.1s; }
        .sk-cube-grid .sk-cube5 {
        -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s; }
        .sk-cube-grid .sk-cube6 {
        -webkit-animation-delay: 0.3s;
                animation-delay: 0.3s; }
        .sk-cube-grid .sk-cube7 {
        -webkit-animation-delay: 0s;
                animation-delay: 0s; }
        .sk-cube-grid .sk-cube8 {
        -webkit-animation-delay: 0.1s;
                animation-delay: 0.1s; }
        .sk-cube-grid .sk-cube9 {
        -webkit-animation-delay: 0.2s;
                animation-delay: 0.2s; }

        @-webkit-keyframes sk-cubeGridScaleDelay {
            0%, 70%, 100% {
                -webkit-transform: scale3D(1, 1, 1);
                        transform: scale3D(1, 1, 1);
            } 35% {
                -webkit-transform: scale3D(0, 0, 1);
                        transform: scale3D(0, 0, 1); 
            }
        }

        @keyframes sk-cubeGridScaleDelay {
            0%, 70%, 100% {
                -webkit-transform: scale3D(1, 1, 1);
                        transform: scale3D(1, 1, 1);
            } 35% {
                -webkit-transform: scale3D(0, 0, 1);
                        transform: scale3D(0, 0, 1);
            } 
        }
    
    </style>
</head>
    
    <?php include 'headerandsidebar.php';?>

    <div id="loader">
        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
          </div>
    </div>
    
    

    <div>
        <div id="divcontainer">SIGN UP
            <input placeholder="First Name" id="firstname">
            <input placeholder="Last Name" id="lastname">
            <input placeholder="Username" id="user"><!--user name-->
            <input placeholder="Email Address" id="email" type="email">
            <input placeholder="Password" id="password" type="password"><!--password-->
            <input placeholder="Confirm Password" id="passwordcfrm" type="password"> <!--password confirmation-->
            <input type="date" id="birthday">
            <textarea id="bio"> </textarea>
            <input type="file" id="pic" accept="image/*"> 
            <input type="number" id="vericode" placeholder="Verification Code">
        </div>

            <button id="signupbutton">Sign Up</button><!--log in button-->
            <button id="sendemailbutton"> Send Verification Code</button>
            <button id="confirmcodebutton"> Confirm Verification Code </button>
            <div>Already have an account?<a href="login.php">Sign in</a></div><!--dont have an account?-->


    </div>


    <script>
        var signUpButton = document.querySelector("#signupbutton");
            signUpButton.disabled=true;
        var sendEmailButton = document.getElementById("sendemailbutton");
            sendEmailButton.disabled=true;
        var confirmVeriCodeButton= document.getElementById("confirmcodebutton");
            confirmVeriCodeButton.disabled=true;
        var firstName = document.querySelector("#firstname");
        var lastName = document.querySelector("#lastname");
        var userName = document.getElementById("user");
        var pass = document.getElementById("password");
        var passcfrm= document.getElementById("passwordcfrm");
        var email = document.querySelector("#email");
        var birthday = document.querySelector("#birthday");
        var bio = document.querySelector("#bio");
        var userPic = document.querySelector("#pic");
        var veriCode = document.getElementById("vericode");
            veriCode.disabled=true;
        var userNameCheck=false;


        
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

        userName.addEventListener("change", function(){
            var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            if(xhttp.responseText === "exists"){
                                alert("Username is taken")
                                userName.value = ""
                                userNameCheck=false;
                            }
                            else
                                userNameCheck=true;
                        }
                    };
                    xhttp.open("POST", "../backend/sign_log.php",true);
                    var login = {
                        loginCheck: userName.value
                    }
                    checkUser = JSON.stringify(login)

                    xhttp.send(checkUser);
        })
    
        email.addEventListener("change",function(){
            var emailAddress=email.value;
            console.log(typeof emailAddress);

            if(email.value===""||!(emailAddress.includes("@")))
            document.getElementById("sendemailbutton").disabled=true;
            else
            document.getElementById("sendemailbutton").disabled=false;
        })
        sendEmailButton.addEventListener("click",function(){ //key=email_varif
            document.querySelector("#loader").style.display = "block";
            if(email.value !==""){
                var emailSendxhl=new XMLHttpRequest(); 
                emailSendxhl.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        if(emailSendxhl.responseText === "sent"){
                            alert("Email has been sent!");
                            document.querySelector("#loader").style.display = "none";
                            document.getElementById("vericode").disabled=false;
                            document.getElementById("confirmcodebutton").disabled=false;
                            email.disabled=true;
                            userName.disabled=true;
                            
                        }
                        else if (emailSendxhl.responseText === "not sent"){
                            alert("Invalid Email. Check your email address again, or try a different one.");
                            document.querySelector("#loader").style.display = "none";

                        }
                    }
                }
                emailSendxhl.open("POST","../backend/sign_log.php",true);
                var emailSend={
                    valid_email: email.value,
                    valid_user: userName.value,
                    valid_name: firstName.value
                }
                var verifyEmail=JSON.stringify(emailSend); //JSON format(obj)
                emailSendxhl.send(verifyEmail);
            }
            else
                alert("email has not been entered");
            
        })
        confirmVeriCodeButton.addEventListener("click",function(){ //key=codeVerif
            var sendCodexhl= new XMLHttpRequest();
            sendCodexhl.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    if(sendCodexhl.responseText==="true"){
                        alert("Correct Verification Code");
                        document.getElementById("signupbutton").disabled=false;
                        document.getElementById("vericode").disabled=true;
                    }
                    else if(sendCodexhl.responseText==="false"){
                        alert("wrong Verification Code. Try Again");
                    }

                }
            }
            sendCodexhl.open("POST","../backend/sign_log.php",true);
            var verifyCode={
                varif_code: veriCode.value,
                varif_user: userName.value
            }
            console.log(veriCode);
            var correctCode=JSON.stringify(verifyCode);
            sendCodexhl.send(correctCode);
        })


        
        signUpButton.addEventListener("click", function(){
                if(firstName.value !== "" && lastName.value !== "" && email.value !== "" && pass.value !== "" && pass.value === passcfrm.value){
                    var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                alert("Successfully signed up!");
                                window.location.href = "../templates/login.php";
                            }
                        };

                        xhttp.open("POST", "../backend/sign_log.php", true);

                        var newUser = {
                            user_firstName: firstName.value,
                            user_lastName: lastName.value,
                            user_login: userName.value,
                            user_email: email.value,
                            user_pswrd: pass.value.hashCode(),
                            user_bday: birthday.value,
                            user_bio: bio.value,
                            user_pic: userPic.value
                        }
                        var sendUser = JSON.stringify(newUser);
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