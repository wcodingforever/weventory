<?php include '../backend/_sessionCheck.php';
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
    <?php include 'headerandsidebar.php';?>
    
    <div>
        <div id="divcontainer">
            <div id="firstName" ><input> </div>
            <div id="lastName" ><input> </div>
           
            <div id="bio"> <textarea style='margin: 0px;width: 255px; height: 110px'></textarea> </div>
            <div id="birthday" type="date" > <input type="date"> </div>
            <div id="pic" type="file" accept="image/*" > <input type="file" accept="image/*"> 
            </div>
        </div>
        <div id="replacement">
            <div id="fN"><input></div>
            <div id="lN"><input></div>
            <div id="bi"><input></div>
            <div id="bD"><input></div>
            <div id="pC"><input></div>
        </div>
        <div id="userid"></div>
        <div id="checkprofile"></div>

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
        var CheckProfile=document.getElementById("checkprofile");

        var fnPlaceHolder=document.getElementById("fN").style.display="none";
        var lnPlaceHolder=document.getElementById("lN").style.display="none";
        var bioPlaceHolder=document.getElementById("bi").style.display="none";
        var bdPlaceHolder=document.getElementById("bD").style.display="none";
        var picPlaceHolder=document.getElementById("pC").style.display="none";


        var editButton=document.getElementById("editbutton");
            editButton.style.display="none";
        var cancelButton=document.getElementById("cancelbutton");
            cancelButton.style.display="none";
        var submitButton=document.getElementById("submitbutton");
            submitButton.style.display="none";
        var reportButton=document.getElementById("reportbutton");
        

        window.addEventListener("load",function(){
            var ajaxReceive = new XMLHttpRequest();     
            ajaxReceive.onreadystatechange=function(){
               
                if (this.readyState===4 && this.status===200){
                    console.log("success");

                    var userProfile=JSON.parse(this.responseText);
                    
                    userBio.innerHTML=userProfile.bio;
                    firstName.innerHTML=userProfile.f_name;
                    lastName.innerHTML=userProfile.l_name;
                    userBD.innerHTML=userProfile.b_day;
                    userPicture.innerHTML=userProfile.pic;

                    userID=userProfile.user_login;
                    CheckProfile=userProfile.user_check;// key for checking if the person vieweing the profile is the owner of the
                                                        // profile. Returns true if the viewer is the owner and false if it is diff person.

                    fnPlaceHolder=userProfile.f_name;
                    lnPlaceHolder=userProfile.l_name;
                    bioPlaceHolder=userProfile.bio;
                    bdPlaceHolder=userProfile.b_day;
                    picPlaceHolder=userProfile.pic;
                    
                }
                if (CheckProfile===true){
                    editButton.style.display="block";
                }
            }
            ajaxReceive.open("POST", "../backend/user_profile.php", true);

            var id={
                user_login:userID,
                user_check:CheckProfile
            }
            var idCheck = JSON.stringify(id); 
            ajaxReceive.send(idCheck);



            editButton.addEventListener("click", function(){
                console.log("editbutton");
                var asdf=document.createElement("input");
                cancelButton.style.display="block";
                submitButton.style.display="block";
                editButton.style.display="none";
                
                userBio.innerHTML="<textarea id='newbio' style='margin: 0px;width: 255px; height: 110px'> "+bioPlaceHolder+"  </textarea>";
                firstName.innerHTML="<input id='newfirstname' type='text' value='"+fnPlaceHolder+"'>";
                lastName.innerHTML="<input id='newlastname' type='text' value='"+lnPlaceHolder+"'>";
                userBD.innerHTML="<input id='newbday' type='date' value='"+bdPlaceHolder+"'>";
                userPicture.innerHTML="<input id='newpic' type='file' accept='image/*' value="+picPlaceHolder+">";
                

                cancelButton.addEventListener("click",function(){
                    cancelButton.style.display="none";
                    submitButton.style.display="none";
                    editButton.style.display="block";
                    userBio.innerHTML=bioPlaceHolder;
                    firstName.innerHTML=fnPlaceHolder;
                    lastName.innerHTML=lnPlaceHolder;
                    userBD.innerHTML=bdPlaceHolder;
                    userPicture.innerHTML=picPlaceHolder;
                    return;
                })

                submitButton.addEventListener("click",function(){
                    cancelButton.style.display="none";
                    submitButton.style.display="none";
                    editButton.style.display="block";
                    
                    var httpx= new XMLHttpRequest();
                    httpx.onreadystatechange= function(){
                        if (this.readyState===4 && this.status===200){
                            alert("Your profile has been changed!");
                            

                        }
                    }
                    
                    httpx.open("POST", "../backend/user_profile.php", true);
                    var newProfile = {
                                user_firstName:firstName.innerHTML,
                                user_lastName:lastName.innerHTML,
                                user_bday:userBD.innerHTML,
                                user_bio:userBio.innerHTML,
                                user_pic:userPicture.innerHTML
                            }
                    var sendNewProf=JSON.stringify(newProfile);    
                    httpx.send(sendNewProf);
                    location.reload();
                    
                   
                }) 
            
            })
        })    

    </script>
</body>
</html>