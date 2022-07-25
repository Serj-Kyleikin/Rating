
// Контроль событий рейтинга

let targets = document.querySelectorAll('.ratingVote');      // Получение колллекции рейтингов

for(let target of targets) {

    target.onmouseover = function(event) {

        let vote = parseInt(event.target.getAttribute('data-vote'));
        let stars = event.target.parentElement.children;

        if(!target.parentElement.querySelector('.user_vote')) {

            for(let i = 0; i < stars.length; i++) {
                if(i < vote) stars[i].classList.add('choise');
                else stars[i].classList.remove('choise');
            }

            // Удаление цвета при смене фокуса мышки с рейтинга

            target.onmouseout = function() {
                for(let i = 0; i < stars.length; i++) stars[i].classList.remove('choise');		
            }
        }

        target.onclick = function() {
            addRating(target, vote);           // Добавление рейтинга
        }
    }
}

// Добавление рейтинга

async function addRating(target, vote) {

    let formData = new FormData();
    formData.append('ajaxSettings', 'page:Main:addRating');

    formData.append('vote', vote);
    formData.append('article_id', target.closest(".article").getAttribute('data-article'));

    let getLink = await fetch('/Ajax.php', {
        method: 'POST',
        body: formData
    });

    let data = await getLink.text();

    if(!data.match(/^\d{1}:/)) {                                                    // Обновление рейтинга

        let new_rating = 160 / 5 * data.split('_')[0];
        let new_voters = data.split('_')[1];

        let rating = target.parentElement.querySelector('.ratingResult');
        let voters = target.parentElement.querySelector('.voters')

        rating.style.width = new_rating + 'px';
        voters.textContent = 'Проголосовало: ' + new_voters;

        createEl(target.parentElement, 'p', 'user_vote', 'Ваша оценка: ' + vote);

    } else if(!target.parentElement.querySelector('.showMessage')) {                // Сообщение

        let DIV = createEl(target.parentElement, 'div', 'showMessage', data.split(':')[1]);
        if(data.split(':')[0] == 0) createEl(DIV, 'a', '/registration', 'Зарегистрироваться');

    } else return;                                                                  // Повтор сообщения
}

// Добавление нового элемента для сообщения

function createEl(block, el, data, text) {

    let New = document.createElement(el);
    block.appendChild(New);
    New.textContent = text;

    if(el == 'a') New.href = data;
    else New.className = data;

    if(el == 'div') return New;
}