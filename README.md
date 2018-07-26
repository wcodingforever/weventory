# WEventory!\
    Test before you put anything into the finished column\
    `static` for const elements like css\
    `templates` for html files
    
# TODO
    -JSON formated requests!
    -Before you send password anywhere hash it in JS
    -Hashing password is:
            String.prototype.hashCode = function() {
                var hash = 0;
                if (this.length == 0) {
                    return hash;
                }
                for (var i = 0; i < this.length; i++) {
                    var char = this.charCodeAt(i);
                    hash = ((hash<<5)-hash)+char; // bitwise operation left shift
                    hash = hash & hash; // Convert to 32bit integer
                }
                return hash;
            };
    -To hash it use `your password`.hashCode() and send it `POST`


# Limits
    account bio: 400
    group desc: 400
    tags: 30 max
        total length: 400
    message: content 100
    



# API:
    sign_log.php #for log in and sign up
        expect: AJAX request `POST` method 
            login, pswd (sign in)
                key_value_pairs:
                    -user_login: value #email and login check for API
                    -user_pswrd: hashed password
            login, pswd, bday(registration)
            email confirmation(email,verification code)
                send email
                    receive validity of email
                        key:
                            -email_varif  //"sent" or "not sent"
                send verification code
                    receive validity of code
                        key:
                            -codeVerif //"true" or "false"
                key_value_pairs:
                    -user_login
                    -user_pswrd
                    -user_email
                    -user_firstName
                    -iser_lastName
                    -user_bday
                    -user_bio
                    -user_pic
                    -user_inetersts?
        returns(JSON formatted):
            (sign in):
                log_in: Success/Fail
            (sign up):
                sign_up: Success/Fail



    for event 
    new_event.php
    key_value_pairs:
                event_name
                event_date_from
                event_date_to
                event_description
                event_location
                event_category
                event_price
                event_pic
                event_capacity

        edit event: 
            expects to get obj
            thisEvent 
                thisEvent.thisEventName;
                thisEvent.thisEventDateFrom;
                thisEvent.thisEventDateTo;
                thisEvent.thisEventDescription;
                thisEvent.thisEventLocation;
                thisEvent.thisEventCategory;
                thisEvent.thisEventPrice;
                thisEvent.thisEventCapacity;



            for groups 
            new_group.php
                    group_name
                    group_description
                    group_category
                    group_host_id
                    gruop_pic




        for report 
        report.php
            report_name
            report_category
            report_description
            account_id
            group_id
            event_id
            author.id

            edit groups 
            expects obj 
                thisGroup
                    thisGroup.thisName;
                    thisGroup.thisDescription;
                    thisGroup.thisCategory;
                    thisGroup.thisPic;


            edit profile 
            expects obj 
                thisProfile
                    thisProfile.thisFirstName;
                    thisProfile.thisLastName;
                    thisProfile.thisEmail;
                    thisProfile.thisBio;
                    thisProfile.thisPic;



        homepage 
        expects obj 
            date
            title
            description
            location 
            members  (this is the number of memebers) 
            likes     (number of likes)
            price
            id

            hostPicture
            hostName
            hostDescription

            key values for POST 
            all_events

        messages
        messages.php
        expects obj
            chatHistory
                numbers
                pic
                f_name
                l_name
            UserExist
                senderId
                receiverId
            ChatLog
                dir
                message
        sends
            chatChat
            sendSearchInput
            sentMessage
            goodBye
