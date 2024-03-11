const form = document.getElementById("form"),
    addChap = document.getElementById('addChapBtn'),
    errorText = document.getElementById("error-txt"),
    successText = document.getElementById("success-txt");
addChap.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/addQuizCode.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                var data = xhr.response;
                if (data == 'success') {
                    // console.log('success');
                    successText.innerText = 'Quiz added Successfully😍';
                    successText.style.display = 'block';
                    errorText.style.display = 'none';
                    setTimeout(() => {
                        successText.style.display = 'none';
                        errorText.style.display = 'none';
                        location.reload();
                    }, 1000);
                } else {
                    // console.log(data);
                    errorText.innerText = data + '😒';
                    successText.style.display = 'none';
                    errorText.style.display = 'block';
                    setTimeout(() => {
                        successText.style.display = 'none';
                        errorText.style.display = 'none';
                    }, 1000);
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}