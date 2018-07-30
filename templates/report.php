<?php 
include '../backend/_sessionCheck.php';
?><head>
    <style>
        @media screen and (max-width: 481px) {

        input, #submitbutton {
            margin: 45px 10px 18px 10px;
        }

        #reportdiv {
            width: 340px;
        }

        }

        #divcontainer {
            text-align: center;
            display: flex;
            width: 100%;
            margin-top: 50px;
        }

        input, #submitbutton {
            display: block;
            width: 260px;
            height: 50px;
            margin: 45px 10px 18px 95px;
        }


        #submitbutton{
            border: 1px solid lightgrey;
            background-color: #E2C044;
            transition: 0.6s ease;
        }

        #submitbutton:hover {
            background-color: #b22222;
        } 

        #reportdiv {
            margin: auto;
            background-color: #EAF1E4;
            width: 450px;
            box-shadow: 10px 10px 5px grey;
            border: 1px solid grey;
        }

        #reporttext {
            margin-top: 10px;
            font-size: 24px;
        }
    
    </style>
</head>
    
    <?php 
    include 'headerandsidebar.php';
    ?>
    
    <div id="divcontainer">
        <div id="reportdiv">
            <div id="reporttext">Report</div>
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