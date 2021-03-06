<?php 
    require 'headerall.php';
    checkSession(TRUE);
?>
    <style>
        textarea{
            resize:none;
        }
        /* The Modal (background) */
        .modal {
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            min-height:100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }
        
        /* Modal Content */
        .Modal-content {
            background-color: #EAF1E4;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            height: 445px;
            display: flex;
            box-shadow: 10px 10px 5px  #4d4d4d;
            border: 1px solid grey;

        }

        input, #searchbutton, #createnewmessage {
            display: block;
            width: 130px;
            height: 40px;
            margin: 45px 0px 18px 44px;
        }

        #createmodal {
            display: block;
            width: 170px;
            height: 40px;
            margin: 45px 0px 24px 55px;
            
        }


        #searchbutton, #createnewmessage, #createmodal{
            border: 1px solid lightgrey;
            background-color: #E2C044;
            transition: 0.6s ease;
        }

        #searchbutton:hover, #createnewmessage:hover, #createmodal:hover{
            background-color: #b22222;
        } 
            
            /* The Close Button */
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            
            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
            .dismiss{
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            .dismiss:hover,
            .dismiss:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
            .messagesR{
                float: right;
                background-color:lightskyblue;
                color:black;
                font-size: 10px;
            }
            .messagesL{
                float: left;
                background-color: gold;
                color:black;
                font-size: 10px;
            }
            .messageclass{
                background-color: lavenderblush;

            }
            .inputbox{
                float: right;
                position: relative;
                margin-top: 350px;
            }
            .button{
                float:right;
                position: relative;
                bottom:0;
            }

            </style>
    <title>Messages</title>
</head>
    <?php require 'navbar.php';?>
    
    <div>
        <div id="frontpage">
            <div id="pic" class="picture"></div>
            <div id='theirname'> </div>
        </div>
        <div id='mymodal' class='modal'>
            <div class="Modal-content">
                <span class="close">&times;</span>
                <textarea class="inputbox" id="inputbox" maxlength="250" style="width:400px ;min-height: 100px; "></textarea>
                <p id="availablecharacters" style='font-size: 10px; position:relative; left: 54%; top:450px;'>characters used:0/250</p>

                <div id='messagecontianer' class='messageclass'>   
                </div>

                <button class="button" id="sendbutton" style="margin-top:450px; left:52%;" > Send </button>
                <button class="button" id="leavebutton" style="float: left; position:relative; top:0" > Leave Chatroom</button>

                <div id="timestamp"></div>
            </div>    
        </div>
        <button id="createmodal">Create new message</button>

        <div id='newmodal' class='modal'>
            <div class="Modal-content">
                <span class="dismiss">&times;</span>
                <input id='searchbox' type="search">
                <button id="searchbutton" type="submit">Look for user </button>
                <button id="createnewmessage">Send Message</button>
            </div>
        </div>

        <div id="userpic"></div>
        <div id="chatid"></div>
        <div id="userid"></div>
        <div id="senderid"></div>
        <div id="receiverid"></div>

        

    </div>

    <script>
        var Modal=document.getElementById("mymodal");
        var InputBox=document.getElementById("inputbox");
        var sentDate=document.getElementById("timestamp");
        
        var FrontPage=document.getElementById('frontpage');
        var theirName=document.getElementById('theirname');

        var MessageRoomId=document.getElementById("chatid");
        const UserId=document.getElementById("userid");
        var SenderId=document.getElementById('senderid');
        var ReceiverId=document.getElementById('receiverid');
        var showChar=document.getElementById("availablecharacters");
        var ProfilePic=document.getElementById("userpic");
        var Picture=document.getElementById("pic");

        var span = document.getElementsByClassName("close")[0];
        var dismiss=document.getElementsByClassName("dismiss")[0];

        var NewModal=document.getElementById("newmodal");
        var SearchBox=document.getElementById("searchbox");

        var WholeMessageBox=document.getElementById("messagecontainer");
        var myMessageBox=document.getElementById("mymessage");
        var otherMessageBox=document.getElementById("theirmessage");


        var SendButton=document.getElementById("sendbutton");
        var LeaveButton=document.getElementById("leavebutton");
        var NewMessage=document.getElementById("createmodal");
        var SearchButton=document.getElementById("searchbutton");
        var CreateNewMessage=document.getElementById("createnewmessage");
        


        window.addEventListener("load", function(){
            Modal.style.display='none';
            SendButton.disabled=true;
            NewModal.style.display='none';
            var xhttp=new XMLHttpRequest();
            xhttp.onreadystatechange=function(){
                if(this.readyState===4&&this.status===200){
                    var chatHistory=JSON.parse(this.responseText);
                    var numberOfChats=chatHistory.numbers;
                        for(i=0; i<numberOfChats; i++){
                            FrontPage.innerHTML="<div class='oneRoom"+chatHistory[i].id+"'><img id='pic' src='"+chatHistory[i].pic+"'>";
                            FrontPage.innerHTML="<div id='theirname>"+chatHistory[i].f_name+" "+chatHistory[i].l_name+"</div></div>"
                            document.querySelectorAll(".oneRoom")[i].addEventListener("click",function(){
                                messageModalstatus=true;
                                Modal.style.display='block';
                                var xhttp=new XMLHttpRequest();
                                xhttp.onreadystatechange=function(){
                                    if (this.readyState===4 && this.status===200 ){
                                        var ChatLog=JSON.parse(this.responseText);
                                        for (let i = 0; i < array.length; i++) {
                                            WholeMessageBox.innerHTML="<div class=messages"+ChatLog.dir+">"+ChatLog.message +" </div>"
                                        }
                                    }                
                                }
                                xhttp.open("POST", "messages.php");
                            })
                        }
                }
            }
            xhttp.open("POST","messages.php", true);
            var chatchat={
                lastMsg:""
            }
            var chatChat=JSON.stringify(chatchat);
            xhttp.send(chatChat);
        })

        NewMessage.addEventListener("click",function(){
            NewModal.style.display='block';
            var newMessageStatus=true;
            SearchButton.addEventListener("click",function(){
                var xhttp=new XMLHttpRequest();
                if(this.readyState===4&&this.status===200){
                    
                }
                
                xhttp.open("POST","message.php",true);
                var searchInput={
                    search_id:SearchBox.innerHTML
                }
                var sendSearchInput=JSON.stringify(searchInput);
                xhttp.send(sendSearchInput);
            })
            CreateNewMessage.addEventListener("click",function(){
                NewModal.style.display='none';
                var xhttp=new XMLHttpRequest();
                if(this.readyState===4&&this.status===200){
                    var UserExist=JSON.parse(this.responseText);
                    SenderId=UserExist.senderId;
                    ReceiverId=userexist.receiverId;
                }
                xhttp.open("POST","message.php",true);
                var newChatRoom={
                    sender_id:SenderId,
                    receiver_id:ReceiverId
                }                
                var sendNewChatRoom=JSON.stringify(newChatRoom);
                xhttp.send(sendNewChatRoom);
            })
        })

        InputBox.addEventListener("input",function(){
            showChar.innerHTML= "characters used:"+InputBox.value.length+"/250";
        })
       
        SendButton.addEventListener("click", function(){
            if (!InputBox.value===""||!InputBox.innerHTML===""){
                SendButton.disabled=false;
            }     
            var xhttp=new XMLHttpRequest();
            xhttp.onreadystatechange=function(){
                if(this.readyState===4&&this.status===200){
                    console.log("Load success");
                }
            }
            xhttp.open("POST","messages.php", true) //php=messages.php
            var message={
                message_text:InputBox.value,
                chat_room:MessageRoomId,
                user_id:UserId
            }
            var sentMessage=JSON.stringify(message);
            xhttp.send(sentMessage);
            console.log(InputBox.value);
            InputBox.value="";
        })

        span.addEventListener("click",function(){  
            Modal.style.display='none';
        })
        dismiss.addEventListener("click",function(){
            NewModal.style.display='none';
        })
        

        // OpenModal.addEventListener("click",function(){
        //     messageModalstatus=true;
        //     Modal.style.display='block';
        //     Modal.innerHTML=""
        //     var xhttp=new XMLHttpRequest();
        //     xhttp.onreadystatechange=function(){
        //         if (this.readyState===4 && this.status===200 ){
        //             var ChatLog=JSON.parse(this.responseText);
        //             UserId=ChatLog.user_id;
        //             SenderId=ChatLog.sender_id;
        //             ReceiverId=ChatLog.receiver_id;
        //             Picture=ChatLog.receiver_pic;
        //         }                
        //     }
        //     xhttp.open("POST", "messages.php");
        // })
        
        LeaveButton.addEventListener("click",function(){
            if(confirm("Are you sure? Your chat history will be deleted.")){
                var xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange=function(){
                    if (this.readyState===4 && this.status===200 ){
                        var deleteChat=true;
                    }
                }
                xhttp.open("POST", "messages.php");
                var leaveChat={
                    deleteHist:deleteChat
                }
                var goodBye=JSON.stringify(leaveChat);
                xhttp.send(goodBye);
                window.location.reload(true);
            }
            
        })


    </script>
</body>
</html>