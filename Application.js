$(document).ready(function() {

    	var formData = new FormData();
    	var AjaxController = 'AjaxController.php';

    	let url = document.location.href;
    	formData.append('url', url);

/*************************** Рейтинг ***************************/

	let targets = document.querySelectorAll('.vote');      // Получение колллекции рейтингов

	// Получение рейтинга постов 

	function showRating(targets) {

		for(let target of targets) {

			let nodes = target.childNodes;

			for(let node of nodes) if(node.value != 0) node.nodeValue = '';      // Удаление узлов между li

			checkEvents(target);                                                 // Обработка действий пользователя

			// Получение данных о посте из адреса изображения

			let address = target.parentNode.parentNode.parentNode.querySelector('.image').children[0].getAttribute('src');

			formData.append('URI', address);
			formData.append('buttonStatus', 'showRating');

			$.ajax({

				type: 'POST',
				url: AjaxController,
				processData: false,
				contentType: false,
				cache: false,
				dataType: 'text',
				data: formData,

				success: function(data) {

				    formData.delete('URI');
				    formData.delete('buttonStatus');

				    showRatingMethod(target, data);
				}
			});
		}
	}

	showRating(targets);

     // Отображение рейтинга

	function showRatingMethod(target, rating) {

		let block = target.parentNode.parentNode;

		let Rating = rating.split('+')[0];
		let Status = rating.split('+')[1];

		// Получение ширины дефолтного блока

		let width = block.children[0].offsetWidth;
		let starSize = width / 5;

		// Установка элементу ширины

		let Values = Rating.split('-');
		let size = (Values[0] / Values[1])*starSize;

		let Vote = block.children[1];
		Vote.setAttribute('class', 'ratingResult');
		Vote.style.width = size + 'px';

		// Проголосовавшие

		let Voters = block.children[3];

		if(Voters.querySelector('.showVoters')) Voters.querySelector('.showVoters').remove();

		let Div = document.createElement("div");
		Voters.appendChild(Div);

		Div.classList.add('showVoters');

		let DivP = document.createElement("p");
		DivP.insertAdjacentText('afterbegin', 'Проголосовавших: ' + Values[1]);
		Div.appendChild(DivP);

		if(Voters.querySelector('.showVote')) Voters.querySelector('.showVote').remove();

		if(Status.length == 1) {

		    let DivVoted = document.createElement("div");
		    Voters.appendChild(DivVoted);

		    DivVoted.classList.add('showVote');

		    let DivVotedP = document.createElement("p");
		    DivVotedP.insertAdjacentText('afterbegin', 'Ваша оценка: ' + Status);
		    DivVoted.appendChild(DivVotedP);
		}
	}

	// Контроль событий рейтинга

	function checkEvents(target) {
		
		// Изменение цвета при наведении

		target.onmouseover = function(event) {

			// Получение следующей звезды

			let vote = event.target;
			let next = vote.nextElementSibling;
			let voteClass;

			if(vote.getAttribute('class') != 'vote') {

				if(next) voteClass = next.getAttribute('class');			 // Получение класса звезды
				else voteClass = 'end';							 // Если это не пятая звезда

				// Вычисление конкретной звезды

				for(let i = 0; i < vote.parentElement.children.length; i++) {

					// Добавление класса choise с цветом выделения

					if(vote.parentElement.children[i].getAttribute('class') != voteClass) {
						vote.parentElement.children[i].classList.add('choise');
					} else {
						break;
					}
				}

				// Удаление свойств при смене фокуса мышки

				target.onmouseout = function(event) {

					for(let i = 0; i < vote.parentElement.children.length; i++) {
						vote.parentElement.children[i].classList.remove('choise');
					}			
				}
			}
		}

		target.onclick = function(event) {
            		if(event.target.className != 'vote') addVote(target, event.target);      // Добавление рейтинга
		}
	}

    // Проверка статуса голосующего

    function addVote(target, vote) {

        let address = vote.parentNode.parentNode.parentNode.parentNode.querySelector('.image').children[0].getAttribute('src');

        formData.append('URI', address);

        for(let i = 0; i < vote.parentElement.children.length; i++) {

            if(vote.parentElement.children[i] == vote) {
                let number = i + 1;
                formData.append('vote', number);
            }
        }

        formData.append('buttonStatus', 'checkVoter');		// Запуск метода проверки авторизованного пользователя
        formData.append('method', 'changeRating');		// Имя метода в случае успеха проверки безопасности

        $.ajax({

            type: 'POST',
            url: AjaxController,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'text',
            data: formData,

            success: function(data){

                formData.delete('URI');
                formData.delete('vote');
                formData.delete('buttonStatus');
                
                if(data == 'unregistered') showDescriptionMessage(target);
                else showRatingMethod(target, data);
            }
        });
    }

    // Сообщение об отказе в повторном голосовании

    function showDescriptionMessage(target) {

	if(target.parentNode.parentNode.querySelector('.showMessage')) return;
        
        let voters = target.parentNode.parentNode.querySelector('.voters');
        
        let Div = document.createElement("div");
        voters.appendChild(Div)
        
        Div.classList.add('showMessage');

        let DivP = document.createElement("p");
	DivP.insertAdjacentText('beforeend', 'Только для зарегистрированных пользователей!');
	Div.appendChild(DivP);
        
        let DivA = document.createElement("a");
        DivA.insertAdjacentText('beforeend', 'Зарегистрироваться');  
        Div.appendChild(DivA);
        
        let DivAhref = document.createAttribute("href");
	DivAhref.value = "/registration";
	DivA.setAttributeNode(DivAhref);
    }
})
