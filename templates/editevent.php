<?php 
include '../backend/_sessionCheck.php';
?><head>
    <style>
        @media screen and (max-width: 481px) {

            }

            #divcontainer {
                    text-align: center;
                    position: absolute;
                    left:300px;
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

    <?php 
    include 'headerall.php';
    ?>
    <div id="divcontainer">
        <input id="eventtitle" placeholder="Event Title"> <!--name-->
        <input id="datefrom" placeholder="From" type="text" onfocus="(this.type='date')"> <!--from -->
        <input id="dateto" placeholder="To" type="text" onfocus="(this.type='date')"> <!--to-->
        <textarea id="description" placeholder="Description"></textarea>
        <input id="location" placeholder="Location"> <!--location-->
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
        <input type="number" id="price" placeholder="price"> <!--price-->
        <input type="number" id="capacity" placeholder="capacity"> <!--capacity-->
        <input type="file" id="pic" accept="image/*">
        <button id="submitbutton">submit</button>
    </div>

    <script>
        var submitButton = document.querySelector("#submitbutton")
        var eventTitle = document.querySelector("#eventtitle")
        var dateFrom = document.querySelector("#datefrom")
        var dateTo = document.querySelector("#dateto")
        var eventDesc = document.querySelector("#description")
        var eventLocation = document.querySelector("#location")
        var eventCategory = document.querySelector("#category")
        var eventPrice = document.querySelector("#price")
        var eventCapacity = document.querySelector("#capacity")
        var eventPic = document.querySelector("#pic")


        window.onload = function () {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                var thisEvent = JSON.parse(xhr.responseText);
                eventTitle.value = thisEvent.thisEventName;
                dateFrom.value = thisEvent.thisEventDateFrom;
                dateTo.value = thisEvent.thisEventDateTo;
                eventDesc.value = thisEvent.thisEventDescription;
                eventLocation.value = thisEvent.thisEventLocation;
                eventCategory.value = thisEvent.thisEventCategory;
                eventPrice.value = thisEvent.thisEventPrice;
                event_capacity.value = thisEvent.thisEventCapacity;
                }
        };
        xhttp.open("GET", "new_event.php");
        xhttp.send();
        }

        submitButton.addEventListener("click", function(){
            if(eventTitle.value !== "" ){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert("yay it worked")//this will bring you to the page of event 
                    }
                };
                xhttp.open("POST", "new_event.php");
                
                var event = {
                    event_name: eventTitle.value,
                    event_date_from: dateFrom.value,
                    event_date_to: dateTo.value,
                    event_description: eventDesc.value,
                    event_location: eventLocation.value,
                    event_category: eventCategory.value,
                    event_price: eventPrice.value,
                    event_pic: eventPic.value,
                    event_capacity: eventCapacity.value
                }
                var sendEvent = JSON.stringify(event);
                console.log(sendEvent)
                xhttp.send(sendEvent);
            }
            else
            alert("Please make sure to fill out the fileds.")
        })
    </script>
    
</body>




</html>