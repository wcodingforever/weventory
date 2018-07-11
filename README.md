WEventory!\
    Test before you put anything into the finished column
    
# TODO
    -JSON formated requests!
    -Before you send password anywhere hash it in JS
    -Hashing password is:
            `code`String.prototype.hashCode = function() {
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
            };`code`





# API:
    sign_log.php #for log in and sign up
        expect: AJAX request `POST` method 
            login, pswd
                key_value_pairs:
                    -user_login: value
                    -user_pswrd: hashed password
            login, pswd, bday, 
                key_value_pairs:
                    -user_login
                    -user_pswd
                    -user_email
                    -user_firstName
                    -iser_lastName
                    -user_bday
                    -user_bio
                    -user_pic
                    -user_inetersts?