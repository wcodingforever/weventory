<?php include '../backend/_sessionCheck.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    
    <?php include 'headerandsidebar.php';?>
    
    <div>
        <input id="reporttitle" placeholder="Title"> <!--name-->
        <select id="category"> <!--category-->
            <option>Reason</option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
            <option></option>
        </select>
        <textarea id="description" placeholder="Description"></textarea>
        <button id="submitbutton">submit</button>
    </div>

    <script>
        var submitButton = document.querySelector("#submitbutton");
        var reportTitle = document.querySelector("#reporttitle");
        var category = document.querySelector("#category");
        var description = document.querySelector("#description");

        submitButton.addEventListener("click", function(){
            if(reportTitle.value !== "" ){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert("yay it worked")//this will bring you to the page of event 
                    }
                };
                xhttp.open("POST", "../backend/report.php");
                
                var report = {
                    report_name: reportTitle.value,
                    report_category: category.value,
                    report_description: description.value,
                    // id: 
                }
                var sendReport = JSON.stringify(report);
                console.log(sendReport)
                xhttp.send(sendReport);
            }
            else
            alert("Please make sure to fill out the fileds.")
        })
    </script>
    
</body>
</html>