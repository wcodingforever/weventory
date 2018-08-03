<?php 
    require 'headerall.php';
    checkSession(FALSE);
?>
<head>
<script src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" crossorigin></script>
        <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
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
                    <div id="eventlikes"></div>
                </div>
                <div id="userlogged">
                    <button id="joinbutton">join</button>
                    <button id="leavebutton">leave</button>
                    <button id="reportbutton"><a href='report.php?id="<?php echo($event_id)?>"'>Report</a></button>
                </div>
                <div id="hostlogged">
                    <button id="deletediv">Delete</button>
                    <button id="editbutton"><a href='editevent.php?id=<?php echo($event_id)?>'>Edit</a></button>
                </div>
            </div>
            <div id="root"></div>
        </div>
    </div>

    <script>
        var eventTitle = document.querySelector("#eventtitle");
        var dateFrom = document.querySelector("#datefrom");
        var dateTo = document.querySelector("#dateto");
        var eventDesc = document.querySelector("#description");
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
        var user = '<?php echo($user_login)?>'
        // var host = 
        <?php
        // echo($host_name)
        ?>

        // if(host === eventHostName) {
        //     hostLogged.style.display = "block";
        //     userLogged.style.display = "none";
        // }



        var counter = 34 ;

        joinButton.addEventListener("click", function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                leaveButton.style.display = "block";
                joinButton.style.display = "none";
                }
            }
                xhttp.open("POST", "../backend/new_event.php");

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
            xhttp.open("POST", "../backend/new_event.php");

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
            xhttp.open("POST", "../backend/new_event.php");

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
            xhttp.open("POST", "../backend/new_event.php");

            var noLike = {
                user_removed_like: "removedLike"
            }
            var removedLike = JSON.stringify(noLike);
            console.log(removedLike)
            xhttp.send(removedLike);
        })
        var thisEventIs = false
        thisEventIs = <?php if(isset($_GET['id'])) echo($_GET['id'])?>;

        var eventId = "";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = xhttp.responseText;
                thisEvent = JSON.parse(response);
                console.log(thisEvent);
                var eventId = thisEvent.id;
                eventTitle.innerHTML = thisEvent.name;
                dateFrom.innerHTML = thisEvent.datefrom;
                dateTo.innerHTML = thisEvent.dateto;
                eventDesc.innerHTML = thisEvent.description;
                eventCategory.innerHTML = thisEvent.category;
                eventPic.src = thisEvent.picture;
                eventPrice.innerHTML = thisEvent.price;
                eventCapacity.innerHTML = thisEvent.capacity;
                eventHostName.innerHTML = thisEvent.hostName;
                eventHostDescription.innerHTML = thisEvent.hostDescription;
                eventHostPic.src = thisEvent.hostPic;
                eventLikes.innerHTML = thisEvent.likes;
                eventAdress.innerHTML = thisEvent.address;
                console.log(eventId)
            }
        };
    xhttp.open("POST", "../backend/new_event.php");
    var eventObj = { filtered_by: "default" }
    if (thisEventIs){
        eventObj = { thisEvent: thisEventIs }
    }
    var sendEvent = JSON.stringify(eventObj);
    xhttp.send(sendEvent);
     console.log(eventId)


    </script>
    <script src="./react/allcomments.js" type="text/babel"></script>
    <script src="./react/commentscomponent.js" type="text/babel"></script>
    <script src="./react/newcomment.js" type="text/babel"></script>
    <script src="./react/onecomment.js" type="text/babel"></script>
    <script src="./react/reply.js" type="text/babel"></script>
    <script src="App.js" type="text/babel"></script>
    <script type="text/babel">
        ReactDOM.render(<App/>, document.querySelector('#root'));
    </script>
    
</body>

</html>