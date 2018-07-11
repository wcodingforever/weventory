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
        expect: (clicked)BUTTON with name("login" or "signup")
            login::clicked:
                key_value_pairs:
                    -user_name: value
                    -user_pswed: hashed password
            signup::clocked:
                key_value_pairs:
                    -user_name
                    ???