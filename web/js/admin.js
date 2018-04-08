$(function() {

	$('.newCategory__add').on('click', function(event) {
		event.preventDefault();
		newCategory();

	});

	$('.newCategory__delete').on('click', function(event) {
		event.preventDefault();
		deleteCategory();

	});


	$('.changeCategory__btn').on('click', function(event) {
		event.preventDefault();
		updateCat($(this).attr('data-id'));

	});

	$('.updateProduct').on('click', function(event) {
		event.preventDefault();
		updateProduct($(this).attr("data-id"));

	});

	$('.addProduct__inpFile').on('change', function(event) {
		event.preventDefault();
		var filename = $(this).val().replace(/.*\\/, "");
		$('.addProduct__filePath').text(filename);

	});

	$('.addProduct__addBtn').on('click', function(event) {
		event.preventDefault();	
		addProduct();
	});

	$('.addProduct__changeBtn').on('click', function(event) {
		event.preventDefault();	
		updateProduct($(this).attr("data-id"));
	});

	$('.addProduct__submit').on('click', function(event) {
		event.preventDefault();	

		uploadImg($(this).attr("data-id"));
	});

	$('.addProduct__inpFile').on('change', function(event) {
		event.preventDefault();
		var filename = $(this).val().replace(/.*\\/, "");

	});

	$('.adminOrders__showBtn').on('click', function(event) {
		showProducts($(this).attr('data-id'));
	});

	$('.adminOrders__checkbox').on('click', function(event) {
		updateOrderStatus($(this).attr('data-id'));
	});

	$('.adminOrders__btnDate').on('click', function(event) {
		updateDatePayment($(this).attr('data-id'));
	});


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


	function newCategory(){

		var postData = {};
		var catName = $('.newCategory__inpNew').attr('name');

		var catVal = $('.newCategory__inpNew').val();
		var symlinkName = $('.newCategory__inpSym').attr('name');
		var symlink = $('.newCategory__inpSym').val();
		if(!catVal){
			alert('Пожалуйста введите название категории!');
			return;
		}

		if(!symlink.trim()){
			alert('Пожалуйста укажите символическую ссылку!');
			return;
		}

		var option = $('.newCategory__selectAdd option:selected').val();
		postData[catName] = catVal;
		postData['generalCatId'] = option;
		postData[symlinkName] = symlink;
		console.log(postData);
		$.ajax({
			type: 'POST',
			async: true,
			data: postData,
			url: "/admin/addnewcat/",
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data['success']){
					alert(data['message']);

					$('.newCategory__select').append('<option class="newCategory__option" value="'+ data['id'] +'">'+ data['name'] +'</option>');
					$('.newCategory__td .select-options').append('<li class="select-option" rel="'+ data['id'] +'">'+ data['name'] +'</li>');
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

	function deleteCategory(){

		var postData = {};
		var option = $('.newCategory__selectDelete option:selected');
		var optionVal = option.val();
		var optionName = option.text();
		postData['catId'] = optionVal;
		postData['catName'] = optionName;

		var accept = confirm("Вы уверены что хотите удалить категорию '" + optionName + "'");
		if(!accept){
			return;
		}
		$.ajax({
			type: 'POST',
			async: true,
			data: postData,
			url: "/admin/deletecat/",
			dataType: 'json',
			success: function(data){
				console.log(data);
				if(data['success']){
					alert(data['message']);
					$('.select-options li').each(function(index, el) {
						if($(el).attr('rel') == data['catId']){
							$(el).remove();
						}
					});
					$('#newCategoryName').val('');

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

	function addProduct(){
		var itemName = $('.addProduct__addName').val();
		var itemPrice = $('.addProduct__addPrice').val();
		var itemCatId = $('.addProduct__addSelect option:selected').val();
		var itemDesc = $('.addProduct__addDesc').val();

		var postData = {itemName: itemName, itemPrice: itemPrice,
			itemCatId: itemCatId, itemDesc: itemDesc};

			$.ajax({
				type: 'POST',
				async: true,
				data: postData,
				url: "/admin/addproduct/",
				dataType: 'json',
				success: function(data){
					console.log(data);
					if(data['success']){
						alert(data['message']);
						window.location.href = '/admin/products/';
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

	function updateProduct(itemId){

		var itemName = $('.addProduct__inpName[data-id =' + itemId + ']').val();
		var itemPrice = $('.addProduct__inpPrice[data-id =' + itemId + ']').val();
		var itemCatId = $('.addProduct__select[data-id =' + itemId + ']').children('option:selected').val();
		var itemDesc = $('.addProduct__textarea[data-id =' + itemId + ']').val();
		var itemStatus = $('.addProduct__checkbox[data-id =' + itemId + ']').prop('checked');

		if(!itemStatus){
			itemStatus = 1;
		} else {
			itemStatus = 0;
		}

		var postData = {itemId: itemId, itemName: itemName, itemPrice: itemPrice,
			itemCatId: itemCatId, itemDesc: itemDesc, itemStatus: itemStatus};

			$.ajax({
				type: 'POST',
				async: true,
				data: postData,
				url: "/admin/updateproduct/",
				dataType: 'json',
				success: function(data){
					if(data['success']){
						console.log(data);
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

	function uploadImg(itemDataId){

		var postData = new FormData();
		console.log(itemId)
		var itemId = $('.addProduct__inpId[data-id =' + itemDataId + ']');
		var fileInput = $('.addProduct__inpFile[data-id =' + itemDataId + ']');
		console.log(fileInput);
		var fileData = fileInput[0].files[0];

				postData.append(fileInput.attr('name'), fileData);
				postData.append(itemId.attr('name'), itemId.val());

		$.ajax({
			type: 'POST',
			async: true,
			data: postData,
			url: "/admin/upload/",
			dataType: 'json',
			processData : false,
			contentType : false,
			success: function(data){
				console.log(data);

				var src = data['src'];
				console.log(src);
				$('.addProduct__img[data-id =' + itemDataId + ']').prop("src", src + "?" + new Date().valueOf());
				$('.addProduct__filePath').text('');
				alert(data['message']);
				
			},
			error: function (request, status, error) {
				console.log(request.responseText);
				console.log(status);
				console.log(error);
			}
		});

	}

	function showProducts(id){
		
		$('.adminOrders__td[data-id=' + id + ']').fadeToggle();
	}





 function updateCat(itemId){
 	var newName = $('.changeCategory__input[data-id =' + itemId + ']').val();
 	var parentId = $('.changeCategory__select[data-id =' + itemId + ']').children('option:selected').val();
 	console.log(parentId);
 	var postData = {itemId: itemId, parentId: parentId, newName: newName};

 	$.ajax({
 		type: 'POST',
 		async: true,
 		data: postData,
 		url: "/admin/updatecategory/",
 		dataType: 'json',
 		success: function(data){
 			console.log(data);
 			alert(data['message']);
 		},
 		error: function (request, status, error) {
 			console.log(request.responseText);
 			console.log(status);
 			console.log(error);
 		}
 	});
 }

 function updateOrderStatus(itemId){

 	var status = $('.adminOrders__checkbox[data-id =' + itemId + ']').prop('checked');
 	
 	if(status){
 		status = 1;
 	} else {
 		status = 0;
 	}
 
 	var postData = {itemId: itemId, status: status};

 	$.ajax({
 		type: 'POST',
 		async: true,
 		data: postData,
 		url: "/admin/setorderstatus/",
 		dataType: 'json',
 		success: function(data){
 			if(data['success']){

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


 function updateDatePayment(itemId){


 	var datePayment = $('.adminOrders__inputDate[data-id =' + itemId + ']').val();

 	var postData = {itemId: itemId, datePayment: datePayment};

 	$.ajax({
 		type: 'POST',
 		async: true,
 		data: postData,
 		url: "/admin/setorderdatepayment/",
 		dataType: 'json',
 		success: function(data){
 			if(data['success']){
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

});
