<?php 
include '../backend/_sessionCheck.php';
?><head>

    <style>
    @media screen and (max-width: 481px) {

        input, #submitbutton {
            margin: 45px 10px 18px 10px;
        }

        #groupdiv {
            margin: auto;
            background-color: #EAF1E4;
            /* width: 600px; */
            box-shadow: 10px 10px 5px grey;
            border: 1px solid grey;
            margin-bottom: 300px;
            text-align: center;
        }

        }

        #divcontainer {
            text-align: center;
            display: flex;
            width: 100%;
            margin-top: 30px;
        }

        input, textarea, select {
            /* display: block; */
            width: 260px;
            height: 45px;
            margin: 16px 0px 0px 15px;
        }


        #submitbutton{
            border: 1px solid lightgrey;
            background-color: #E2C044;
            margin-left: 20px;
            width: 260px;
            height: 50px;
            margin: 10px;
            transition: 0.6s ease;
            
        }

        #subitbutton:hover {
            background-color: #b22222;
        }


        #groupdiv {
            margin: auto;
            background-color: #EAF1E4;
            width: 600px;
            box-shadow: 10px 10px 5px grey;
            border: 1px solid grey;
            margin-bottom: 300px;
            text-align: center;
        }

        #text {
            margin-top: 10px;
            font-size: 24px;
        }
  
    
    </style>
</head>
    <?php 
    // include '../backend/_sessionCheck.php';
    ?>
    
    <?php include 'headerandsidebar.php';?>
    
    <div id="divcontainer">
        <div id="groupdiv">
            <div id="text">New Group</div>
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
                    group_host_id
                    group_tags
                    group_country
                    group_city
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