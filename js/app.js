function postAJAX(body, handler, callback) {
   var xhr = new XMLHttpRequest();

   xhr.open("POST", handler, true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

   xhr.onreadystatechange = callback.bind(xhr);

   xhr.send(body);
}

function checkAnswer(id) {

   var body = 'id=' + encodeURIComponent(id);
   postAJAX(body, '/check.php', function() {
      if (this.readyState !== 4) {
         return;
      }

      var response = this.responseText;
      switch (response) {
         case '1':
            alert('Правильный ответ');
            nextQuestion();
            break;
         case '2':
            alert('Неправильный ответ');
            break;
         case '3':
            alert('Ошибка');
            break;
         default :
            alert('Неправильный формат данных');
            break;
      }

   });

}

function nextQuestion() {

   var body = 'method=' + encodeURIComponent('getQuestion');
   postAJAX(body, '/questions.php', function() {
      if (this.readyState !== 4) {
         return;
      }

      var questionContent = document.querySelector('.question');
      questionContent.innerHTML = this.responseText;

      addOnClickListener();

   });
}

function addOnClickListener() {
   // Подключение обработчика на клик по кнопке "Ответить"
   var element = document.querySelector('.question__submit-btn');
   if (element !== null) {
      element.addEventListener('click', function(event) {

         event.preventDefault();

         var id = event.id;
         checkAnswer(id);

      });
   }
}

window.onload = function() {
   nextQuestion();
}