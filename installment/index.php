<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рассрочка 0% до 12 месяцев");
$APPLICATION->SetPageProperty("title", "Оформить рассрочку | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Условия получения рассрочки в интернет-магазине «RELAXA STAR». Купить массажное кресло, массажер или тренажер в кредит за 0% годовых. ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
$APPLICATION->SetPageProperty("tags", "Кредит, рассрочка, ноль, процентов, 0%, годовых, 12, месяцев, частичный, взнос, условия, купить, заказать, цена, интернет-магазин, доставка, стоимость, большой, выбор, товары, известные, производители, массаж, кресла, массажеры, тренажеры, фитнес");
$APPLICATION->SetPageProperty("keywords", "Кредит, рассрочка, ноль, процентов, 0%, годовых, 12, месяцев, частичный, взнос, условия, купить, заказать, цена, интернет-магазин, доставка, стоимость, большой, выбор, товары, известные, производители, массаж, кресла, массажеры, тренажеры, фитнес");
?>

    <div class="static_relaxa_page">

<h1>Рассрочка</h1><br>
<hr>
	<div class="ttext-ccolor">
		<h2>Выбирайте подходящий способ оплаты сами!</h2>
	</div>
	<div style="text-align: center;">
 <figure class="brend"> <a href="#anchor3" class="anchor-scroll"><img width="250" alt="Почта Банк" src="/upload/medialibrary/cf4/pochta_bank.png" height="125" title="Почта Банк"></a></figure> 
<figure class="brend"> <a href="#anchor2" class="anchor-scroll"><img width="250" src="/upload/medialibrary/de9/khalva.png" height="125" alt="Халва" title="Халва"></a></figure> <figure class="brend"> <a href="#anchor4" class="anchor-scroll"><img width="250" src="/upload/medialibrary/6d0/v_kredit.png" height="125" alt="ВКРЕДИТ" title="ВКРЕДИТ"></a></figure>
	</div>
 <br>
 <br>
	<hr>
 <br>
	<p id="anchor3">
	</p>
 <br>
	<h2>Рассрочка Почта Банк</h2>
	<div id="pos-credit-container">
	</div>
	 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> <script src="https://my.pochtabank.ru/sdk/v1/pos-credit.js"></script> <script>
   var options = {	ttName: "https://www.okna4me.ru/" ,

	ttCode:	"1009001003581",
   category: "227", manualOrderInput: true }


   window.PBSDK.posCredit.mount('#pos-credit-container', options);

   //---START
  // Скрываем поля
  $('#category').closest('.field---1USKK').hide();  // категория
  $('#ttName').closest('.field---1USKK').hide();    // название
  // Если хотим изменить текст Загловка то добавляем:
  $(".text---zAhjo").text("Рассрочка");

  // И меняее текст в списке, где k это строчка в списке
  $.each($('.item---wylBY'), function (k,v) {
      if(k == 0)
          v.innerText = '0% первоначальный взнос';
      if(k == 1)
          v.innerText = 'Рассрочка до 12 месяцев';
  });
  //---END


window.PBSDK.posCredit.on('done', function(id){
      console.log('Id заявки: ' + id)
   });
</script> <br>
 <img width="100%" alt="pochta_bank" src="/upload/medialibrary/5c7/news_vedomosti_220716.jpg" title="pochta_bank">
	<h3>Условия в ПАО "Почта Банк":</h3>
	<p>
		 Условия предоставления рассрочки:
	</p>
	<ul>
		<li>Срок от 6 до 24 месяцев</li>
		<li>Первоначальный взнос: 0 - 90% от суммы чека</li>
		<li>Сумма рассрочки от 3 000 до 300 000 рублей</li>
	</ul>
	<p>
		 Требования к заемщику:
	</p>
	<ul>
		<li>Гражданство Рф</li>
		<li>Постоянная регистрация на территории РФ</li>
		<li>Возраст&nbsp;для женщин от 18 лет и&nbsp;для мужчин от 21 года&nbsp;(максимальный возраст заемщика: для женщин до 70 лет, для мужчин до 65 лет)</li>
	</ul>
	<p>
		 Документы, необходимые для рассрочки:
	</p>
	<ul>
		<li>Паспорт РФ</li>
	</ul>
	<p>
	</p>
	<p>
		 Досрочное и частичное погашение доступно без комиссии и заявлений. Рассрочку предоставляет ПАО «Почта Банк» - Лицензия ЦБ РФ на осуществление банковских операций № 650 от 25.03.2016. Банк самостоятельно принимает решение о предоставлении либо отказе в предоставлении рассрочки без объяснения причин.
	</p>
	<h3>Способ оформления рассрочки в ПАО «Почта Банк»:</h3>
	<p>
 <b>Шаг 1:</b> Внимательно заполните форму анкеты.
	</p>
	<p>
 <b>Шаг 2:</b> Укажите ваши ФИО, номер мобильного телефона, сумму покупки.
	</p>
	<p>
 <b>Шаг 3:</b> На номер, указанный Вами поступит SMS от Банка, с кодом подтверждения, который необходимо ввести в соответствующее поле анкеты.
	</p>
	<p>
 <b>Шаг 4:</b> После того, как появится текст: «Ваша заявка успешно отправлена в Банк», ждать звонка от сотрудника Банка (до 10 мин).
	</p>
	<p>
 <b>Шаг 5:</b> Заполнить заявку на получение рассрочки по телефону.
	</p>
	<p>
 <b>Шаг 6:</b> Сразу после заполнения анкеты Вам поступит смс с решением от Банка.
	</p>
	<p>
 <b>Шаг 7:</b> Если решение положительное, необходимо уведомить об этом сотрудника Торговой организации, он подскажет куда нужно обратиться для подписания Договора с Банком. При подписании Договора, необходимо предоставить ОРИГИНАЛ Паспорта РФ с постоянной пропиской.
	</p>
 <br>
	<p>
	</p>
	<p>
	</p>
	<p>
	</p>
	<hr style="height: 0px; border-collapse: collapse;">
	<p>
	</p>
	<p id="anchor2">
	</p>
	<p id="anchor2" style="text-align: center;">
		 &nbsp;&nbsp;<img width="100%" alt="halva" src="/upload/medialibrary/627/halva.jpg" title="halva" align="middle">
	</p>
 <br>
	<h2>Рассрочка Халва</h2>
	<p>
		 Карта рассрочки Халва&nbsp;- это возможность совершать ежедневные покупки в рассрочку до 12 месяцев без первоначального взноса, комиссий и переплат в магазинах-партнерах.
	</p>
	<p>
 <b>«Халва» - это:</b>
	</p>
	<p>
		 •&nbsp;Мгновенные покупки в рассрочку. Пришел, увидел товар и купил его без оформления документов, сэкономив время!
	</p>
	<p>
		 •&nbsp;Выгодная рассрочка. При совершении покупок в магазинах-партнерах предоставляется беспроцентная рассрочка до 12 месяцев!
	</p>
	<p>
		 •&nbsp;Без первоначального взноса и переплат. Цена товара = сумме рассрочки!&nbsp;<br>
		 Сумма каждой покупки делится на равное количество платежей в зависимости от срока предоставляемой рассрочки.
	</p>
	<p>
		 •&nbsp;Возобновляемый лимит кредитования до 350 тыс. рублей. Устанавливается в соответствии с запросом клиента, но при этом может быть скорректирован Банком при проведении оценки заемщика.
	</p>
	<p>
		 •&nbsp;Широкая партнерская сеть. Привлекательная широкая сеть магазинов-партнеров, которая постоянно растет!
	</p>
	<p>
		 •&nbsp;Бесконтактные платежи (технология PayPass).&nbsp;Картой Халва можно совершать платежи в одно касание, и экономить время на введении ПИН-кода или подписи чека.
	</p>
	<p>
		 •&nbsp;Выдача карты - бесплатно: без комиссии за годовое ведение счета!
	</p>
 <br>
	<h3>Условия для карты "ХАЛВА"</h3>
	<ul>
		<li>Гражданство РФ</li>
		<li>Возраст от 20 до 80 лет</li>
		<li>Официальное трудоустройство (стаж на последнем месте работы не менее 4 месяцев)</li>
		<li>Наличие постоянной регистрации не менее 4-х последних месяцев (на территории одного населенного пункта РФ) и проживание в городе присутствия подразделения Банка или прилегающих населенных пунктах (но не более 70 километров от границы населенного пункта)</li>
		<li>Наличие стационарного рабочего или домашнего телефона</li>
		<li>Для оформления карты достаточно только паспорта РФ</li>
	</ul>
	<p>
 <b>Способы оплаты услуг:&nbsp;</b>
	</p>
	<ul>
		<li>Через устройства самообслуживания и офисы Банка</li>
		<li>Через Отделения Почты России</li>
		<li>Через Сторонние организации</li>
		<li>Посредством перевода с карты на карту с использованием реквизитов карты</li>
		<li>Через сервис Интернет-банк (перевод с иных счетов Клиента)</li>
	</ul>
	 <style type="text/css">
.avd_div{margin:30px auto;padding:0;text-align:center;display:block;}
.avd_div a {color:#fff !important;}
.bucn_2_r{text-decoration:none;outline:none;display:inline-block;padding:12px 40px;margin:10px 20px;font-family:'Montserrat', sans-serif;font-size:24px;font-weight:300;color:#fff;transition:.5s;-webkit-border-radius:30px;-moz-border-radius:30px;-o-border-radius:30px;border-radius:30px;background-position:100% 0;background-size:200% 200%;text-shadow:0 1px 1px #555;-webkit-box-shadow:0 0 2px #333;-moz-box-shadow:0 0 2px #333;-o-box-shadow:0 0 2px #333;box-shadow:0 0 2px #333;background-color:#630000;background-image:linear-gradient(45deg, #630000 0%, #ff7b7b 50%, #630000 100%);background-image:-o-linear-gradient(45deg, #630000 0%, #ff7b7b 50%, #630000 100%);background-image:-moz-linear-gradient(45deg, #630000 0%, #ff7b7b 50%, #630000 100%);background-image:-webkit-linear-gradient(45deg, #630000 0%, #ff7b7b 50%, #630000 100%);background-image:-ms-linear-gradient(45deg, #630000 0%, #ff7b7b 50%, #630000 100%);}
.bucn_2_r:hover{-webkit-box-shadow:0 0 4px #333;-moz-box-shadow:0 0 4px #333;-o-box-shadow:0 0 4px #333;box-shadow:0 0 4px #333;background-position:0 0;}
.bucn_2_r:hover,.bucn_2_r:active,.bucn_2_r:focus{color:#fff;text-shadow:0 1px 2px #333;}
 *::before, *::after{box-sizing:border-box;}
 @media only screen and (max-width: 600px){
.bucn_2_r {
font-size: 4vw;
}
 }
</style>
	<div class="avd_div">
 <a href="https://halvacard.ru/order/#app" class="bucn_2_r">Заказать карту "Халва"</a>
	</div>
 <br>
	<hr style="height: 0px; border-collapse: collapse;">
	<p id="anchor3">
	</p>
 <br>
	<p id="anchor4">
	</p>
	<h2>Рассрочка Вкредит.рф</h2>
	<h3>Условия предоставления беспроцентной рассрочки:</h3>
	<ul>
		<li>Возраст от 18 до 70 лет;</li>
		<li>Постоянная регистрация в России;</li>
		<li>Стаж на последнем месте работы превышает 3 месяца;</li>
		<li>Кредит оформляется на покупку стоимостью от 3 000 до 1 350 000 рублей;</li>
		<li>Кредит можно взять на срок от 6 до 36 месяцев.</li>
	</ul>
 <br>
	<h3>Преимущества сервиса онлайн-кредитования Вкредит.рф</h3>
	<br>
	<div class="ourAdvantages-block">
		<div class="containerAd">
			<div class="row clearfix ourAdvantages-list">
				<div class="col-xs-6 col-lg-3 ourAdvantages-item">
					<div class="ourAdvantages-item__img">
 <img alt="advantages-1" src="https://xn--b1aecnh0br.xn--p1ai/wp-content/uploads/2018/09/advantages-1.png">
					</div>
					<div class="ourAdvantages-item__content">
						<p>
							Принятие решения в течение 5 минут
						</p>
					</div>
				</div>
				<div class="col-xs-6 col-lg-3 ourAdvantages-item">
					<div class="ourAdvantages-item__img">
 <img alt="advantages-2" src="https://xn--b1aecnh0br.xn--p1ai/wp-content/uploads/2018/09/advantages-2.png">
					</div>
					<div class="ourAdvantages-item__content">
						<p>
							8 кредитных организаций
						</p>
					</div>
				</div>
				<div class="col-xs-6 col-lg-3 ourAdvantages-item">
					<div class="ourAdvantages-item__img">
 <img alt="advantages-3" src="https://xn--b1aecnh0br.xn--p1ai/wp-content/uploads/2018/09/advantages-3.png">
					</div>
					<div class="ourAdvantages-item__content">
						<p>
							Полная конфиденциальность данных
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
 <br>
	<ol>
		<li>Вам не надо идти в офис. Все документы на заявку подаются онлайн из любого места, где есть интернет. Заявку можно заполнить с помощью нашего оператора . Сам процесс не займет у Вас более 5 минут.<br>
 </li>
		<li>Нет необходимости проводить время в очереди в банке и заполнять пакет документов. Ответ по кредиту приходит в течение 45 секунд.<br>
 </li>
		<li>Заявку рассматривают сразу несколько банков, что увеличивает шансы на успех. ВКРЕДИТ.РФ сотрудничает только с проверенными организациями — лидерами официального рейтинга надежности банков РФ. Одобрение получают до 80% заявок.<br>
 </li>
		<li>Никаких надписей мелким шрифтом в договоре. Оператор согласовывает с Вами все условия по кредиту.<br>
 </li>
		<li>Курьер привезет документы на подпись в любое удобное для Вас место.<br>
 </li>
		<p>
			 Остались вопросы? Пишите:&nbsp;<noindex><a href="mailto:web@relaxa.ru" target="_blank">web@relaxa.ru</a></noindex>&nbsp;Звоните по телефону 8-800-333-00-51
		</p>
	</ol>

	 <style>
ul {
font-size: 14pt;
}
ol {
font-size: 14pt;
}
</style>
</div>
 <br>
<style type="text/css">
@media (max-width: 630px) {
#pos-credit-container .pb-sdk-pos-credit .cont---3gAGR {
    padding: 40px 15px;
    min-width: auto !important;
}
}
</style>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>