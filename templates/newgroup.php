<?php 
include '../backend/_sessionCheck.php';
?><head>

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

            input, #submitbutton {
                display: block;
                width: 260px;
                height: 50px;
                margin: 18px 0px 18px 10px;
            }

            #submitbutton{
                border: 1px solid lightgrey;
            }
    
    </style>
</head>
    <?php include '../backend/_sessionCheck.php';?>
    
    <?php include 'headerandsidebar.php';?>
    
    <div id="divcontainer">
        <input id="groupname" placeholder="Name of the group"> <!--name-->
        <textarea id="description" placeholder="Description"></textarea>
        <select id="category"> <!--category-->
            <option>Category</option>
            <option >Outdoors and Adventure</option>
            <option>Tech</option>
            <option>Family</option>
            <option>Health and Wellness</option>
            <option>Sports and Fitness</option>
            <option>Music</option>
            <option>Film</option>
            <option>Arts</option>
            <option>Book Clubs</option>
            <option>Dance</option>
            <option>Fashion and Beauty</option>
            <option>Career and Buissiness</option>
        </select>
        <input type="file" id="pic" accept="image/*"> 
        <button id="submitbutton">submit</button>
    </div>

    <script>
        var submitButton = document.querySelector("#submitbutton")
        var groupCategory = document.querySelector("#category")
        var groupName = document.querySelector("#groupname")
        var groupDescription = document.querySelector("#description")
        var groupPic = document.querySelector("#pic")
        
        
        submitButton.addEventListener("click", function(){
            if(groupName.value !== "" ){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert("yay it worked")//this will bring you to the page of group
                    }
                };
                xhttp.open("POST", "../backend/new_group.php");
                
                var group = {
                    group_name: groupName.value,
                    group_description: groupDescription.value,
                    group_category: groupCategory.value,
                    group_pic: groupPic.value,
                    // group_host_id
                    
                }
                var sendGroup = JSON.stringify(group);
                console.log(sendGroup)
                xhttp.send(sendGroup);
            }
            else
            alert("Please make sure to fill out the fileds.")
        })
    </script>
    
</body>




</html>