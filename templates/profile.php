<?php 
include '../backend/_sessionCheck.php';
?><head>
    <style>
    
    </style>
</head>
    <?php 
    include 'headerandsidebar.php';
    ?>
    
    <div>
        <div id="divcontainer">
            <div id="firstName" ></div>
            <div id="lastName" >  <input id="newlastname"> </div>
           
            <div id="bio"> <textarea id="newbio"></textarea> </div>
            <div id="birthday" type="date" > <input id="newbd" type="date"> </div>
            <div id="pic" type="file" accept="image/*" > <input id="newpicture" type="file" accept="image/*"> 
            </div>
        </div>
        <div id="userid"></div>
        <button id="editbutton">Edit </button>
        <button id="cancelbutton" >Cancel</button>
        <button id="submitbutton" >Submit</button>
        <button id="reportbutton"> Report User </button>
        
    </div>
    <script>
        var firstName= document.getElementById("firstName");
        var lastName= document.getElementById("lastName");
        var userBio= document.getElementById("bio");
        var userBD= document.getElementById("birthday");
        var userPicture= document.getElementById("pic");
        var userID=document.getElementById("userid");

        var editButton=document.getElementById("editbutton");
            // editButton.style.display="none";
        var cancelButton=document.getElementById("cancelbutton");
            cancelButton.style.display="none";
        var submitButton=document.getElementById("submitbutton");
            submitButton.style.display="none";

        window.addEventListener("load",function(){

        var ajaxReceive = new XMLHttpRequest();     
        ajaxReceive.open("GET", "user_profile.php", true);  //php name = user_profile.php
        ajaxReceive.onreadystatechange=function(){
            if (this.readyState==4 && this.status==200){
                alert("this is working");
                var userProfile=JSON.parse(this.responseText);
                
                // userBio.innerHTML="<input id='newfirstname' type='text' value="+userProfile.bio+">";
                userBio.innerHTML=userProfile.bio;
                firstName.innerHTML=userProfile.f_name;
                lastName.innerHTML=userProfile.l_name;
                userBD.innerHTML=userProfile.b_day;
                userPicture.innerHTML=userProfile.pic;
                userID=userProfile.user_login;
            }
            else{
                alert("there is an error: receiving");
            }
            var id={
                user_login:userID
            }
            var idCheck=JSON.stringify(id);
            ajaxReceive.send(idCheck);
            if(ajaxReceive.responseText==="true")   //responsetext needs to be true to edit
                editButton.style.display="block";
        editButton.addEventListener("click", function(){
            cancelButton.style.display="block";
            submitButton.style.display="block";
            editButton.style.display="none";
            userBio.innerHTML="<input id='newbio' type='text' value="+userProfile.bio+">"; //input is changeable
            firstName.innerHTML="<input id='newfirstname' type='text' value="+userProfile.frstnm+">";
            lastName.innerHTML="<input id='newlastname' type='text' value="+userProfile.lstnm+">";
            userBD.innerHTML="<input id='newbday' type='date' value="+userProfile.bd+">";
            userPicture.innerHTML="<input id='newpic' type='file' accept='image/*' value="+userProfile.pic+">";
            // firstName=newFirstName.value;
            // lastName=newLastName.value;
            // userBD=newUserBD.value;
            // userBio=newUserBio.value;
            // userPicture=newUserPicture.value;

            cancelButton.addEventListener("click",function(){
                cancelButton.style.display="none";
                submitButton.style.display="none";
                editButton.style.display="block";
            })

            submitButton.addEventListener("click",function(){
                cancelButton.style.display="none";
                submitButton.style.display="none";
                editButton.style.display="block";
                var httpx= new XMLHttpRequest();
                httpx.onreadystatechange= function(){
                    if (this.readyState==4 && this.status==200){
                        alert("Your profile has been changed!");
                        var newProfile = {
                            user_firstName:firstName.value,
                            user_lastName:lastName.value,
                            user_bday:userBD.value,
                            user_bio:userBio.value,
                            user_pic:userPicture.value
                        }
                        
                    }
                }
            var sendNewProf=JSON.stringify(newProfile);    
            httpx.send(sendNewProf);
            httpx.open("POST", "user_profile.php", true);
            })


        })

        }
    })

    </script>
</body>
</html>