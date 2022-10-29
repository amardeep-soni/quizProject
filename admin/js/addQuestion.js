const form = document.getElementById("form"),
    addQues = document.getElementById('addQuesBtn'),
    errorText = document.getElementById("error-txt"),
    successText = document.getElementById("success-txt");

addQues.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/addQuestion.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                var data = xhr.response;
                // console.log(data);
                if (data == 'success') {
                    console.log('success');
                    successText.innerText = 'Question added Successfully😍';
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