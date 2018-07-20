<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

 
    <style>

        
        @media screen and (max-width: 481px) {

        }

        body {
            padding: 0;
            margin: 0;
            height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

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
        
    
    </style>
</head>
<body>
    
    <?php include 'headerandsidebar.php';?>
    

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
        var signUpButton = document.querySelector("#signupbutton").disabled=true;
        var sendEmailButton = document.getElementById("sendemailbutton").disabled=true;
        var confirmVeriCodeButton= document.getElementById("confirmcodebutton").disabled=true;
        var firstName = document.querySelector("#firstname");
        var lastName = document.querySelector("#lastname");
        var userName = document.getElementById("user");
        var pass = document.getElementById("password");
        var passcfrm= document.getElementById("passwordcfrm");
        var email = document.querySelector("#email");
        var birthday = document.querySelector("#birthday");
        var bio = document.querySelector("#bio");
        var userPic = document.querySelector("#pic");
        var veriCode = document.getElementById("vericode").disabled=true;
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
            if(email.value !==""){
                var emailSendxhl=new XMLHttpRequest(); 
                emailSendxhl.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        var validEmail=JSON.parse(emailSendxhl.responseText);
                        if(validEmail.email_varif === "sent"){
                            alert("Email has been sent!")
                            document.getElementById("vericode").disabled=false;
                            document.getElementById("confirmcodebutton").disabled=false;
                        }
                        else if (validEmail.email_varif === "not sent"){
                            alert("Invalid Email. Check your email address again, or try a different one.");
                        }
                        else{
                            console.log("Unknown error:Email")
                            console.log(validEmail)
                        }
                    }
                }
                emailSendxhl.open("POST","../backend/sign_log.php",true);
                var emailSend={
                    valid_email: email.value
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
                    var validCode=JSON.parse(sendCodexhl.responseText);
                    if(validCode.codeVerif==="true"){
                        alert("Correct Verification Code");
                        document.getElementById("signupbutton").disabled=false;
                        document.getElementById("vericode").disabled=true;
                    }
                    else if(validCode.codeVerif==="false"){
                        alert("wrong Verification Code. Try Again");
                    }
                    else{
                        console.log("Unknown Error: Verification");
                        console.log(validCode);
                    }
                }
            }
            validCode.open("POST","sign_log.php",true);
            var verifyCode={
                valid_code: veriCode.value
            }
            var correctCode=JSON.stringify(verifyCode);
            sendCodexhl.send(correctCode);
        })


        
        signUpButton.addEventListener("click", function(){
                if(firstName.value !== "" && lastName.value !== "" && email.value !== "" && pass.value !== "" && 
                passcfrm.value!=="" && passwordCheck===true){
                    function checkUserValid(){
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                if(xhttp.responseText === "exists"){
                                    alert("Username is taken");
                                    userName.value = "";
                                    userNameCheck=false;
                                }
                                else
                                    userNameCheck=true;
                            }
                            return userNameCheck;
                        };
                        xhttp.open("POST", "../backend/sign_log.php",true);
                        var login = {
                            loginCheck: userName.value
                        }
                        checkUser = JSON.stringify(login)
                        xhttp.send(checkUser);
                        
                    }
                    if(pass.value===passcfrm.value&&userNameCheck===true){

                    var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                console.log(xhttp.responseText);
                            }
                        };

                        xhttp.open("POST", "sign_log.php", true);

                        function checkPasswordCount(){
                            if(pass.value.length>=6)
                                var passwordCheck=false;
                            else
                                passwordCheck=true;    
                            return passwordCheck;    
                        };
                    
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
                    else
                        alert("Password confirmation do not match. Please check again")
                }
                else{
                    alert("Please make sure to fill out the fileds.")

                }
            })
    </script>
    
</body>
</html>