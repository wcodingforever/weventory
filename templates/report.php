<?php 
include '../backend/_sessionCheck.php';
?><head>
    <style>
        @media screen and (max-width: 481px) {

            }

            /* body {
                padding: 0;
                margin: 0;
                height: 100vh;
                width: 100vw;
                display: flex;
                align-items: center;
                justify-content: center;
            } */

            #divcontainer {
                    text-align: center;
                    position: absolute;
                    left: 300px;
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
    include 'headerandsidebar.php';
    ?>
    
    <div id="divcontainer">
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