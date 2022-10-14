const form = document.querySelector("form.signupForm"),
    signupBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-txt"),
    successText = form.querySelector(".success-txt");

form.onsubmit = (e) => {
    e.preventDefault();
}
signupBtn.onclick = () => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if(data == "success"){
                    successText.textContent = 'Account created Sccessfully';
                    successText.style.display = 'block';
                    errorText.style.display = 'none';                     
                }else{
                    errorText.textContent = data;
                    errorText.style.display = 'block'
                    successText.style.display = 'none';                     
                }
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}