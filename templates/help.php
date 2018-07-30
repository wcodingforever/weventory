<?php 
// include '../backend/_navbarSession.php';
?><head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <title>Help</title>
<style>
    .field_name{
        display: inline-block;
    }
    .kind_option{
        display: inline-block;
    }
    .kind_option > label{
        cursor: pointer;
    }
    input[name=kind]{
        display: none;
    }
    .tag{
        background-color: #c3c3c3a1;
        margin: 0 2px;
        color: #2b2a2a;
        font-size: 0.8em;
        cursor: pointer;
    } 
    input[type=file]{
        display: none;
    }
    .close_icons{
        cursor: pointer;
    }
    #write_article_container{
        border:1px solid;
    }
    input[name=password]{
        width: 21px;
    }
    .field{
        
    }
</style>
</head>
<?php include 'headerall.php';?>


    <!-- Logo & App name -->
    <div>--Logo and App name--</div>
    <!-- Top menu -->
    <div>--Top menu--</div>

    <!-- Mainn title -->
    <div id="main_title">Can We Help you?</div>

    <!-- Search box -->
    <!-- A user can search articles by title/content/author/tags -->
    <div id="search_bar">
        <i class="fas fa-search"></i>
        <input id="input_for_search" type="text" placeholder="Search articles..">
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
    <table id="bullutine_board">
        <tr id="column_names">
            <th id="number">No.</th>
            <th id="title">Title</th>
            <th id="author">Author</th>
            <th id="date">Date</th>
            <th id="hits">Hits</th>
        </tr>
    </table>

    <button id="write_button">Write</button>

    <!-- If a user click on the write button,  the components above(article list) will be replaced with the components below(wirte form).-->

    <div id="write_article_container">
        <form id="new_article">
            <!-- ***Sticky field!! -->
            <!-- (Default) invisioble!! -->
            <!-- If authour is admin, sticky field'll be visible!! -->
            <div class="field" id="sticky_field">              
                    <label class="field_name" for="sticky">Sticky</label> <input id="sticky" type="checkbox" value="sticky" name="sticky">
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
                <div class="field_name">Tags</div>
                <input type="text" name="tags"> MAX. 10 tags
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
            <input id="write_article_submit_button" type="submit" value="Submit" onClick="sendArticle(event);">
        </form>
    </div>





<script>
////////////////////////////////////////Bullutine board/////////////////////////////////////////
window.onload = display_bullutine_board();


const bullutine_board = document.getElementById("bullutine_board");

function display_bullutine_board(){
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(this.status == 200 && this.readyState == 4){
            console.log("works");
            // console.log
        }
    }
    ajax.open( "POST", "../backend/getArticles_help.php",true);
    ajax.send( "all"); 
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
        var new_tag = input_for_tags.value;
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
    let existOrNot = false;
    for(let holder_name in file_holders){
        let file_name_of_this = file_holders[holder_name];
        if(file_name_of_this === file_name){
            existOrNot = true;
        }
    }
    if(existOrNot === false){

        added_files.innerHTML += "<div class='file_name'>" + file_name + 
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
        if(this_file_input.files[0] !== undefined){
            let file_name = this_file_input.files[0].name;
            added_files.innerHTML += "<div class='file_name'>" + file_name + 
            "  <i class='fas fa-times close_icons' id='holder_" + i + "' onclick='remove_file(event)'></i> </div>";    
        }
    }
}

//1. Send the article which a user wrote.
// <!-- 
// CREATE TABLE `help_articles`(
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

// const write_article_submit_button = document.getElementById("write_article_submit_button");
// write_article_submit_button.addEventListener("click", sendArticle);
var stickyOrNot = form.querySelector("input[name=sticky]");


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
    let author_id = "user2";
    let sticky = form.querySelector("input[name=sticky]").checked;
    let title = form.querySelector("input[name=title]").value;
    let password = form.querySelector("input[name=password").value;
    let kind = select.options[select.selectedIndex].value;
    let content = form.querySelector("textarea").value;


    // If a user didn't fill any necessary filds, don't allow to write an article!
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
        };

        let json = JSON.stringify(obj);

        const ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){

            if(this.status == 200 && this.readyState == 4){
                // console.log(json);
                let result = ajax.responseText;
                if(result !== "OK"){
                    console.log(result);
                }
            }

        }
        ajax.open("POST","../backend/sendNewArticle_help.php", true);        
        ajax.send(json);
    }else{
        alert("Please fill all necessary filds.");
    }
}




</script>
</body>
</html>
