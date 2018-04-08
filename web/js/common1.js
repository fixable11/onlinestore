$(function() {

$('.addToCart').on('click', function(event) {
	event.preventDefault();
	addToCart($(this).attr("data-id"));
});

$('.removeFromCart').on('click', function(event) {
	event.preventDefault();
	removeFromCart($(this).attr("data-id"));
});

$('.itemCnt').on('change', function(event) {
	event.preventDefault();
	conversationPrice($(this).attr("data-id"));
});

$('.buttonRegister').on('click', function(event) {
	event.preventDefault();
	registerNewUser();
});

$('#loginButton').on('click', function(event) {
	event.preventDefault();
	login();
});

$('#updateUserData').on('click', function(event) {
	event.preventDefault();
	updateUserData();
});

$('#checkout').on('click', function(event) {
	event.preventDefault();
	saveOrder();
});

$('#showProducts').on('click', function(event) {
	event.preventDefault();
	showProducts($(this).attr("data-id"));
});

function addToCart (itemId) {
	console.log("js - addToCart");
	$.ajax({
		type: 'POST',
		async: true,
		url: "/cart/addtocart/" + itemId + "/",
		dataType: 'json',
		success: function(data){
			if(data['success']){
				$('#cartCntItems').html(data['cntItems']);
				console.log(data);
				$('#addCart_' + itemId).hide();
				$('#removeCart_' + itemId).show();
			}
		},
		error: function (request, status, error) {
           	console.log(request.responseText);
           	console.log(status);
           	console.log(error);
    }
	});
}

function removeFromCart (itemId) {
	console.log("js - removeFromCart");
	$.ajax({
		type: 'POST',
		async: true,
		url: "/cart/removefromcart/" + itemId + "/",
		dataType: 'json',
		success: function(data){
			if(data['success']){
				$('#cartCntItems').html(data['cntItems']);
				console.log(data);
				$('#addCart_' + itemId).show();
				$('#removeCart_' + itemId).hide();
			}
		},
		error: function (request, status, error) {
           	console.log(request.responseText);
           	console.log(status);
           	console.log(error);
    }
	});
}

function conversationPrice(itemId){
	var newCnt = $('#itemCnt_' + itemId).val();
	var itemPrice = $('#itemPrice_' + itemId).attr('value');
	var itemRealPrice = newCnt * itemPrice;

	$('#itemRealPrice_' + itemId).html(itemRealPrice);
}

function registerNewUser() {
	console.log("js - registerNewUser");
	var postData = getData('#registerBox');
	console.log(postData);
	$.ajax({
		type: 'POST',
		async: true,
		data: postData,
		url: "/user/register/",
		dataType: 'json',
		success: function(data){
			console.log(data);
			if(data['success']){
				alert('Регистрация прошла успешно!');
				
				$('#registerBox').hide();

				$('#userLink').attr('href', '/user/');
				$('#userLink').html(data['userName']);
				$('#userBox').show();

				$('#loginBox').hide();
				$('#btnSaveOrder').show();
			} else {
				alert(data['message']); 
			}
		},
		error: function (request, status, error) {
           	console.log(request.responseText);
           	console.log(status);
           	console.log(error);
    }
	});
}

function getData(obj){
	var hData = {};
	$('input, textarea, select', obj).each(function(){
		if(this.name && this.name!=''){
			hData[this.name] = this.value;
			console.log('hData[' + this.name + '] = ' + hData[this.name]);
 		}
	});
	return hData;
}

function login(){
	var email = $('#loginEmail').val();
	var pwd = $('#loginPwd').val();

	var postData = "email=" + email + "&pwd=" +pwd;

	$.ajax({
		type: 'POST',
		async: true,
		data: postData,
		url: "/user/login/",
		dataType: 'json',
		success: function(data){
			console.log(data);
			if(data['success']){
				
				$('#registerBox').hide();
				$('#loginBox').hide();

				$('#userLink').attr('href', '/user/');
				$('#userLink').html(data['displayName']);
				$('#userBox').show();

				$('#name').val(data['name']);
				$('#phone').val(data['phone']);
				$('#adress').val(data['adress']);

				$('#btnSaveOrder').show();

			} else {
				alert(data['message']); 
			}
		},
		error: function (request, status, error) {
           	console.log(request.responseText);
           	console.log(status);
           	console.log(error);
    }
	});
}

function updateUserData(){
	console.log('js - updateUserData');
	var phone = $('#newPhone').val();
	var adress = $('#newAdress').val();
	var pwd1 = $('#newPwd1').val();
	var pwd2 = $('#newPwd2').val();
	var curPwd = $('#curPwd').val();
	var name = $('#newName').val();

	var postData = {phone: phone,
									adress: adress,
									name: name,
									pwd1: pwd1,
									pwd2: pwd2,
									curPwd: curPwd};

	$.ajax({
		type: 'POST',
		async: true,
		data: postData,
		url: "/user/update/",
		dataType: 'json',
		success: function(data){
			console.log(data);
			if(data['success']){
				$('#userLink').html(data['userName']);
				alert(data['message']);
			} else {
				alert(data['message']); 
			}
		},
		error: function (request, status, error) {
           	console.log(request.responseText);
           	console.log(status);
           	console.log(error);
    }
	});
	
}

function saveOrder(){
	var postData = getData('form');

	$.ajax({
		type: 'POST',
		async: true,
		data: postData,
		url: "/cart/saveorder/",
		dataType: 'json',
		success: function(data){
			console.log(data);
			if(data['success']){
				alert(data['message']);
				window.location.href = '/';
			} else {
				alert(data['message']); 
			}
		},
		error: function (request, status, error) {
           	console.log(request.responseText);
           	console.log(status);
           	console.log(error);
    }
	});

}





});