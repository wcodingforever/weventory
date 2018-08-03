<?php 
    require 'headerall.php';
    checkSession(FALSE);
?>
<head>
<style>
        @media screen and (max-width: 481px) {

            }

            #divcontainer {
                text-align: center;
            }

            button {
                display: block;
                width: 260px;
                height: 50px;
                margin: 18px 0px 18px 10px;
                border: 1px solid lightgrey;
            }

            #leavebutton, #removelike, #hostlogged {
                display: none;
            }

            #eventdiv {
                margin: auto;
                background-color: #EAF1E4;
                width: 600px;
                box-shadow: 10px 10px 5px grey;
                border: 1px solid grey;
                margin-bottom: 300px;
                text-align: center;
            }

            #buttons {
                display: flex;
            }
    

    </style>
</head>
<body>
    <?php 
        include 'navbar.php';
    ?>
    <div id="divcontainer">
        <div id="eventdiv">
            <div id="eventtitle"></div>
            <div id="datefrom"></div>
            <div id="dateto"></div>
            <div id="description"></div>
            <div id="location"></div>
            <div id="category"></div>
            <div id="price" ></div>
            <div id="adress"></div>
            <div id="capacity"></div>
            <div id="pic"></div>
            <div id="hostname"></div>
            <div id="hostdescription"></div>
            <div id="hostpic"></div>
            <div id="buttons">
                <div id="likediv">
                    <div id="likebutton"><i class="far fa-heart"></i></div>
                    <div id="removelike"><i class="fas fa-heart"></i></div>
                    <div id="eventlikes">34</div>
                </div>
                <div id="userlogged">
                    <button id="joinbutton">join</button>
                    <button id="leavebutton">leave</button>
                    <button id="reportbutton"><a href='report.php?id=<?php echo($event_id)?>'>Report</a></button>
                </div>
                <div id="hostlogged">
                    <button id="deletediv">Delete</button>
                    <button id="editbutton"><a href='editevent.php?id=<?php echo($event_id)?>'>Edit</a></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var eventTitle = document.querySelector("#eventtitle");
        var dateFrom = document.querySelector("#datefrom");
        var dateTo = document.querySelector("#dateto");
        var eventDesc = document.querySelector("#description");
        var eventLocation = document.querySelector("#location");
        var eventCategory = document.querySelector("#category");
        var eventPrice = document.querySelector("#price");
        var eventCapacity = document.querySelector("#capacity");
        var eventPic = document.querySelector("#pic");
        var eventHostName = document.querySelector("#hostname");
        var eventHostDescription = document.querySelector("#hostdescription");
        var eventHostPic = document.querySelector("#hostpic");
        var joinButton = document.querySelector("#joinbutton");
        var likeButton = document.querySelector("#likebutton");
        var removeLikeButton = document.querySelector("#removelike");
        var leaveButton = document.querySelector("#leavebutton");
        var eventLikes = document.querySelector("#eventlikes");
        var editButton = document.querySelector("#editbutton");
        var eventAdress = document.querySelector("#adress");
        var reportButton = document.querySelector("#reportbutton");
        var userLogged =document.querySelector("#userLogged");
        // var user = 
        <?php 
        // echo($user_login)
        ?>
        // var host = 
        <?php
        // echo($host_name)
        ?>

        // if(host === eventHostName) {
        //     hostLogged.style.display = "block";
        //     userLogged.style.display = "none";
        // }


        var counter = 0 ;

        joinButton.addEventListener("click", function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                leaveButton.style.display = "block";
                joinButton.style.display = "none";
                }
            }
                xhttp.open("POST", "../backend/event.php");

                var joined = {
                    user_joined: user
                }
                var joinedEvent = JSON.stringify(joined);
                console.log(joinedEvent)
                xhttp.send(joinedEvent);
        })

        leaveButton.addEventListener("click", function(){
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                joinButton.style.display = "block";
                leaveButton.style.display = "none";
                }
            }
            xhttp.open("POST", "../backend/event.php");

            var left = {
                user_left: user
            }
            var leftEvent = JSON.stringify(left);
            console.log(leftEvent)
            xhttp.send(ledtEvent);
        })

        likeButton.addEventListener("click", function(){
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                removeLikeButton.style.display = "block";
                likeButton.style.display = "none";
                eventLikes.innerHTML = counter + 1;
                }
            }
            xhttp.open("POST", "../backend/event.php");

            var liked = {
                user_liked: "like"
            }
            var likedEvent = JSON.stringify(liked);
            console.log(likedEvent)
            xhttp.send(likedEvent);
        })



        removeLikeButton.addEventListener("click", function(){
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
            removeLikeButton.style.display = "none";
            likeButton.style.display = "block";
            eventLikes.innerHTML = counter - 1;
                }
            }
            xhttp.open("POST", "../backend/event.php");

            var noLike = {
                user_removed_like: "removedLike"
            }
            var removedLike = JSON.stringify(noLike);
            console.log(removedLike)
            xhttp.send(removedLike);
        })



        // window.addEventListener("load", function () {
        //     var xhttp = new XMLHttpRequest();
        //     xhttp.onreadystatechange = function() {
        //         if (this.readyState == 4 && this.status == 200) {
        //         var thisEvent = JSON.parse(xhr.responseText);
        //         eventTitle.innerHTML = thisEvent.thisEventName;
        //         dateFrom.innerHTML = thisEvent.thisEventDateFrom;
        //         dateTo.innerHTML = thisEvent.thisEventDateTo;
        //         eventDesc.innerHTML = thisEvent.thisEventDescription;
        //         eventLocation.innerHTML = thisEvent.thisEventLocation;
        //         eventCategory.innerHTML = thisEvent.thisEventCategory;
        //         eventPic.src = thisEvent.thisEventPic;
        //         eventPrice.innerHTML = thisEvent.thisEventPrice;
        //         eventCapacity.innerHTML = thisEvent.thisEventCapacity;
        //         eventHostName.innerHTML = thisEvent.hostName;
        //         eventHostDescription.innerHTML = thisEvent.hostDescription;
        //         eventHostPic.src = thisEvent.hostPic;
        //         eventLikes.innerHTML = thisEvent.likes;
        //         eventAdress.innerHTML = thisEvent.adress;
        //         }
        //     };
        // xhttp.open("GET", "new_event.php");
        // xhttp.send();
        // })

        



    </script>
    
</body>

</html>