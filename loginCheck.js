// var savedEmail = []
// var savedPassword = []

// fetch("savedEmails.txt")
// .then((res) => res.text())
// .then((text) => {
//   savedEmail.push(text)
//  })

//  .catch((e) => console.error(e));                         // to be replaced with imported database of passwords and emails to compare
// fetch("savedPasswords.txt")                               // current test password is "hello"
// .then((res) => res.text())
// .then((text) => {
//   savedPassword.push(text)
//  })
// .catch((e) => console.error(e));



const savedPassword = [6629065793880233];
const savedEmail = ["test@test.com"];

function checkLogin(){
var email = document.getElementsByName("inputEmail")[0].value;                  //takes values from the html form
var password = document.getElementsByName("inputPassword")[0].value;

if (savedEmail.includes(email)){
    if (savedPassword.includes(cyrb53a(password))){  //needs to be changed to if password is equal to the password tied to the email from db
        alert("Login Successful");
        window.location.replace("https://google.com")  //temporary redirect to google as a placeholder until I know the path for mainpage
        return true;                                  //also needs to send the account details to the main page 

    }
    else{
        alert("Password Incorrect, Please Try Again");
        return false;
    }
}
else{
    alert("Email Incorrect, Please Try Again");
    return false;
}

}