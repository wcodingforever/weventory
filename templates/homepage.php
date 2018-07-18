
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
            width: 600px;
            position: absolute;
            top: 160px;
            left: 340px;
            height: 600px;
            overflow-y: scroll;
            background-color: #EAF1E4; 
        }

        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
        /* #bottom {
            bottom: 0px;
            width: 100%;
            height: 150px;

        } */
    
    </style>
</head>
<body>
    <?php include 'headerandsidebar.html';?>

    <div id="allevents"><!--all events container-->
    </div>
    <!-- <div id="bottom"></div> -->
    
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
                                "div class='title'> <a href='event.html?id=" + thisEvent.id + "'>" + thisEvent.title + " </a> </div>" +
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
            xhttp.open("POST", "");
                var eventObj = {
                    all_events: "events",
                }
            var sendEvent = JSON.stringify(eventObj);
            xhttp.send(sendEvent);
    </script>
</html>