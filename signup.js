const savedEmails = [];
const savedPasswords = [];


function signupSuccess(){
    var email = document.getElementsByName("inputEmail")[0].value;                  //takes values from the html form
    var password = document.getElementsByName("inputPassword")[0].value;
    
    if (email.length > 0) {
        if (password.length > 5){                    // currently trusts the user to input a valid email, probably should be changed
            savedEmails.push(email);
            savedPasswords.push(password);           // to be replaced with appending saved details to the accounts database
            return true;
        }
        else{
            alert("Invalid password, please make sure password is 6+ characters");
            return false;
        }
    }
    else{
        alert("Invalid email");
        return false;
    }

}