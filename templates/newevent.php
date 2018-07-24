<?php include '../backend/_sessionCheck.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Document</title>

    <style>
        @media screen and (max-width: 481px) {

            }

            body {
                padding: 0;
                margin: 0;
                height: 100vh;
                width: 100vw;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #divcontainer {
                    text-align: center;
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
<body>
    <?php include '../backend/_sessionCheck.php';?>
    
    <?php include 'headerandsidebar.php';?>
    
    <div>
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
        <button id="submitbutton">submit</button>
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
                        alert("yay it worked")//this will bring you to the page of event 
                    }
                };
                xhttp.open("POST", "../backend/new_event.php");
                
                var event = {
                    event_name: eventTitle.value,
                    event_date_from: dateFrom.value,
                    event_date_to: dateTo.value,
                    event_description: eventDesc.value,
                    event_location: eventLocation.value,
                    event_category: eventCategory.value,
                    event_price: eventPrice.value,
                    // event_pic,
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