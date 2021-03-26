((document) => {
    'use strict';
    
    const inactivityTimeout = 840;

    let inactivityTimer; 

    let resetInactivityTimer = () => {
        clearTimeout(inactivityTimer);
        if (!isMobile.any()) {
            inactivityTimer = setTimeout(rouletteBegin, inactivityTimeout * 1000);
        } else {
            console.log('mobile detected. timeout is not set');
        }
    };

    ['click', 'keypress', 'scroll'].forEach(item => {
        document.addEventListener(item, () => resetInactivityTimer());
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('mouseout', evt => {
            if (evt.relatedTarget === null || evt.toElement === null) {
                if (!isMobile.any()) {
                    rouletteBegin();
                } else {
                    console.log('mobile detected');
                }
            }
        })
    });

    let isModalShown = () => {
        return document.cookie.replace(/(?:(?:^|.*;\s*)roulette\s*\=\s*([^;]*).*$)|^.*$/, "$1") == 1;
    };

    let rouletteBegin = () => {
        if (!isModalShown()) {
            document.querySelector('.roulette-modal').classList.add('roulette-modal_active');
            document.cookie = 'roulette=1';
        }
    };

    let phoneField = document.getElementById('roulette-form__phone-field');
    phoneField.addEventListener('change', evt => {
        phoneField.setCustomValidity('');

        if (phoneField.value.length != 16) {
            phoneField.setCustomValidity('Номер телефона указан неверно!');
        }
    })

    document.forms.roulette.addEventListener('submit', event => {
        event.preventDefault();

        fetch(event.target.action, {
            method: 'POST',
            body: new FormData(event.target)
        }).then(response => {
            return response.json();
        }).then(data => {

            if (data.errors != null && data.errors.includes('phone_exists')) {
                phoneField.setCustomValidity('Номер телефона уже участвовал в рулетке!');
                return;
            }

            document.cookie = 'roulette=1; path=/; expires=' + new Date(new Date().getTime() + 86400 * 30 * 1000).toUTCString(); // +30 days

            let roulettePieceDeg = 24;
            let rouletteWheel = document.querySelector('.roulette__wheel');

            let resultDegree = 360 + (roulettePieceDeg * parseInt(data.result));

            let rotate = 1;

            let twistWheel = () => {
                rotate++;
                if (rotate < resultDegree) {
                    rouletteWheel.style.transform = `rotate(+${rotate}deg)`;
                } else {
                    setTimeout(showMessage, 1500);
                    return;
                }

                setTimeout(twistWheel, rotate > resultDegree - 100 ? rotate / 50 : 5);
            }

            twistWheel();

            let showMessage = () => {
                document.querySelector('.roulette').classList.add('hidden');
                document.querySelector('.roulette-form').classList.add('hidden');
                document.querySelector('.roulette-modal__container').classList.add('roulette-modal__container_result');
				document.querySelector('.roulette-modal__close').setAttribute('onclick', 'document.getElementById("labellabel").style.display = "none"');
                document.querySelector('.roulette-header__title').innerHTML = 'Поздравляем!';
                document.querySelector('.roulette-header__description').innerHTML = `<font style="padding-top: 10px;">Вы выиграли <b>${data.message}!</b></font>`;

                document.querySelector('.roulette-modal__results').innerHTML = 'Наш менеджер свяжется с Вами и расскажет Вам о деталях получения подарка.<br>Воспользоваться купоном можно не позднее 24 часов с момента запуска рулетки.';
            }

            if (screen.width < 999) {
                showMessage();
            }
        });
        try {
          gtag("event", "Roullet", { "event_category": "Form", "event_action": "submit", });
          console.log('successful GAgoal sends');
          yaCounter13260706.reachGoal("Form_Submit_Roullet");
          yaCounter13260706.reachGoal("Macroconversion");
          console.log('successful YAgoal sends');
        } catch (e) {
            console.log('ga error');
        }
        
        
    });

    document.querySelector('.roulette-modal__close').addEventListener('click', () => {
        document.querySelector('.roulette-modal_active').classList.remove('roulette-modal_active');
        // document.cookie = 'roulette=1';
    });

    resetInactivityTimer();


    new Cleave('#roulette-form__phone-field', {
        phone: true,
        phoneRegionCode: 'RU',
        prefix: '+7 ',
    });	
})(document);
