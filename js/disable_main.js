$(document).ready(function () {
	$("#signup-submit").click(function () {
		var form = $("#signup-form");
		var inputs = form.find('input:text, input:password');
		var validators = {
			password_signup: {
	            regex: /^[0-9A-z_]{6,}$/,
	        	min_length: 6,
	        	max_length: 30
	        },
	        email_signup: {
	        	regex: /\S+@\S+\.\S+/,
	        	min_length: 6,
	        	max_length: 40
	        },
	        first_name: {
	        	regex: /^[А-яa-zA-яіІїЇґҐёЁ]{2,}$/,
	        	min_length: 2,
	        	max_length: 30
	        },
	        last_name: {
	        	regex: /^[А-яa-zA-яіІїЇґҐёЁ]{2,}$/,
	        	min_length: 2,
	        	max_length: 30
	        },
	        contact_phone: {
	        	regex: /^[0-9]{12,}$/,
	        	min_length: 12,
	        	max_length: 12
	        }
		};
		var isValid = true; 
		$.each(validators, function (key, value) {
			if(!validateField(key, value)) {
				$("#" + key).popover('show');
				isValid = false;
			}
		})
		if ($("#password_confirm").length > 0 && $("#password_signup").val() != $("#password_confirm").val()) {
			$("#password_confirm").attr("data-content", "Паролі не співпадають");
			$("#password_confirm").popover('show');
			isValid = false;
		}
		if (!isValid) return;
		$.ajax({
		  type: "POST",
		  url: "/signup_confirm",
		  data: form.serializeArray(),

		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error)
		  	} else {
		  		if ('redirect_to' in responseObj) {
					window.location.href = responseObj.redirect_to;
		  		}
		  	}
		  }
		});
	});

	$('#new-institution-submit').click(function () {
		var form = $("#institution-form");
		var validators = {
	        name: {
	        	regex: /^[0-9А-яA-zіІїЇґҐёЁ\-\"\'\*\s]{2,}$/,
	        	min_length: 2,
	        	max_length: 30
	        },
	        city: {
	        	regex: /^[0-9А-яA-zіІїЇґҐ.\-\"\'\*\s]{2,}$/,
	        	min_length: 2,
	        	max_length: 30
	        },
	        address: {
	        	regex: /^[0-9А-яA-zіІїЇґҐ\-\"\'\*,.\s]{2,}$/,
	        	min_length: 8,
	        	max_length: 50
	        },
	        work_shedule: {
	        	regex: /^[0-9А-яA-zіІїЇґҐ\-\"\'*:\s]{5,}$/,
	        	min_length: 5,
	        	max_length: 50
	        },
	        hour_price: {
	        	regex: /^[0-9]{0,}$/,
	        	min_length: 0,
	        	max_length: 12
	        },
	        day_price: {
	        	regex: /^[0-9]{0,}$/,
	        	min_length: 0,
	        	max_length: 12
	        },
	        subscription_price: {
				regex: /^[0-9]{0,}$/,
	        	min_length: 0,
	        	max_length: 12
	        }
		};
		var isValid = true; 
		$.each(validators, function (key, value) {
			if(!validateField(key, value)) {
				$("#" + key).popover('show');
				isValid = false;
			}
		})
		if (!isValid) return;
		$.ajax({
		  type: "POST",
		  url: "/add_institution",
		  data: form.serializeArray(),

		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error)
		  	} else {
				if ('redirect_to' in responseObj) {
					window.location.href = responseObj.redirect_to;
		  		}
		  	}
		  }
		});
	});
	
	$('#login-form').submit(function(e) {
		e.preventDefault();
		var validators = {
			email: {
				regex: /\S+@\S+\.\S+/,
				min_length: 6,
				max_length: 40
			},
			password: {
				regex: /^[0-9A-z_]{6,}$/,
				min_length: 6,
				max_length: 30		
			}
		};
		var isValid = true; 
		$.each(validators, function (key, value) {
			if(!validateField(key, value)) {
				$("#" + key).popover('show');
				isValid = false;
			}
		})
		if (!isValid) return;
		$.ajax({
		  type: "POST",
		  url: "/login_confirm",
		  data: $(this).serializeArray(),

		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error)
		  	} else {
				if ('redirect_to' in responseObj) {
					window.location.href = responseObj.redirect_to;
		  		}
		  	}
		  }
		});
	});

	$('#search-form').submit(function(e) {
		e.preventDefault();
		$('#search-results').empty();
		$.ajax({
		  type: "GET",
		  url: "/search",
		  data: $(this).serializeArray(),
		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error);
		  	} else {
		  		$('#search-results').append(responseObj.result);
		  		console.log("success");
		  	}
		  }
		});
		$('#search-modal').modal('show');

	});

	$('#post-form').submit(function (e) {
		e.preventDefault();
		$.ajax({
		  type: "POST",
		  url: "/add_post",
		  data: $(this).serializeArray(),

		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error);
		  	} else {
		  		$('#posts').append(responseObj.post);
		  	}
		  }
		});
	});

	$('#rating-form').submit(function (e) {
		e.preventDefault();
		$.ajax({
		  type: "POST",
		  url: "/add_rating",
		  data: $(this).serializeArray(),

		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error);
		  	} else {
		  		$('#rates').append(responseObj.rating);
		  	}
		  }
		});
	});

	$('.post-rm-btn').click(function () {
		value = $(this).val();
		$.ajax({
		  type: "POST",
		  url: "/remove_post",
		  data: {id: value},
		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error);
		  	} else {
		  		console.log("removed");
		  		$('.post-rm-btn[value=' + value + ']').closest('.post').remove();
		  	}
		  }
		});
	});

	$('.rating-rm-btn').click(function () {
		value = $(this).val();
		$.ajax({
		  type: "POST",
		  url: "/remove_rating",
		  data: {id: value},
		  success: function(response) {
		  	var responseObj = jQuery.parseJSON(response);
		  	if (responseObj.status == "error") {
		  		appendWarning('errors', responseObj.error);
		  	} else {
		  		console.log("removed");
		  		$('.rating-rm-btn[value=' + value + ']').closest('.post').remove();
		  	}
		  }
		});
	});
});


function appendWarning(id, text) {
	$('#' + id).append(
		'<div class="alert alert-danger">'+
		  text + 
		'</div>'
	);
}

function validateField(id, validator) {
	var input = $("#" + id);
	if (!input) {
		return true;
	}
	var val = input.val();
	if ('min_length' in validator && input.val().length < validator.min_length) {
		input.attr("data-content", "Ввід не може бути коротшим, ніж " + validator.min_length + " символів");
		return false;
	}
	if ('max_length' in validator && input.val().length > validator.max_length) {
		input.attr("data-content", "Ввід не може бути довшим, ніж " + validator.max_length + " символів");
		return false;
	}
	if ('regex' in validator && !(new RegExp(validator.regex).test(input.val())) ) {
		input.attr("data-content", "Ви використали недопустимі символи");
		return false;
	} 
	return true;
}

function edit (strInstitution) {
	var institution = jQuery.parseJSON(strInstitution);
	$.each(institution, function (key, value) {
		$("#" + key).val(value);
	})
}
