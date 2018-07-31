<?php
    require 'headerall.php';
    checkSession(FALSE);

    $currPage = 1;
    $perPage = 10; // How many results per page.

    if (isset($_REQUEST['page'])) {
        $currPage = intval($_REQUEST['page']);
    }

    require '../backend/getArticles.php';
?>
    <link rel="stylesheet" href="../static/help.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <title>Help</title>
    <style>
        #readArticleContainer table{
            width: 900px;
            border-spacing: 0px;
            border-collapse: collapse;
        }
        #readArticleContainer tr,#readArticleContainer td{
            border:solid 1px black;
        }

        #readArticleContainer th{
            border:solid 1px black;    
            width: 94px;
        }

        #readArticleContainer td#readA_content{
            height: 500px;
            vertical-align: top;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div id="main_title">Can We Help you?</div>

    <!-- Search box -->
    <!-- A user can search readAcles by title/content/author/tags -->
    <div id="search_bar">
        <i class="fas fa-search"></i>
        <input id="input_for_search" type="text" placeholder="Search readAcles..">
    </div>
    <div id="kind_options">
        <div class="kind_option">
            <label for="all">All</label><input type="checkbox" name="kind" id="all" value="all">
        </div>
        <div class="kind_option">
            <label for="organizing_events">Organizing Events</label><input type="checkbox" name="kind" id="organizing_events" value="organizing_events">
        </div>
        <div class="kind_option">
            <label for="account">Account&nbsp;</label><input type="checkbox" name="kind" id="account" value="account">
        </div>
        <div class="kind_option">
            <label for="payment">Payment&nbsp;</label><input type="checkbox" name="kind" id="payment" value="payment">
        </div>
        <div class="kind_option">
            <label for="technical_issues">Technical Issues&nbsp;</label><input type="checkbox" name="kind" id="technical_issues" value="technical_issues">
        </div>
        <div class="kind_option">
            <label for="policies">Policies&nbsp;</label><input type="checkbox" name="kind" id="policies" value="policies">
        </div>
        <div class="kind_option">
            <label for="others">Others&nbsp;</label><input type="checkbox" name="kind" id="others" value="others">
        </div>

    </div>

    <!-- bulletin board -->
    <div>--bulletin board--</div>
    <div id="bulletin_board_container">
        <table>
            <thead>
                <tr id="column_names">
                    <th id="number">No.</th>
                    <th id="kind">Kind</th>            
                    <th id="title">Title</th>
                    <th id="author">Author</th>
                    <th id="date">Date</th>
                    <th id="hits">Hits</th>
                </tr>
            </thead>
            <tbody id="bulletin_board">
            <?php
                for ($i = 0; $i < count($allArticles); $i++) {
                    $thisRow = $allArticles[$i];

                    // foreach ($thisRow as $thisKey => $thisVal) {
                    $thisRowKeys = array_keys($thisRow);
                    for ($j = 0; $j < count($thisRowKeys); $j++) {
                        $thisKey = $thisRowKeys[$j];
                        $thisVal = $thisRow[$thisKey];
                        if ($thisKey === 'sticky') {
                            if ($thisVal === '1') {
                                echo "<tr style='background-color:pink;color:blue;'>";
                            }
                            else {
                                echo "<tr>";
                            }
                        }
                        else {
                            if ($thisKey === 'date') {
                                $phpdate = strtotime( $thisVal );

                                $today = new DateTime(); // This object represents current date/time
                                $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

                                $match_date = DateTime::createFromFormat( "Y-m-d H:i:s", $thisVal );
                                // $match_date = strtotime($thisVal);
                                $match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

                                $diff = $today->diff( $match_date );
                                $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

                                $thisVal = explode(" ", $thisVal);

                                if ($diffDays === 0) {
                                    $thisVal = $thisVal[1];
                                }
                                else {
                                    $thisVal = $thisVal[0];
                                }
                            }
                            echo "<td class='{$thisKey}'>{$thisVal}</td>";
                        }

                        if ($j === (count($thisRowKeys) - 1)) { echo "</tr>"; }
                    }
                }

            ?>
            </tbody>
        </table>
        <div id="pageNumbers"><?php
            $numOfPgs = 0;
            if(($totalArticles % $perPage) === 0) { $numOfPgs = floor($totalArticles/$perPage); }
            else { $numOfPgs = floor($totalArticles/$perPage) + 1; }

            for ($i = 1; $i <= $numOfPgs; $i++) {
                if ($i !== $currPage) {
                    echo "<a class='pgNums' id='p_{$i}' href='help.php?page={$i}'>[{$i}]</a>";
                }
                else {
                    echo "<span class='pgNums' id='p_{$i}'>[{$i}]</span>";
                }
            }


        ?></div>
    </div>

    <button id="write_button">Write</button>

    <!-- If a user click on the write button,  the components above(readAcle list) will be replaced with the components below(wirte writeArticleForm..-->

    <div id="write_article_container">
        <div id="new_article">
            <!-- ***Sticky field!! -->
            <!-- (Default) invisioble!! -->
            <!-- If authour is admin, sticky field'll be visible!! -->
            <div class="field" id="sticky_field">              
                    <label class="field_name" for="sticky">Sticky off</label> <input id="sticky" type="checkbox" value="sticky" name="sticky">
            </div>
            <div class="field">              
                <div class="field_name"><span style="color: red;">*</span> Title</div>
                <input type="text" name="title"></input>      
            </div>
            <!-- Passowrd(optional)=> 4 letters!!
                it's not allowed to enter more than 4 letters.  
            -->
            <div class="field">
                <div class="field_name">Password</div>
                <input type="password" name="password" maxlength="4">
            </div>
            <div class="field">   
                <div class="field_name"><span style="color: red;">*</span> Kind</div>                
                <select name="kind">
                    <option selected value="organizing_events">Organizing Events</option>
                    <option value="account">Account</option>
                    <option value="payment">Payment</option>
                    <option value="technical_issues">Technical Issues</option>
                    <option value="policies">Policies</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="field">
                <div class="field_name"><span style="color: red;">*</span> Contents</div>
                <textarea name="content"></textarea>
            </div>
            <div class="field">
                <div class="field_name">Tags</div><div id="instructionForTags">To add a tag, enter a tag and hit the enter key. To delete, click on the tag to delete.</div>
                <div><input type="text" name="tags"> MAX. 10 tags</div>
                <div id="added_tags"></div>
            </div>
            <div class="field">
                <div class="field_name">File</div>
                <input id="file_button" type="button" value="Choose Files">
                <label for="file_button"> MAX. 3 files</label>
                <input type="file" name="file" accept="audio/*,video/*,image/*" >
                <input type="file" name="file" accept="audio/*,video/*,image/*" >                
                <input type="file" name="file" accept="audio/*,video/*,image/*" > 
                <div id="added_files"></div>
            </div>
            <input id="write_article_submit_button" type="button" value="Submit" onclick="sendArticle(event);">
        </div>
    </div>

    <div id="readArticleContainer">
        <table>
            <tr>
                <th>No.</th><td id="readA_id"></td><th>Kind</th><td id="readA_kind"></td>
                 <th>Author</th><td id="readA_author"></td><th>Date</th><td id="readA_date"></td><th>Private</th><td id="readA_private"></td>
            </tr> 
            <tr>
                <th>Title</th><td colspan="9" id="readA_title"></td>
            </tr>
            <tr>
                <th>Tags</th><td colspan="9" id="readA_tags">
            </tr>
            <tr>
                <th>Files</th><td colspan="9" id="readA_files">
            </tr>
            <tr>
                <th>Contents</th><td colspan="9" id="readA_content"></td>
            </tr>
        </table>
        <button id='' onclick="sendTitleForReply()">Reply</button>
    </div>





<script>
////////////////////////////////////////bulletin board/////////////////////////////////////////
///////////////////////////////////////////Write part///////////////////////////////////////////
// const writeArticleForm = document.getElementsByTagName("form")[0];
const writeArticleForm = document.querySelector("#new_article");

// 1. Tags
// Add the tage which a user wrote when thte user enter the tags which he/she wants and hit "endter" key!!
// and and display all added tags.
var input_for_tags = document.querySelector("input[name=tags]");
var added_tags = document.getElementById("added_tags");
input_for_tags.addEventListener("keyup",add_tags);

// Add new tags to the list of tags. Must be less than 20 characters. Max 10 tags.
function add_tags(e){
    if(e.keyCode === 13) {  // If the key pressed is the Enter key.
        var errMsg = "";
        var new_tag = input_for_tags.value.toLowerCase();

        let allTags = document.querySelectorAll(".tag");

        // Checks to see if the new tag is valid.
        for (let i = 0; i < allTags.length; i++) {
            let thisTagElem = allTags[i];
            if (thisTagElem.innerHTML === "#" + new_tag) {
                errMsg += "That tag already exists.\n";
                break;
            }
        }

        if (new_tag.length > 20) errMsg += "Tags can have more than 20 characters.\n";
        if (allTags.length === 10) errMsg += "Can not have more than 10 tags.\n";

        // Everything looks good, add the tag.
        if (new_tag !== "" && errMsg === "") {
            added_tags.innerHTML += "<span class='tag'>#" + new_tag + "</span> ";

            // For the delete function of each tag.
            var spans_for_tags = writeArticleForm.querySelectorAll(".tag");
            spans_for_tags.forEach(function(span){
                span.addEventListener("click", function() {
                    // Get name of tag to delete.
                    let tag_to_delete = this.innerHTML.substr(1);

                    // Remove from the UI.
                    this.parentElement.removeChild(this);
                });
            });

            input_for_tags.value = "";
        }
        else {
            alert(errMsg);
        }
    }
}

//2. Attatched files
// 2-1. Execute an input which is not holding any file input. 
const file_button = writeArticleForm.querySelector("#file_button");
file_button.addEventListener("click", execute_fileinput);
var file_inputs = writeArticleForm.querySelectorAll("input[type=file]");

// Go through all the file inputs and find one that has not been used, and click it.
function execute_fileinput(){
    var found = false;
    for(let i = 0; i < file_inputs.length; i++){
        let this_file_input = file_inputs[i];
        if(this_file_input.files[0] === undefined ){
            this_file_input.click();
            found = true;
            break;
        }
    }

    if (!found) { alert("You can't add more than 3 files."); } 
}

// 2-2. Display a chosen file.
file_inputs.forEach(function(file_input){
    file_input.addEventListener("change", display_file);
})
const added_files = writeArticleForm.querySelector("#added_files");
var count = 0;

function display_file(e) {
    let file_name = e.target.files[0].name;
    let file_size = e.target.files[0].size;

    let existOrNot = false;
    for (let i = 0; i < file_inputs.length; i++) {
        let thisFile = file_inputs[i];
        // console.log("thisFile: ", thisFile, " this: ", this, " equal:", this === thisFile);
        if (this === thisFile) continue;
        if (thisFile.files.length > 0) {
            if (thisFile.files[0].name === file_name) {
                existOrNot = true;
            }
        }
    }

    // If the file doesn't already exist, then add it the list. Otherwise, remove the file.
    if (existOrNot === false) {
        added_files.innerHTML += "<div class='file_name'><span class='file_detail_name'>" + file_name + "</span><span class='file_detail_size'>" + file_size + " bytes</span>" +
        "  <i class='fas fa-times close_icons' id='holder_" + count + "' onclick='remove_file(event)'></i> </div>";

        var allFileLabels = writeArticleForm.querySelectorAll(".close_icons");
        allFileLabels.forEach(function(elem) {
            elem.addEventListener("click", function() {
                let thisFileElem = this.parentElement;
                let thisFileName = thisFileElem.querySelector(".file_detail_name").innerHTML;

                // Delete the file from file input elements.
                for (let i = 0; i < file_inputs.length; i++) {
                    let this_file_input = file_inputs[i];
                    if (this_file_input.files[0] !== undefined && this_file_input.files[0].name === thisFileName) {
                        this_file_input.value = "";
                    }
                }

                // Delete the div from the list of files on the UI.
                thisFileElem.parentElement.removeChild(thisFileElem);
            });
        });

    } else {
        e.target.value = "";  // Remove the file from the input.
    }
}

// 3. Control the sticky button behavior.
const stickyOrNot = writeArticleForm.querySelector("input[name=sticky]");
const stickyBox = stickyOrNot.parentElement;

stickyOrNot.addEventListener("change", function (){
    if(this.checked === true){
        stickyBox.querySelector("label").innerText = "Sticky on";
        stickyBox.classList.add("sticky_is_on");
    }else{
        stickyBox.querySelector("label").innerText = "Sticky off";
        stickyBox.classList.remove("sticky_is_on");
    }
});

// 4. Send article to database.
function sendArticle(e){
    e.preventDefault();
    let select = writeArticleForm.querySelector("select[name=kind]");
    let files = [];
    for(let holder_name in file_holders){
        let file_name = file_holders[holder_name];
       if(file_name !== null){
        files.push(file_name);
       }
    };
    let json_files = JSON.stringify(files);
    let json_tags = JSON.stringify(tags);
    
    //var author_id  = session!*****
    let author_id = "user12";
    let sticky = writeArticleForm.querySelector("input[name=sticky]").checked;
    let title = writeArticleForm.querySelector("input[name=title]").value;
    let password = writeArticleForm.querySelector("input[name=password]").value;
    let kind = select.options[select.selectedIndex].value;
    let content = writeArticleForm.querySelector("textarea").value;

    //Default 
    let parent_article_id = null;
    //If it's the reply to an article, 
    if (reply === true){
        parent_article_id = articleId_forReply;
        articleId_forReply = null;
        title_forReply = null;
    }

    // If a user didn't fill any necessary filds, don't allow to write an readAcle!
    if(title !== "" && content !== ""){

        let obj = {
            sticky:sticky,
            author_id: author_id,        
            title: title,
            password: password,
            kind: kind,
            content: content,
            files: json_files,
            tags: json_tags,
            parent_article_id: parent_article_id
        };

        let json = JSON.stringify(obj);

        const ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){

            if(this.status == 200 && this.readyState == 4){
                let result = ajax.responseText;
                //If an error's occured, it'll be reported in the console.
                if(result !== "sent"){
                    console.log(result);
                }
            }

        }
        ajax.open("POST","../backend/sendNewreadAcle_help.php", true);        
        ajax.send(json);

        //Reset all inputs' values to their default values. 
        stickyOrNot.checked = false;
        writeArticleForm.querySelector("input[name=title]").value = "";
        writeArticleForm.querySelector("input[name=password]").value = "";
        select.selectedIndex = 0;
        writeArticleForm.querySelector("textarea").value = ""; 
        tags = [];
        new_tag = "";
        input_for_tags.value = "";
        added_tags.innerHTML = "";
        added_files.value = "";
        file_inputs.forEach(function(file_input){
            file_input.value = "";
        })
        file_holders = {
            holder_0: null,
            holder_1: null,
            holder_2: null,
        };
        
    }else{
        alert("Please fill all necessary filds.");
    }
}           // id: id
            // sticky:sticky, -> x
            // author_id: author_id,        
            // title: title,
            // password: password, -> x
            // kind: kind,
            // content: content,
            // files: json_files,
            // tags: json_tags,


// 4. Get single article from the database and display on the UI.
const readArticle_table = document.querySelector("#readArticleContainer table");
//For the case where a user want a reply to the article, 
//store the id and title of the article.
var articleId_forReply;  
var title_forReply;

var allRowsInBB = document.querySelectorAll("#bulletin_board tr");
allRowsInBB.forEach(function(thisOne, i) {
    thisOne.addEventListener("click", function() {
        var thisId = this.querySelector(".id").innerHTML;
        showArticle(thisId);
    })
});

function showArticle(inId){
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200 ){
            let json_article = ajax.responseText;
            let articleObj = JSON.parse(json_article);
            let privateOrNot = "Public";
            if(articleObj["password"] !== null){
                privateOrNot = "Private";
            }

            let tags = JSON.parse(articleObj["tags"]); 
            let newTxtForTags = "";
            for(let i = 0; i < tags.length; i++){
                newTxtForTags += "<span class='readA_tags'>#" + tags[i] + "&nbsp;</span>";
            }
            
            let json_files = JSON.parse(articleObj["files"]); 

            readArticle_table.querySelector("#readA_id").innerHTML = articleObj["id"];
            readArticle_table.querySelector("#readA_kind").innerHTML = articleObj["kind"];
            readArticle_table.querySelector("#readA_title").innerHTML = articleObj["title"];
            readArticle_table.querySelector("#readA_author").innerHTML = articleObj["author_id"];
            readArticle_table.querySelector("#readA_date").innerHTML = articleObj["date"];
            readArticle_table.querySelector("#readA_private").innerHTML = privateOrNot;
            readArticle_table.querySelector("#readA_tags").innerHTML = newTxtForTags;
            // readArticle_table.querySelector("#readA_files").innerHTML = articleObj["files"];
            readArticle_table.querySelector("#readA_content").innerHTML = articleObj["content"];

            //For a reply article
            title_forReply = articleObj["title"];
        }
    }
    ajax.open( "POST", "../backend/getArticles_help.php", true);
    ajax.send( '{ "type": "id", "id": "' + inId + '" }');
    
}

var reply = false;

function sendTitleForReply(){
    //toggle the write article page to 'ON'. 
    let titleInput = document.querySelector("#new_article input[name=title]");
    titleInput.value = "Re: " + title_forReply;  
    reply = true; 
}

</script>
</body>
</html>