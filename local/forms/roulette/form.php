<?php

$theme = $arParams['theme'] ?? 'default';

// $variants = [
//     'Скидка 3%',
//     'Бесплатная сборка',
//     'Бесплатная доставка',
//     'Подарок Массажер',
//     'Скидка 3%',
//     'Промокод на скидку 5%',
//     'Бесплатная сборка',
//     'Бесплатная доставка',
//     'Подарок Массажер',
//     'Скидка 3%',
//     'Промокод на скидку 5%',
//     'Бесплатная сборка',
//     'Бесплатная доставка',
//     'Подарок Массажер',
//     'Промокод на скидку 5%'
// ];

$variants = [
    'Скидка 3%',
    'Бесплатная сборка',
    'Бесплатная доставка',
    'Подарок Массажер',
    'Скидка 3%',
    'Промокод на скидку 5%',
    'Бесплатная сборка',
    'Бесплатная доставка',
    'Подарок Массажер',
    'Скидка 3%',
    'Промокод на скидку 5%',
    'Бесплатная сборка',
    'Бесплатная доставка',
    'Подарок Массажер',
    'Промокод на скидку 5%',
];


$siteID = 's1';
$webFormID = 3;

if (false === empty($_POST)) {


    if (true === isset($_POST['roulette-name']) && true === isset($_POST['roulette-phone'])) {
        $prize = rand(0, count($variants) - 1);

        require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

        global $DB;
        CModule::IncludeModule("form");

        $connection = \Bitrix\Main\Application::getConnection();

        $sql = sprintf(
            'select count(*) from b_form_result_answer where ANSWER_ID = 224 and USER_TEXT = "%s"',
            ($connection->getSqlHelper())->forSql($_POST['roulette-phone'])
        );

        if ($connection->queryScalar($sql) > 0) {
            die(json_encode(['errors' => ['phone_exists']]));
        }

        $resultID = CFormResult::Add($webFormID, [
            'SITE_ID' => $siteID,
            'FORM_ID' => $webFormID,
            'WEB_FORM_ID' => $webFormID,
            'form_text_223' => $_POST['roulette-name'],
            'form_text_224' => $_POST['roulette-phone'],
            'form_text_226' => $variants[$prize]
        ]);

        if ($resultID) {
            CFormCRM::onResultAdded($webFormID, $resultID);
            CFormResult::SetEvent($resultID);
            CFormResult::Mail($resultID);
        }

		if(!empty($_POST['roulette-phone'])){
        setcookie('roulette', '1', time() + 60*60*24*45, '/');
		}
		
        echo json_encode([
            'result' => $prize,
            'message' => $variants[$prize]
        ]);

        // Roistat Begin
        file_get_contents('https://www.relaxa.ru/roistat/filter.php?' . http_build_query([
            'key'     => '2b69848e2e73097cae972600754d2bd5',
            'visit'   => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie',
            'title'   => 'Заявка с "Получите подарки и промокоды"',
            'form'    => 'Получите подарки и промокоды',
            'name'    => $_POST['roulette-name'],
            'phone'   => $_POST['roulette-phone'],
        ]));
        // Roistat End
    }

    die;
}

$APPLICATION->AddHeadScript('https://cdn.jsdelivr.net/gh/nosir/cleave.js/dist/cleave.min.js');
$APPLICATION->AddHeadScript('https://cdn.jsdelivr.net/gh/nosir/cleave.js/dist/addons/cleave-phone.ru.js');
$APPLICATION->AddHeadScript('/local/forms/roulette/assets/js/scripts.js');
$APPLICATION->SetAdditionalCSS('/local/forms/roulette/assets/css/styles.css');
$APPLICATION->SetAdditionalCSS("/local/forms/roulette/assets/css/{$theme}.css");
?>
<!--<div class="roulette-modal">-->
    <div class="roulette-modal__overlay"></div>
    <div class="roulette-modal__container">
        <div class="roulette-modal__close" onmousedown="SetCookie();" onclick="document.getElementsByClassName('roulette-modal')[0].style.display = 'none';">+</div>
        <div class="roulette-header">
            <div class="roulette-header__title">АКЦИЯ РУЛЕТКА</br>Получите подарки и промокоды!</div>
			<!--<div class="roulette-header__title" style="padding-bottom: 10px;">Получите подарки и промокоды!</div>-->
            <div class="roulette-header__description">Испытайте удачу и получите комплимент от relaxa.ru</div>
        </div>

        <div class="roulette-modal__results"></div>

        <div class="roulette-form">
            <form id="roulette" name="roulette" method="post" action="/local/forms/roulette/form.php">
                <div>
                    <label for="roulette-form__name-field" class="roulette-form__label">Ваше имя</label><br>
                    <input id="roulette-form__name-field" class="roulette-form__field" placeholder="Введите имя" name="roulette-name" type="text" required>
                </div>

                <div>
                    <label for="roulette-form__field" class="roulette-form__label">Номер телефона</label><br>
                    <input id="roulette-form__phone-field" class="roulette-form__field" placeholder="Введите номер телефона" name="roulette-phone" type="text" minlength="16" maxlength="16" required>
                </div>


                <div class="roulette-form__footer">
                    <div>
                        <label><input name="roulette-privacy" type="checkbox" required checked="checked"> Согласие на обработку персональных данных</label>
                    </div>

                    <input class="roulette-form__submit" type="submit" value="Испытать удачу">

                    <div class="roulette-form__info"><sup>*</sup> Запустить рулетку можно только 1 раз</div>
					<div class="roulette-form__info"><!--<sup>*</sup> <a href="https://www.relaxa.ru/articles/6472/">Условия</a> проведения акции--></div>
                </div>
            </form>
        </div>
        <div class="roulette">
            <div class="roulette__wheel"></div>
            <div class="roulette__pizza"></div>
            <div class="roulette__snow"></div>
        </div>
    </div>
<!--</div>-->
<script>
function SetCookie(){
$.ajax({
	type: "POST",
	url: "/include/ajax/coockie.php",
	data: "Y",
	success: function(html){
	}
});
}
</script>