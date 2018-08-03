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
        .field:nth-child(2){
            display: block;
        }
        .field:nth-child(3){
            display:inline-block;
            margin-top: 10px;
        }
        .field:nth-child(4){
            display: inline-block;
            margin-left: 38px;
        }
        .field:nth-child(5) .field_name{
            position: relative;
            top: -494px;
        }
        .field:nth-child(7){
            position: absolute;
            top: 1023px;
        }
        .field:nth-child(8){
            margin-top: 12px;
        }
        .field:nth-child(7) .field_name{
            display: inline-block;
        }
        #read_article_container table{
            width: 900px;
            border-spacing: 0px;
            border-collapse: collapse;
        }
        #read_article_container tr,#read_article_container td{
            border:solid 1px black;
        }

        #read_article_container th{
            border:solid 1px black;    
            width: 94px;
        }
        #bulletin_board_container #pageNumbers{
            text-align: center;
            margin: 40px 0;
        }
        #bulletin_board_container #write_button{
            cursor:pointer;
            font-size: 20px;
            color: #2196F3;
            background-color: #ffffff;
            height: 51px;
            width: 162px;
            margin-left: 1174px;
            font-weight: bold;
        } 
        .hideContent{
            color: #e7e5e2;
        }
        td.showContent{
            color: black;
        }
        .hideField{
            visibility: hidden;
        }
        #enterPW{
            width: 500px;
            margin: auto;
            text-align: center;
            position: absolute;
            top: 605px;
            left: 503px;
        }
        #enterPW div{
            margin: 8px;
        }
        #read_article_container .backToBBButton{
            cursor:pointer;
            font-size: 20px;
            color: #2196F3;
            background-color: #ffffff;
            height: 51px;
            width: 156px;
            font-weight: bold;
            margin: 20px 0px;
            position: relative;
            top: -95px;
        }
        #write_article_container .backToBBButton{
            cursor:pointer;
            font-size: 20px;
            color: #2196F3;
            background-color: #ffffff;
            height: 51px;
            width: 156px;
            font-weight: bold;
            position: relative;
            top: 55px;
        }
        .container{
            width: 745px;
            margin: 50px 0px;
            margin-left: 149px;
        }
        .container div{
            padding: 3px;
        }
        .n_id{
            width: 35px;
        }
        .d_id{
            width: 80px;
        }
        .n_date{
            width: 78px;
        }
        .d_date{
            width: 239px;
        }
        .n_author{
            width: 103px;
        }
        .d_author{
            width: 200px;
        }
        .n_kind{
            width: 78px;
        }
        .d_kind{
            width: 232px;
        }
        .n_title{
            width: 78px;
        }
        .d_title{
            width: 682px;
        }
        .n_pw{
            width: 106px;
        }
        .d_pw{
            width: 644px;
        }
        div.d_content{
            height: 600px;
            margin: 3px 0px;
            padding: 0px;
            width: 741px;
            overflow-y: scroll;
        }
        .rows{
            display:flex;
            /* width:  */
        }
        .fn{
            background-color: #cfcece91;
        }
        .data{
            background-color: #f5f5f54f;
        }   
        #titleForReplys{
            font-size: 52px;
            font-family: cursive;
            color: gray;
            margin: 40px 0px;
        }
        #readA_content.showContent{
            color: black;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div id="main_title">Can We Help you?</div>

    <!-- Search box -->
    <!-- A user can search readAcles by title/content/author/tags -->
    <!-- <div id="search_bar">
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

    </div> -->

    <!-- bulletin board -->
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
                    $privateOrNot = false;
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
                            }else if($thisKey === "password"){
                                if($thisVal !== null){
                                    $privateOrNot = true; 
                                }
                                continue;
                            }

                            if($thisKey === "title" && $privateOrNot === true){
                                echo "<td class='{$thisKey}'>{$thisVal}&nbsp;<i class='fas fa-lock'></i></td>";
                            }else{
                                echo "<td class='{$thisKey}'>{$thisVal}</td>";
                            }
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
        <button id="write_button">Ask for Help</button>
    </div>


    <!-- If a user click on the write button,  the components above(readAcle list) will be replaced with the components below(wirte writeArticleForm..-->

    <div id="write_article_container">
        <div id="new_article">
            <!-- ***Sticky field!! -->
            <!-- (Default) invisible!! -->
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
            <button class='backToBBButton' onclick="backToBB();" ><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>Back</button>
            <input id="write_article_submit_button" type="button" value="Submit" onclick="sendArticle(event);">
        </div>
    </div>

    <div id="read_article_container">
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
        <button id='readA_replyButton' onclick="sendTitleForReply()">Reply</button>
        <button class='backToBBButton' onclick="backToBB();" ><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>Back</button>
    </div>





<script>
////////////////////////////////////////bulletin board/////////////////////////////////////////
// const writeArticleForm = document.getElementsByTagName("form")[0];
const user_login = "<?php echo $user_login; ?>";
const writeArticleForm = document.querySelector("#new_article");

//Toggle each part (bulletin board/ write article/ read article)
const bulletin_board_container = document.querySelector("#bulletin_board_container");
const write_article_container = document.querySelector("#write_article_container");
const read_article_container = document.querySelector("#read_article_container");

function togglePg(partElem, isOn, reload=false){
    let classList = partElem.classList;
    if(isOn){
        partElem.classList.remove("toggleOff");
        partElem.classList.add("toggleOn");
    }else if(reload){
        window.location.reload();
    }
    else{
        partElem.classList.remove("toggleOn");
        partElem.classList.add("toggleOff");
    }
}
//Default setting for toggles. 
togglePg(bulletin_board_container, true);
togglePg(write_article_container, false);
togglePg(read_article_container, false);



///////////////////////////////////////////Write part///////////////////////////////////////////
//Toggle write part
const write_button = document.querySelector("#write_button");
write_button.addEventListener("click", function(){
    togglePg(write_article_container, true);
    togglePg(bulletin_board_container, false);
    
    let sticky_f = write_article_container.querySelector("#sticky_field");
    if(user_login !== "admin"){
        sticky_f.classList.add("hideField");
    }else{        
        sticky_f.classList.remove("hideField");
    }
});

function backToBB(){
    window.location = "http://localhost/New%20folder/weventory/templates/help.php";    
}

// 1. Tags
// Add the tage which a user wrote when thte user enter the tags which he/she wants and hit "endter" key!!
// and and display all added tags.
var input_for_tags = document.querySelector("input[name=tags]");
var added_tags = document.getElementById("added_tags");
input_for_tags.addEventListener("keyup",add_tags);
var allTags = document.querySelectorAll(".tag");


// Add new tags to the list of tags. Must be less than 20 characters. Max 10 tags.
function add_tags(e){
    if(e.keyCode === 13) {  // If the key pressed is the Enter key.
        var errMsg = "";
        var new_tag = input_for_tags.value.toLowerCase();

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
    let author_id = user_login;
    if(author_id === ""){
        author_id = "Anonymous";
    }
    let select = writeArticleForm.querySelector("select[name=kind]");
    let files = [];
    file_inputs.forEach(function(file_input){
        if(file_input.files[0] !== undefined){
            files.push(file_input.files[0].name);
        }
    });

    let tags = [];
    //allTags => all elements displaying a tags.
    if(allTags.length > 0){
        allTags.forEach(function(inputForTags){
            let thisTag = inputForTags.innterHTML.substr(1);
            tags.push(thisTag);
        });
    }
    
    let json_files = JSON.stringify(files);
    let json_tags = JSON.stringify(tags);

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
        reply = false;
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

        console.log(obj);
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
        ajax.open("POST","../backend/sendNewArticle_help.php", true);        
        ajax.send(json);

        //Reset all inputs' values to their default values. 
        stickyOrNot.checked = false;
        writeArticleForm.querySelector("input[name=title]").value = "";
        writeArticleForm.querySelector("input[name=author]").value = "";
        writeArticleForm.querySelector("input[name=password]").value = "";
        writeArticleForm.querySelector("textarea").value = "";        
        select.selectedIndex = 0;
        writeArticleForm.querySelector("textarea").value = ""; 
        input_for_tags.value = "";
        added_tags.innerHTML = "";
        added_files.innerHTML = "";
        file_inputs.forEach(function(file_input){
            file_input.value = "";
        });
        
    }else{
        alert("Please fill all necessary filds.");
    }
}         


// 4. Get single article from the database and display on the UI.
const readArticle_table = document.querySelector("#read_article_container table");
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

///////////////////////////////////Read article part////////////////////////////////////////////
var pwOfPrivateArti;
var elemForContent = readArticle_table.querySelector("#readA_content");

function showArticle(inId){
    togglePg(read_article_container, true);
    togglePg(bulletin_board_container, false);

    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200 ){
            // $result = [
            //     "article"=>$article,
            //     "childArticles"=>$childArticles    
            // ]
            let json = ajax.responseText;
            let assoc = JSON.parse(json);
            console.log(assoc);
            let articleObj = assoc["article"];
            let childArticles = assoc["childArticles"];
  
            let privateOrNot = "Public";
            if(articleObj["password"] !== null){
                privateOrNot = "Private";
            }
            pwOfPrivateArti = articleObj["password"];

            let tags = JSON.parse(articleObj["tags"]); 
            let newTxtForTags = "";
            if(tags !== null){
                for(let i = 0; i < tags.length; i++){
                    newTxtForTags += "<span class='readA_tags'>#" + tags[i] + "&nbsp;</span>";
                }
            }
            
            let json_files = JSON.parse(articleObj["files"]); 

            readArticle_table.querySelector("#readA_id").innerHTML = articleObj["id"];
            articleId_forReply = articleObj["id"];
            readArticle_table.querySelector("#readA_kind").innerHTML = articleObj["kind"];
            readArticle_table.querySelector("#readA_title").innerHTML = articleObj["title"];
            readArticle_table.querySelector("#readA_author").innerHTML = articleObj["author_id"];
            readArticle_table.querySelector("#readA_date").innerHTML = articleObj["date"];
            readArticle_table.querySelector("#readA_private").innerHTML = privateOrNot;
            readArticle_table.querySelector("#readA_tags").innerHTML = newTxtForTags;
            // readArticle_table.querySelector("#readA_files").innerHTML = articleObj["files"];
            elemForContent.innerHTML = articleObj["content"];

            if(privateOrNot === "Private"){
                elemForContent.classList.add("hideContent");
                elemForContent.innerHTML += "<div id='enterPW'>" +
                                                "<div id='instruction' style='color:black;'>Please enter the password to read the article.</div>" +
                                                "<input type='password' name='password' width='60px'/>" +
                                                "<button onclick='showPrivateArticle(this)'>Enter</button>" +
                                            "</div>";
            }      

            //For a reply article
            title_forReply = articleObj["title"];
            // let html_forChildA ="<div class='container'><div class='rows'><div class='n_id fn'>ID</div><div class='d_id data'></div><div class='n_date fn'>Date</div><div class='d_date data></div><div class='n_kind fn'>Kind</div><div class='d_kind data'></div>" +
            //                     "</div><div class='n_title fn'>Title</div><div class='d_title data'></div><div class='n_author fn'>Author</div><div class='d_author data'></div>" +
            //                     "</div><div class='rows'><div class='n_pw fn'>Private</div><div class='d_pw data'></div></div><div class='rows d_content data'></div></div>";
            
            read_article_container.innerHTML += "<div id='titleForReplys'>Reply...</div>";

            let rows = createElems("div", ["rows"], null, 3);
            let n_id = createElems("div", ["n_id", "fn"], null);
            n_id.innerHTML = "ID";
            let d_id = createElems("div", ["d_id", "data"], null);
            let n_date = createElems("div", ["n_date", "fn"], null);
            n_date.innerHTML = "Date";
            let d_date = createElems("div", ["d_date", "data"], null);
            let n_kind = createElems("div", ["n_kind", "fn"], null);
            n_kind.innerHTML = "Kind";            
            let d_kind = createElems("div", ["d_kind", "data"], null);
            let n_title = createElems("div", ["n_title", "fn"], null);
            n_title.innerHTML = "Title";            
            let d_title = createElems("div", ["d_title", "data"], null);
            let n_author = createElems("div", ["n_author", "fn"], null);
            n_author.innerHTML = "Author";            
            let d_author = createElems("div", ["d_author", "data"], null);
            let n_pw = createElems("div", ["n_pw", "fn"], null);
            n_pw.innerHTML = "Private";            
            let d_pw = createElems("div", ["d_pw", "data"], null);
            let d_content = createElems("div", ["rows", "d_content", "data"], null);
            let aContainer = createElems("div", ["container"], null);            
            rows[0].appendChild(n_id);
            rows[0].appendChild(d_id);
            rows[0].appendChild(n_date);
            rows[0].appendChild(d_date);
            rows[0].appendChild(n_kind);
            rows[0].appendChild(d_kind);
            rows[1].appendChild(n_title);
            rows[1].appendChild(d_title);
            rows[2].appendChild(n_author);
            rows[2].appendChild(d_author);
            rows[2].appendChild(n_pw);
            rows[2].appendChild(d_pw);


            //Show all child articles of the article...
            for(let i = 0; i < childArticles.length; i++){
                let thisArticle = childArticles[i];
                read_article_container.innerHTML += "<div class='container'><div>";
                let containers = read_article_container.querySelectorAll(".container");
                let thisContainer = containers[containers.length - 1];
                thisContainer.appendChild(rows[0]);
                thisContainer.appendChild(rows[1]);
                thisContainer.appendChild(rows[2]);            
                thisContainer.appendChild(d_content);

                let e_id = thisContainer.querySelector(".d_id");
                let e_date = thisContainer.querySelector(".d_date");
                let e_kind = thisContainer.querySelector(".d_kind");
                let e_title = thisContainer.querySelector(".d_title");
                let e_author = thisContainer.querySelector(".d_author");
                let e_private = thisContainer.querySelector(".d_pw");
                let e_content = thisContainer.querySelector(".d_content");
                let privateOrNot = "Public";

                e_id.innerHTML = thisArticle["id"];
                e_date.innerHTML = thisArticle["date"];
                e_kind.innerHTML = thisArticle["kind"];
                e_title.innerHTML = thisArticle["title"];
                let author_id = thisArticle["author_id"];
                
                if(author_id === null){
                    author_id = "Anonymous";
                }

                e_author.innerHTML = author_id;
                e_content.innerHTML = thisArticle["content"];

                if(thisArticle["password"] !== null){
                    let id = thisArticle["id"];
                    privateOrNot = "Private";
                    e_content.id = "pr_content_" + id; 
                    e_content.classList.add("hideContent");
                    e_content.innerHTML += "<div class='enter_pw'>" +
                                                "<div class='instruction' style='color:black;'>Please enter the password.</div>" + 
                                                "<input type='password' name='password'>" +
                                                "<button id='ca_bt_" + id + "'  onclick='showChild(this)'>Enter<button>"
                                            "</div>";
                }

                e_private.innerHTML = privateOrNot;
                

            }
            
        }
    }
    ajax.open( "POST", "../backend/getArticles_help.php", true);
    ajax.send( '{ "type": "id", "id": "' + inId + '" }');
    
}

function createElems( tagName, class_l=null, id=null, num=1){
    let elems = [];
    for(let i = 0; i< num; i++ ){
        let elem = document.createElement(tagName);
        if(class_l !==null){
            for(let k = 0; k < class_l.length; k++){
                elem.classList.add(class_l[k]);
            }
        }
        if(id !==null){
            elem.id = id;
        }
        elems.push(elem);
    }
    if(num === 1) return elems[0];
    else return elems;
}

function showChild(elem){
    let id = elem.id.slice(6);
    let this_d_content = document.querySelector(".container #pr_content_" + id);
    this_d_content.classList.remove("hideContent");
    elem.parentElement.classList.add("hideField");
}

function showPrivateArticle(elem){
    let pw = read_article_container.querySelector("input[name=password]").value;
    let e_content = read_article_container.querySelector("#readA_content");
    if(pw === pwOfPrivateArti){
        e_content.classList.remove("hideContent");
        e_content.classList.add("showContent");
        elem.parentElement.classList.add("hideField");
    }else{
        alert("Please enter the correct password.");
    }
}

var reply = false;

function sendTitleForReply(){
    //toggle the write article page to 'ON'.
    let titleInput = document.querySelector("#new_article input[name=title]");
    titleInput.value = "Re: " + title_forReply;  
    reply = true; 
    togglePg(read_article_container, false);
    togglePg(write_article_container, true);
    let sticky_f = write_article_container.querySelector("#sticky_field");
    if(user_login !== "admin"){
        sticky_f.classList.add("hideField");
    }else{        
        sticky_f.classList.remove("hideField");
    }
}

</script>
</body>
</html>