const addQuestionForm = document.getElementById("addQuestionForm"),
  addQues = document.getElementById("addQuesBtn"),
  errorText = document.getElementById("error-txt"),
  successText = document.getElementById("success-txt");

addQues.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/addOrEditQuestion.php", true);
  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        var data = xhr.response;
        // console.log(data);
        if (data == "Added" || data == "Edited") {
          console.log("success");
          successText.innerText = `Question ${data} Successfully😍`;
          successText.style.display = "block";
          errorText.style.display = "none";
          setTimeout(() => {
            successText.style.display = "none";
            errorText.style.display = "none";
            location.reload();
          }, 1000);
        } else {
          // console.log(data);
          errorText.innerText = data + "😒";
          successText.style.display = "none";
          errorText.style.display = "block";
          setTimeout(() => {
            successText.style.display = "none";
            errorText.style.display = "none";
          }, 1000);
        }
      }
    }
  };
  let formData = new FormData(addQuestionForm);
  xhr.send(formData);
};

$(document).on("click", "#addIcon", function () {
  $("#addQuestion .modal-body #idInput").val("");
  $("#addQuestion .modal-body #nameInput").val("");
  $("#addQuestion .modal-body #descInput").val("");
  $("#addQuestion .modal-body #iconInput").val("");
});
$(document).on("click", ".editIcon", function () {
  var id = $(this).data("id");
  var code = $(this).data("code");
  var question = $(this).data("question");
  var option1 = $(this).data("option1");
  var option2 = $(this).data("option2");
  var option3 = $(this).data("option3");
  var option4 = $(this).data("option4");
  var correct = $(this).data("correct");
  $("#addQuestion .modal-body #idInput").val(id);
  $("#addQuestion .modal-body #inputQuizCode").val(code);
  $("#addQuestion .modal-body #inputQuestion").val(question);
  $("#addQuestion .modal-body #inputOption1").val(option1);
  $("#addQuestion .modal-body #inputOption2").val(option2);
  $("#addQuestion .modal-body #inputOption3").val(option3);
  $("#addQuestion .modal-body #inputOption4").val(option4);
  $("#addQuestion .modal-body #inputCorrect").val(correct);
});
$(document).on("click", ".deleteIcon", function () {
  var id = $(this).data("id");
  var code = $(this).data("code");
  $("#deleteQuestion .modal-body #id").val(id);
  $("#deleteQuestion .modal-body #code").val(code);
});
