$(document).ready(function() {

	var formData = new FormData();
    var AjaxController = 'Application.php';

	let url = document.location.href;
	formData.append('URI', url);

	let targets = document.querySelectorAll('.vote');      // Загрузка данных рейтинга

	// Получение рейтинга постов 

	function showRating(targets) {

		for(let target of targets) {

			// Удаление узлов между li

			let nodes = target.childNodes;

			for(let node of nodes) if(node.value != 0) node.nodeValue = '';

			// Контроль событий 

			checkEvents(target);

			// Получение данных о посте из адреса изображения

			let address = target.parentNode.parentNode.parentNode.querySelector('.image').children[0].getAttribute('src');

			formData.append('URI', address);
			formData.append('buttonStatus', 'getRating');

			$.ajax({

                type: 'POST',
                url: AjaxController,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'text',
                data: formData,

                success: function(data){

                    formData.delete('address');
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

		// Получение ширины дефолтного блока

		let width = block.children[0].offsetWidth;
		let starSize = width / 5;

		// Установка элементу ширины
        
        let splitRating = rating.split('+');
        let status;

        if(splitRating[1] != 'clear') status = 'voted';

		let vote = block.children[1];

        vote.setAttribute('class', 'ratingResult');

		let split = splitRating[0].split('-');

		let size = (split[0] / split[1])*starSize;

		vote.style.width = size + 'px';
        
        if(isNaN(size)) vote.removeAttribute('style');

		// Проголосовавшие

		let voters = block.children[3];

		if(voters.querySelector('.showVoters')) voters.querySelector('.showVoters').remove();
        
        let Div = document.createElement("div");
        voters.appendChild(Div);
        
        Div.classList.add('showVoters');

		let DivP = document.createElement("p");
		DivP.insertAdjacentText('afterbegin', 'Проголосовавших: ' + split[1]);
		Div.appendChild(DivP);
        
        if(voters.querySelector('.showVote')) voters.querySelector('.showVote').remove();
        
        if(status == 'voted') {

            let DivVoted = document.createElement("div");
            voters.appendChild(DivVoted);

            DivVoted.classList.add('showVote');

            let DivVotedP = document.createElement("p");
            DivVotedP.insertAdjacentText('afterbegin', 'Ваша оценка: ' + splitRating[1]);
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

				if(next) voteClass = next.getAttribute('class');		 // Получение класса звезды
				else voteClass = 'end';								     // Если это не пятая звезда

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

		// Добавление рейтинга

		target.onclick = function(event) {

			let vote = event.target;
            
            if(vote.className != 'vote') checkVoter(target, vote);
		}
	}

    // Проверка статуса голосующего

    function checkVoter(target, vote) {

        let address = vote.parentNode.parentNode.parentNode.parentNode.querySelector('.image').children[0].getAttribute('src');

        formData.append('URI', address);

        for(let i = 0; i < vote.parentElement.children.length; i++) {

            if(vote.parentElement.children[i] == vote) {
                let number = i + 1;
                formData.append('vote', number);
            }
        }

        formData.append('buttonStatus', 'checkVoter');

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