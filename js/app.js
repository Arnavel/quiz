function postAJAX(body, handler, callback) {
   var xhr = new XMLHttpRequest();

   xhr.open("POST", handler, true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

   xhr.onreadystatechange = callback.bind(xhr);

   xhr.send(body);

   return xhr;
}

function checkAnswer(id) {

   var body = 'method=' + encodeURIComponent('checkAnswer') +
              '&id='    + encodeURIComponent(id);

   postAJAX(body, '/questionsController.php', function() {
      if (this.readyState !== 4) {
         return;
      }

      var response = this.responseText;
      switch (response) {
         case '1':
            nextQuestion(
               updatePointsView
            );
            break;
         case '2':
            endGame()
            break;
         case '3':
            // ОШИБКА: Не был отправлен Id ответа
            break;
         default :
            // ОШИБКА: Идентификатор ответа, отправленный сервером, неизвестен
            break;
      }

   });

}

function nextQuestion(callback) {

   var body = 'method=' + encodeURIComponent('getQuestion');

   postAJAX(body, '/questionsController.php', function() {
      if (this.readyState !== 4) {
         return;
      }

      var response = this.responseText;
      if (response == '4') {
         endGame();
         return;
      }

      var contentElement = document.querySelector('.content');
      contentElement.innerHTML = this.responseText;

      addOnClickListener();

      if (arguments.length > 0) {
         callback();
      }

   });
}

function endGame() {

   var body = 'method=' + encodeURIComponent('endGame');

   postAJAX(body, '/questionsController.php', function() {
      if (this.readyState !== 4) {
         return;
      }

      var contentElement = document.querySelector('.content');
      contentElement.innerHTML = this.responseText;

   });

}

function updatePointsView() {

   var body = 'method=' + encodeURIComponent('getPoints');

   postAJAX(body, '/questionsController.php', function() {
      if (this.readyState !== 4) {
         return;
      }

      var pointsElement = document.querySelector('.points__value');
      pointsElement.innerHTML = this.responseText;

   });

}

/**
 * Подключение обработчика на клик по кнопке "Ответить"
 */
function addOnClickListener() {

   var element = document.querySelector('.question__submit-btn');
   if (element !== null) {
      element.addEventListener('click', function(event) {

         event.preventDefault();

         var id = null;
         var radioElements = document.querySelectorAll('.question__answer');
         for (var i = 0; i < radioElements.length; i++) {
            if (radioElements[i].checked) {
               id = radioElements[i].id;
            }
         }

         if (id !== null) {
            checkAnswer(id);
         }

      });
   }
}

window.onload = function() {
   nextQuestion(
      updatePointsView
   );
}