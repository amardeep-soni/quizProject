const form = document.querySelector("form.loginForm"),
    loginBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-txt"),
    successText = form.querySelector(".success-txt");

form.onsubmit = (e) => {
    e.preventDefault();
}
loginBtn.onclick = () => {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == "success") {
                    successText.textContent = 'You are Logged in';
                    successText.style.display = 'block';
                    errorText.style.display = 'none';
                    setTimeout(() => {
                        location.href = "selectQuiz.php";
                    }, 1500);
                } else {
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