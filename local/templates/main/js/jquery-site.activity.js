/**
* @name jQuery plugin Activity
* @version 1.3a
* @author vs.ustinov
* @author an.nidziy
* @author gr.tsvetkov
* @license GNU Free Documentation License
* @copyright 2013 ��� �����-���������
* @link http://www.it-agency.ru/process/60seconds
* @uses jQuery 1.7+
*
* ���������: options = default
*
* @param achieveTime = 60
* ����� (� ��������), ��� ������� ����� ��������� ���������� (������� callBack-�������)
*
* @param loop = 0
* ��� ������ ���������� - �� ���������������, ������� ������
*
* @param eventList = 'blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error'
* ��� ������ ���������� - �� ���������������, ������� ������
*
* @param testPeriod = 10
* ����� (� ��������) - ������������� �������� ������� �� ��������
*
* @param useMultiMode = 0
* ������������ cookie, ��� ����������� ������ ��� ��������� �� ������ �������� �����
*
* @param callBack = function (e) { console.log('Achieved!') }
* CallBack-�������, ������� ����� ������������ �� ���������� ������� achieveTime
*
* @param watchEvery = 1
* ����� (� ��������) - ������������� ������.
*
*
* @todo $('selector').activity(options)
*
* @example $('body').activity({'achieveTime':60,'testPeriod':10, useMultiMode: 1, callBack: function (e) { ga('send', 'event', 'Activity', '60_sec'); yaCounterXXXXXXXXX.reachGoal('60_sec'); }});
* ������ �������������. ��������� ���������� �� ��������� 60 ������;
* ��������� ���������� ������ 10 ������; ���������� ����������� �� ����� �����;
* ��� ���������� ���������� �������, ������� ��������:
* ga('send', 'event', 'Activity', '60_sec'); ��� Universal Analytics
* yaCounterXXXXXXXXX.reachGoal('60_sec'); ��� ������.������� (��� XXXXXXXXX = ��� �������)
*
*/

(function( $ ){
	var timerHand = 0, data = {}, eventFlag = 0, methods = { // ��������� ���������� � ������
		init:function(settings) { //������� �������������
			return this.each(function() { //�������������� �������
				data = jQuery.extend({ // ��������� ����������
					achieveTime: 60 // ����� (� ��������), ��� ������� ����� ��������� ���������� (������� callBack-�������)
					,loop:0 // ��� ������ ���������� - �� ���������������, ������� ������
					,eventList:'blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error'
					,testPeriod: 10 // ����� (� ��������) - ������������� �������� ������� �� ��������
					,useMultiMode : 1 // ������������ cookie, ��� ����������� ������ ��� ��������� �� ���������
					,callBack: function (e) { console.log('Achieved!') } // CallBack-�������, ������� ����� ������������ �� ���������� ������� achieveTime
					,watchEvery: 1 // ����� (� ��������) - ������������� ������.
					,counter : {'test':0, 'achiev':0} // �������� �������� ���������� � ���������� (�������� ��-���������)
				}, settings);

				data.watchEvery *= 1000; //������� ����������

				if(data.useMultiMode) {
					methods.loadMultiData();//���� ������� ����� �����-����������� ���������� - ��������� ������
				}

				if(data.counter.achiev != -1) { //���� �� ���������
					$(this).bind(data.eventList, methods.eventTrigger); //Bind`��� ������� �� eventList � ���������� �������
					methods.process();  // ��������� ������� ��������
				}
			})
		}, process:function() { // �������, �������������� ������ watchEvery*1000
			data.counter.test += 1; // ����������� ������� �������� ����������

			if(data.counter.test == data.testPeriod) { // ���� ������ ����� ��� �������������
				if(eventFlag) { // ���� �� ����� �������� ���� ������������� �������
					eventFlag = 0; // ���������� ���� �������� �������
					data.counter.achiev += data.testPeriod; // ����������� ������� ���������� �� ���������� ������� �������� ����������
				}
				data.counter.test = 0; // ���������� ������� �������� ����������
			}

			timerHand = setTimeout(methods.process, data.watchEvery); // ��������� ������� watchEvery
			if(data.counter.achiev >= data.achieveTime) { // ��������, �� ��������� �� ����������
				if(!data.loop) clearTimeout(timerHand); // ���� � ����� "���������" - ������� ���������� ������ ��������
				data.counter.achiev = data.loop ? 0 : -1; //���� � ����� - ���������� ����������, ����� ���������
				data.callBack.call(this,data); // �������� callBack-������� ��������� ����������
			}
			if(data.useMultiMode) document.cookie = 'activity=' + data.counter.test+'|'+data.counter.achiev+'; path=/;'; // ���� ���������� �����-���������� ���������� - ��������� ������ ��������� � cookie

		}, eventTrigger:function() { // �������, ������������ ��� ������������ ������� �� eventList
			eventFlag = 1; // ��������� ����� ��������� �������
		}, loadMultiData:function() { // ����������� ������ �������� cookie
			var search = ' activity=';
			var cookie = ' ' + document.cookie;
			if (cookie.length > 0) {
				if (cookie.indexOf(search) != -1) {
					offset = cookie.indexOf(search) + search.length;
					var m = unescape(cookie.substring(offset, cookie.indexOf(";", offset) == -1 ? cookie.length : cookie.indexOf(";", offset))).split('|');
					data.counter.test = parseInt(m[0]);
					data.counter.achiev = parseInt(m[1]);
					return;
				}
			}
			data.counter.test = data.counter.achiev = 0;
		}};

		$.fn.activity = function(method) { // ������ Activity
			if(methods[method]) { // ���� ������ �����
				return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
			} else {
				if(typeof method === "object" || !method) { // ���������� �������������
					return methods.init.apply(this, arguments);
				} else {
					$.error("Method " + method + " does not exist on jQuery.activity"); //������� ������.
				}
			}
		}
})( jQuery );
