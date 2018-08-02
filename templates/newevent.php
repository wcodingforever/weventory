<?php 
    include 'headerall.php';
    checkSession(True);
?>
    <style>
    @media screen and (max-width: 481px) {

        input, #submitbutton {
            margin: 45px 10px 18px 10px;
        }

        #eventdiv {
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

        #submitbutton:hover{ 
            background-color: #b22222; 
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

        #text {
            margin-top: 10px;
            font-size: 24px;
        }

    </style>
</head>
<body>
    <?php include 'navbar.php';?>
    
    <div id="divconatiner">
        <div id="eventdiv">
            <div id="text">New Event</div>
            <input id="eventtitle" placeholder="Event Title"> <!--name-->
            <textarea id="description" placeholder="Description"></textarea>
            <input id="datefrom" placeholder="From" type="text" onfocus="(this.type='datetime-local')"> <!--from -->
            <input id="dateto" placeholder="To" type="text" onfocus="(this.type='datetime-local')"> <!--to-->
            <input id="location" placeholder="Location"> <!--location-->
            <select id="category"> <!--category-->
                <option>Category</option>
                <option>Outdoors and Adventure</option>
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
            <input type="number" id="capacity" min="0" placeholder="capacity"> <!--capacity-->
            <button id="submitbutton">submit</button>
        </div>
    </div>

    <script>
    // $(document).ready(function(){

    //     $.post('')

    // })
        var submitButton = document.querySelector("#submitbutton");
        var eventTitle = document.querySelector("#eventtitle");
        var dateFrom = document.querySelector("#datefrom");
        var dateTo = document.querySelector("#dateto");
        var eventDesc = document.querySelector("#description");
        var eventLocation = document.querySelector("#location");
        var eventCategory = document.querySelector("#category");
        var eventPrice = document.querySelector("#price");
        var eventCapacity = document.querySelector("#capacity");
        
        

        submitButton.addEventListener("click", function(){
            if(eventTitle.value !== "" ){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        if (this.responseText === "YAY") alert("yay it worked");
                        else { alert("Problems."); }
                        // TODO: this will bring you to the page of event 
                    }
                };
                xhttp.open("POST", "../backend/new_event.php");

                // TODO: Attach proper values for the data required.
                var event = {
                    event_name: eventTitle.value,
                    event_datefrom: dateFrom.value,
                    event_dateto: dateTo.value,
                    event_category: eventCategory.value,
                    event_description: eventDesc.value,
                    event_picture: "",
                    event_country: "",
                    event_city: "",
                    event_address: "",
                    event_privacy: 0,
                    event_group_host_id: 0,
                    event_user_host_id: 0,
                    event_price: eventPrice.value,
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