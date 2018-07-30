
<head>

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
    <?php 
    include 'headerandsidebar.php';
    ?>

    <div id="allevents"><!--all events container-->
    </div>
    
</body>

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
                                "div class='date'>" + thisEvent.date + "</div>" +
                                "div class='title'> <a href='event.php?id=" + thisEvent.id + "'>" + thisEvent.title + " </a> </div>" +
                                "div class='description'>" + thisEvent.description + "</div>" +
                                "div class='location'>" + thisEvent.location + "</div>" +
                                "div class='members'>" + thisEvent.members + "</div>" +
                                "div class='likes'>" + thisEvent.likes + "</div>" +
                                "div class='price'>" + thisEvent.price + "</div>" +
                            "</div>" +
                            "<div class='hostinfo'>" +
                                "<div class='hostpicdiv'>" + 
                                    "<img class='hostpicture' src='" + thisEvent.hostPicture + "'>" + 
                                "</div>" +
                                "<div class='hostname'>" + thisEvent.hostName + "</div>" +
                                "<div class='hostdescription'>" + thisEvent.hostDescription + "</div>" +
                            "</div>" +
                        "</div>";
                        };
                    }
                };
            xhttp.open("POST", "../backend/event.php");
                var eventObj = {
                    all_events: "events",
                }
            var sendEvent = JSON.stringify(eventObj);
            xhttp.send(sendEvent);
    </script>
</html>