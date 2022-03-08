let submitBtn = document.getElementById("submit_btn");
let commentForm = document.getElementById("comment.form");
submitBtn.addEventListener("click", onSubmitFrom);

let nameInput = document.getElementById("name");
let categoryInput = document.getElementById("category");
let experienceInput = document.getElementById("experience");

let nameError = document.getElementById("name_error");
let categoryError = document.getElementById("category_error");
let experienceError = document.getElementById("experience_error");

let errorExists = false;

function showError(errorField, errormessage) {
    errorExists = true;
    errorField.innerHTML = errormessage;
    errorField.style.color = "red";
}
function resetvalues(){
    nameError.innerHTML = "";
    nameError.style.color = "";
    categoryError.innerHTML = "";
    categoryError.style.color = "";
    errorExists = false;
}
function onSubmitFrom(event) { 
    event.preventDefault();
    
   resetvalues(); 
 
    if (nameInput == "") {
       showError(nameError, "Name is requried");
        
    }

    else if(/^[a-zA-Z-' ]*$/.test(nameInput.value)){
        showError(nameError, "Name can only contain letters and spaces")
    }

    if (categoryInput == "blank") {
        showError(categoryError, "Category is required");


  
    }

    console.log(experienceInput);

    let found= false;
    for(let i = 0; i !=experienceInput.length; i++);{
        console.log(experienceInput[i].checked);
        if(!experienceInput[1].checked){  showError(experienceError, "Experience is requried");
        found = true;
        break;
       }
      
    } 

   if(!found){ showError(experienceError, "Experience is required" )
    }
      
   
      
    if(!errorExists) {
        commentForm.submit();
    }
        


}

   
