<?php
    require 'headerall.php';
    checkSession(False);
?>
    <style>
         @media screen and (max-width: 481px) {
             .description, hostdescription {
                 display: none;
             }
        }
        body {
            padding: 0px;
            margin: 0px;
            height: 100vh;

        }
        #allevents {
            width: 800px;
            position: absolute;
            top: 200px;
            left: 240px;
            height: 600px;
            overflow-y: scroll;
            background-color: #EAF1E4;
            box-shadow: 10px 10px 5px grey;
            border: 1px solid grey; 
            margin-bottom: 300px;
        }

        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
    </style>
</head>
<body>
    <?php 
        include 'navbar.php';
    ?>

    <div id="allevents"><!--all events container-->
    </div>
    
    <script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                var response = xhttp.responseText;
                response = JSON.parse(response);
                console.log(response); 
            
                for (var i=0; i<response.length; i++) {
                    var thisEvent = response[i];
                    var myId = thisEvent.id
                    var allEvents = document.querySelector("#allevents");
                    allEvents.innerHTML += 
                    "<div class='oneevent' id='eventid" + thisEvent.id + "'>" +
                        "<div class='eventinfo'>" +
                            "<div class='date'>" + thisEvent.dateFrom + "</div>" +
                            "<div class='title'> <a href='event.php?id=" + thisEvent.id + "'>" + thisEvent.name + " </a> </div>" +
                            "<div class='description'>" + thisEvent.description + "</div>" +
                            "<div class='location'>" + thisEvent.address + "</div>" +
                            "<div class='members'>" + thisEvent.capacity + "</div>" +
                            "<div class='likes'>10</div>" +
                            "<div class='price'>" + thisEvent.price + "</div>" +
                        "</div>" +
                        "<div class='hostinfo'>" +
                            "<div class='hostpicdiv'>" + 
                                "<img class='hostpicture' src='" + thisEvent.picture + "'>" + 
                            "</div>" +
                            "<div class='hostname'>" + thisEvent.hostName + "</div>" +
                            "<div class='hostdescription'>" + thisEvent.hostDescription + "</div>" +
                        "</div>" +
                    "</div>";
                    };
                }
            };
        xhttp.open("POST", "../backend/tryevents.php", true);
        var eventObj = { filtered_by: "default" }
        var sendEvent = JSON.stringify(eventObj);
        xhttp.send(sendEvent);
    </script>
</body>
</html>