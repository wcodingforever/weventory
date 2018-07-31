<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
    <!-- <?php //include 'headerandsidebar.php';?> -->
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

    <!-- Bullutine board -->
    <div>--Bullutine board--</div>
    <div id="bullutine_board_container">
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
            <tbody id="bullutine_board">
            </tbody>
        </table>
        <div id="pageNumbers"></div>
    </div>

    <button id="write_button">Write</button>

    <!-- If a user click on the write button,  the components above(readAcle list) will be replaced with the components below(wirte form).-->

    <div id="write_article_container">
        <form id="new_article">
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
            <input id="write_article_submit_button" type="submit" value="Submit" onclick="sendArticle(event);">
        </form>
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
////////////////////////////////////////Bullutine board/////////////////////////////////////////
window.onload = bringAllreadAcles();

const bullutine_board = document.getElementById("bullutine_board");
const pageNumbers = document.getElementById("pageNumbers");
var readArticlesForEachPg = [];

function bringAllreadAcles(){
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(this.status == 200 && this.readyState == 4){
            let arrForAllreadAcles = JSON.parse(ajax.responseText);
            let numOfPgs;
            if((arrForAllreadAcles.length % 10) === 0){
                numOfPgs = Math.floor(arrForAllreadAcles.length/10);
              }else{
                  numOfPgs = (Math.floor(arrForAllreadAcles.length/10)) + 1;
              }
            for(let i= 0; i < numOfPgs; i++){
                  let thisPgNum = i + 1;
                  document.getElementById("pageNumbers").innerHTML += "<span class='pgNums' id='p_" + thisPgNum + 
                  "' onclick='displayreadAcle(this.id)'>[" + thisPgNum + "]</span>"; 
              }
              for(let i = 0; i < numOfPgs; i++){
                  readArticlesForEachPg.push([]);
              }
            let pgCount = 1;
            for(let i = 0; i < arrForAllreadAcles.length; i++){
                let nthreadA = i + 1;
                let thisreadAcle = arrForAllreadAcles[i];
                readArticlesForEachPg[pgCount-1].push(thisreadAcle);                
                if(Math.floor((nthreadA/10)) > (pgCount - 1)){
                    pgCount ++;
                }
            }
            displayreadAcle("p_1");
        }
    }
    ajax.open( "POST", "../backend/getArticles_help.php", true);
    ajax.send( "all");     
}

//Whenever a user move to a different page of a bullutine board, the page number will be updated
//in pgNum variable. 
var pgNum = 1;

function displayreadAcle(pgNumID){
    // pgNumID => 'p_x';
    pgNum = parseInt(pgNumID.slice(2));

    let readAclesOfThisPg = readArticlesForEachPg[pgNum-1];
    bullutine_board.innerHTML = "";

    for(let i = 0; i < readAclesOfThisPg.length; i++){
        let thisreadAcle = readAclesOfThisPg[i];
        let hasPassword = false;
        let stickyOrNot = false;
        let styleForSticky = "style='background-color:pink;color:blue;'"; 
        if(thisreadAcle["password"] !== null){
            hasPassword = true;
        }
        if(thisreadAcle["sticky"] === "1"){
            stickyOrNot = true;
        }
        let thisID = thisreadAcle["id"];
        let thisKind = thisreadAcle["kind"];                
        let thisTitle = thisreadAcle["title"];
        let thisAuthor = thisreadAcle["author_id"];
        let thisDate = thisreadAcle["date"];
        let onlyDate = thisDate.slice(0,10);
        let onlyTime = thisDate.slice(11, -1);
        let todayOnlyDate;
        let dt = new Date();
        let y = dt.getFullYear().toString();
        let m = (dt.getMonth() + 1).toString();
        if(m.length === 1){
            m = "0" + m;
        }
        let d = dt.getDate().toString();
        if(d.length === 1){
            d = "0" + d;
        }
        todayOnlyDate = y+ "-" + m + "-" + d;
        if(todayOnlyDate === onlyDate){
            thisDate = onlyTime;
        }else{
            thisDate = onlyDate;
        }
        let thisHits = thisreadAcle["hits"];
        
         if(stickyOrNot){bullutine_board.innerHTML += "<tr " + styleForSticky +"></tr>";}
        else{bullutine_board.innerHTML += "<tr></tr>";}
        bullutine_board.lastChild.innerHTML += "<td class='id'>" + thisID + "</td>" +
                                    "<td class='kind'>" + thisKind + "</td>";
        
        if(hasPassword){
            bullutine_board.lastChild.innerHTML += "<td class='title' id='" + thisID + "' onclick='showArticle(this)'>" + thisTitle +
             " <i class='fas fa-lock'></i>" + "</td>";
        }else{
            bullutine_board.lastChild.innerHTML += "<td class='title' id='" + thisID + "' onclick='showArticle(this)'>" + thisTitle + "</td>";
        }
                                
        bullutine_board.lastChild.innerHTML += "<td class='author'>" + thisAuthor + "</td>" +
                                            "<td class='date'>" + thisDate + "</td>" +
                                            "<td class='hits'>" + thisHits + "</td>";
    }
}


///////////////////////////////////////////Wirte part///////////////////////////////////////////
const form = document.getElementsByTagName("form")[0];
form.addEventListener("keypress", function(e){
    if(e.keyCode === 13){
        e.preventDefault();
    }
});
//Get the id of a user by using $_SESSION('user_id')
// const user = "user02";

//For sticky field!! => (default) invisioble!!
// var sticky_field = form.querySelector("#sticky_field");
// if(user === "admin"){
    
//     sticky_field.style.display = "block";
// }

//1) Tags
//Add the tage which a user wrote when thte user enter the tags which he/she wants and hit "endter" key!!
// and   and display all added tags.
var tags = [];
var new_tag = "";
var input_for_tags = document.querySelector("input[name=tags]");
var added_tags = document.getElementById("added_tags");
input_for_tags.addEventListener("keyup",add_tags);


function add_tags(e){
    e.preventDefault();
    if(e.keyCode === 13){
        var new_tag = input_for_tags.value.toLowerCase();
        if(new_tag !== "" && tags.indexOf(new_tag) === -1 && new_tag.length <= 20){

            tags.push(new_tag);

            if(tags.length < 10){
                added_tags.innerHTML += "<span class='tag'>#" + new_tag + "</span> ";
            
            }else{
                alert("You can't add more than 10 tags!");
            }
            var spans_for_tags = form.querySelectorAll(".tag");
            spans_for_tags.forEach(function(span){
                span.addEventListener("click", delete_tag);
            });
        
            input_for_tags.value = "";

        }else if(new_tag.length > 20){
            alert("A tag can't be more than 20 letters.");
        }
    }
}

function delete_tag(e){
    let tag_to_delete = e.target.innerHTML.slice(1);

    let index = tags.indexOf(tag_to_delete);
    tags.splice(index, 1);
    added_tags.innerHTML = "";
    tags.forEach(function(tag){
        added_tags.innerHTML += "<span class='tag'>#" + tag + "</span> ";
    });
    var spans_for_tags = form.querySelectorAll(".tag");
    spans_for_tags.forEach(function(span){
        span.addEventListener("click", delete_tag);
    });
};

//2. Attatched files

// 2-1. Execute an input which is not holding any file input. 
const file_button = form.querySelector("#file_button");
file_button.addEventListener("click", execute_fileinput);
var file_inputs = form.querySelectorAll("input[type=file]");

var file_holders = {
    holder_0: null,
    holder_1: null,
    holder_2: null,
};

function execute_fileinput(){
    for( let i = 0; i < file_inputs.length; i++){
        let this_file_input = file_inputs[i];
        if(this_file_input.files[0] === undefined ){
            this_file_input.click();
            break;
        }
    }

    if(file_holders["holder_0"] !== null && file_holders["holder_1"] !== null && file_holders["holder_2"] !== null){
        alert("You can't add more than 3 files.");
    } 
}

// 2-2. Display a chosen file.
file_inputs.forEach(function(file_input){
    file_input.addEventListener("change", display_file);
})
const added_files = form.querySelector("#added_files");
var count = 0;

function display_file(e){
    let file_name = e.target.files[0].name;
    let file_size = e.target.files[0].size;
    let existOrNot = false;
    for(let holder_name in file_holders){
        let file_name_of_this = file_holders[holder_name];
        if(file_name_of_this === file_name){
            existOrNot = true;
        }
    }
    if(existOrNot === false){

        added_files.innerHTML += "<div class='file_name'>" + file_name + " " + file_size + " bytes " +
        "  <i class='fas fa-times close_icons' id='holder_" + count + "' onclick='remove_file(event)'></i> </div>";
        let holder_name = "holder_" + count.toString();
        file_holders[holder_name] = file_name;

        //Remove a file in the added file list.

        if(count <2){
            count++;
        }else{
            count = 0;
        }
    }else{
        e.target.value = "";
    }
}

function remove_file(e){
    let holder_name = e.target.id;
    let index = parseInt(holder_name.slice(-1));
    // console.log(file_inputs[0].files[0]);
    file_inputs[index].value = "";
    
    file_holders[holder_name] = null;  
    added_files.innerHTML= "";  

    for(let i = 0; i < 3; i ++){
        let this_file_input = file_inputs[i];
        if(this_file_input.files[0] !== undefined ){
            let file_name = this_file_input.files[0].name;
            added_files.innerHTML += "<div class='file_name'>" + file_name + 
            " <i class='fas fa-times close_icons' id='holder_" + i + "' onclick='remove_file(event)'></i> </div>";    
        }
    }
}

//1. Send the readAcle which a user wrote.
// <!-- 
// CREATE TABLE `help_readAcles`(
//     `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     `author_id` VARCHAR(11) NOT NULL,
//     `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `title` VARCHAR(100) NOT NULL,
//     `content` VARCHAR(1500) NOT NULL,
//     `kind` VARCHAR(10) NOT NULL,
//     `sticky` TINYINT(1) NOT NULL,
//     `parent_article_id` INT(11) NULL,
//     `re_step` SMALLINT(2) NULL,  
//     `password` VARCHAR(4) NULL,
//     `hits` INT(11) NOT NULL,
//     `files`
// ); -->

// const write_readAcle_submit_button = document.getElementById("write_readAcle_submit_button");
// write_readAcle_submit_button.addEventListener("click", sendArticle);
const stickyOrNot = form.querySelector("input[name=sticky]");
const stickyBox = stickyOrNot.parentElement;
var toggleForHoverE = true;
stickyBox.addEventListener("mouseenter", function(){
    if(toggleForHoverE) stickyBox.style = "background-color:blue; color: white;";
});
stickyBox.addEventListener("mouseleave", function(){
    if(toggleForHoverE) stickyBox.style = "background-color:yellow; color: black;";
});


stickyOrNot.addEventListener("change", function (){
    if(this.checked === true){
        toggleForHoverE = false;
        stickyBox.querySelector("label").innerText = "Sticky on";
        stickyBox.style = "background-color:blue; color: white;";
    }else{
        toggleForHoverE = true;
        stickyBox.querySelector("label").innerText = "Sticky off";         
        stickyBox.style = "background-color:yellow; color: black;";
    }
});

function sendArticle(e){
    e.preventDefault();
    let select = form.querySelector("select[name=kind]");
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
    let sticky = form.querySelector("input[name=sticky]").checked;
    let title = form.querySelector("input[name=title]").value;
    let password = form.querySelector("input[name=password]").value;
    let kind = select.options[select.selectedIndex].value;
    let content = form.querySelector("textarea").value;

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
        form.querySelector("input[name=title]").value = "";
        form.querySelector("input[name=password]").value = "";
        select.selectedIndex = 0;
        form.querySelector("textarea").value = ""; 
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

const readArticle_table = document.querySelector("#readArticleContainer table");
//For the case where a user want a reply to the article, 
//store the id and title of the article.
var articleId_forReply;  
var title_forReply;

function showArticle(elem){
    articleId_forReply = elem.id;

    let ajax = new XMLHttpRequest();
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
    ajax.send( articleId_forReply);
    
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
