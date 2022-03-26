
let firstName = document.getElementById("first_name");
let username = document.getElementById("username");
let email = document.getElementById("email");
let birthday = document.getElementById("birthday");
let phoneNumber = document.getElementById("phonenumber");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirmPassword");

firstName.addEventListener("blur",(e)=>{
 let firstNameData = firstName.value;
 let regex = /[A-Z]\w+/;
 let mssg = firstName.nextElementSibling;

  if(firstNameData == ""){
    mssg.innerHTML = "Firstname Cannot be Empty";
    firstName.classList.add("error");
    mssg.style.display = "block";
  }
  else if(!regex.test(firstNameData)){
    mssg.innerHTML = "First letter Should be Capital";
    firstName.classList.add("error");
    mssg.style.display = "block";
  }
  else{
    firstName.classList.remove("error");
    mssg.style.display = "none";
  }
})

username.addEventListener("blur",()=>{
  let usernameData = username.value;
  let mssg = username.nextElementSibling;
  let regex = /\w{4,}/;
  if(usernameData == ""){
    mssg.innerHTML = "Username cannot be Empty";
    username.classList.add("error");
    mssg.style.display = "block";
  }
  else if(!regex.test(usernameData)){
    mssg.innerHTML = "Username cannot be less than 4";
    username.classList.add("error");
    mssg.style.display = "block";
  }
  else{
    username.classList.remove("error");
    mssg.style.display = "none";
 }

})


email.addEventListener("blur",()=>{  
  let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  let emailData = email.value;
  let mssg = email.nextElementSibling;
  // let atpos = emailData.indexOf("@");
  // let domain = emailData.split("@")[1]; 

  if(emailData == ""){
    mssg.innerHTML= "Email cannot be Empty";
    email.classList.add("error");
    mssg.style.display = "block";
    
  }

  // aiman code for her website 
  // else if(atpos < 1 || domain != "myamu.ac.in"){
  //   mssg.innerHTML = "Please Enter a valid Email address that contains @myamu.ac.in";
  //   email.classList.add("error");
  // //   mssg.style.display = "block";
  // }
  else if(!regex.test(emailData)){
    mssg.innerHTML = "Please Enter a valid Email address";
    email.classList.add("error");
    mssg.style.display = "block";
  }
  else{
    email.classList.remove("error")
    mssg.style.display = "none";
  }
})


birthday.addEventListener("blur",()=>{  
    let regex = /[0-9]{2}\/[0-9]{2}\/[0-9]{4}/;
    let birthdayData = birthday.value;
    let mssg = birthday.nextElementSibling;
  
    if(birthdayData == ""){
      mssg.innerHTML= "Birthday cannot be Empty";
      birthday.classList.add("error");
      mssg.style.display = "block";
      
    }
    else if(!regex.test(birthdayData)){
      mssg.innerHTML = "Please Enter correct format ";
      birthday.classList.add("error");
      mssg.style.display = "block";
    }
    else{
      birthday.classList.remove("error")
      mssg.style.display = "none";
    }
  })
  
phoneNumber.addEventListener("blur",()=>{  
    let regex = /[0-9]{10}/s;
    let phoneNumberData = phoneNumber.value;
    let mssg = phoneNumber.nextElementSibling;
  
    if(phoneNumberData == ""){
      mssg.innerHTML= "Phonenumber field cannot be empty";
      phoneNumber.classList.add("error");
      mssg.style.display = "block";
      
    }
    else if(!regex.test(phoneNumberData)){
      mssg.innerHTML = "Please Enter a valid phonenumber";
      phoneNumber.classList.add("error");
      mssg.style.display = "block";
    }
    else{
      phoneNumber.classList.remove("error")
      mssg.style.display = "none";
    }
  })


password.addEventListener("blur",()=>{
  let PasswordData = password.value;
  let mssg = password.nextElementSibling;
  let regex = /\w{6,}/;

  if(PasswordData == ""){
    mssg.innerHTML = "Password Cannot be empty";
    password.classList.add("error");
    mssg.style.display = "block";
  }
  else if(!regex.test(PasswordData)){
    mssg.innerHTML = "Password too weak";
    password.classList.add("error");
    mssg.style.display = "block";
  }
  else{
    password.classList.remove("error");
    mssg.style.display = "none";

  }

})

confirmPassword.addEventListener("blur",()=>{
  let PasswordData = confirmPassword.value;
  let mssg = confirmPassword.nextElementSibling;

  if(PasswordData != password.value){
    mssg.innerHTML = "Passwords doesn't Match";
    confirmPassword.classList.add("error");
    mssg.style.display = "block";
  }
  else{
    confirmPassword.classList.remove("error");
    mssg.style.display = "none";

  }
})

