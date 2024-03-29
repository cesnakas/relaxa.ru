$(function(){

	var sendWebForm = function(event, data){

		var formData = new FormData(this);
		var requiredErrorPosition = false;
		var requiredError = false;

		var $thisForm = $(this).addClass("loading");
		var $parentThis = $thisForm.parents(".webFormDwModal");
		var $thisFormFields = $thisForm.find(".webFormItemField");
		var $thisFormErrors = $thisForm.find(".webFormItemError");
		var $submitButton = $thisForm.find('input[type="submit"]').addClass("loading");
		var $webFormError = $thisForm.find(".webFormError");
		var $webFormCaptchaSid = $thisForm.find(".webFormCaptchaSid");
		var $webFormCaptchaImage = $thisForm.find(".webFormCaptchaImage");

		var formId = $parentThis.data("id");

		$thisFormFields.each(function(i, nextField){

			var $nextField = $(nextField);
			if($nextField.data("required") == "Y"){
				var $nextFieldEx = $nextField.find('input[type="text"], input[type="password"], input[type="file"], select, textarea');
				if($nextFieldEx.attr("name")){
					if(!$nextFieldEx.val() || $nextFieldEx.val().length == 0){
						$nextFieldEx.addClass("error");
						if(!requiredError){
							requiredErrorPosition = $nextFieldEx.offset().top;
							requiredError = true;
						}
					}
				}

			}
		});

		if(requiredError == false){
	  		$.ajax({
	  			url: webFormAjaxDir + "?FORM_ID=" + formId + "&SITE_ID=" + webFormSiteId,
	  			data: formData,
			    cache: false,
		        contentType: false,
		        processData: false,
		        enctype: "multipart/form-data",
		        type: "POST" ,
		        dataType: "json",
	  			success: function(response){

	  				//remove error labels
	  				$thisFormErrors.empty().removeClass("visible");
	  				$webFormError.empty().removeClass("visible");

		  			if(response["SUCCESS"] != "Y"){

			  			//set errors
			  			$.each(response["ERROR"], function(nextId, nextValue){
			  				var $errorItemContainer = $("#WEB_FORM_ITEM_" + nextId);
			  				if(nextId != 0 && $errorItemContainer){
			  					$errorItemContainer.find(".webFormItemError").html(nextValue).addClass("visible");
			  				}else{
			  					$webFormError.append(nextValue).addClass("visible");
			  				}
			  			});

			  			// reload captcha
			  			if(response["CAPTCHA"]){
							$webFormCaptchaSid.val(response["CAPTCHA"]["CODE"]);
							$webFormCaptchaImage.attr("src", response["CAPTCHA"]["PICTURE"]);
						}

					}else{
						$("#webFormMessage_" + formId).css({
							display: "block"
						});
						$(".webformModal").removeClass("visible");
						$thisForm[0].reset();
						
						switch (formId) {
							case 4: // получить скидку
								sendGtag('Submit', 'Form', 'Get_Discount'); 
								sendYandex('Form_Submit_Get_Discount', 'Macroconversion');
							break;
							
							//case 5: // записаться на тест-драйв
								//sendGtag('Submit', 'Form', 'Test_Banner'); 
								//sendYandex('Form_Submit_Test_Banner', 'Macroconversion');
							//break;
							
							//case 6: // получить консультацию
								//sendGtag('Submit', 'Form', 'Get_Consultation'); 
								//sendYandex('Form_Submit_Get_Consultation', 'Macroconversion');
							//break;
						}
					}

		  			//remove loader
		  			$thisForm.removeClass("loading");
		  			$submitButton.removeClass("loading");

		  		}

	  		});
	  	}else{
	  		
	  		if(requiredErrorPosition){
	  			$("html, body").animate({
	  				"scrollTop": requiredErrorPosition - $(window).height() / 2
	  			}, 250);
	  		}

	  		$thisForm.removeClass("loading");
	  		$submitButton.removeClass("loading");
	  	}

		return event.preventDefault();

	}

	var removeErrors = function(event){
		$(this).removeClass("error");
	};

	var webFormExit = function(event){
		$(".webFormMessage").hide();
		return event.preventDefault();
	}

	var openWebFormModal = function(event){

		var $thisForm = $("#webFormDwModal_" + $(this).data("id"));
		var $thisFormCn = $thisForm.find(".webformModalContainer");

		if($thisFormCn.height() < $(window).height()){
			$thisForm.addClass("small");
		}

		$thisForm.addClass("visible");
		return event.preventDefault();

	}

	var closeWebFormModal = function(event){
		$(this).parents(".webformModal").removeClass("visible");
		return event.preventDefault();
	};

	$(document).on("focus", ".webFormItemField input, .webFormItemField select, .webFormItemField textarea", removeErrors);
	$(document).on("click", ".webFormModalHeadingExit", closeWebFormModal);
	$(document).on("click", ".openWebFormModal", openWebFormModal);
	$(document).on("click", ".webFormMessageExit", webFormExit);
	$(document).on("click", ".webFormMessageModalHeadingExit", webFormExit);
	$(document).on("submit", ".webFormDwModal.webFormModal-id-4 form", sendWebForm);

	$('input[name=form_text_227]').attr('placeholder', 'Введите имя');
	$('input[name=form_text_228]').attr('placeholder', '+7(___) ___-__-__');
	var phoneMask = new IMask(
	document.querySelector('[name="form_text_228"]'), {
	    mask: '+{7}(000)000-00-00'
	});
});
