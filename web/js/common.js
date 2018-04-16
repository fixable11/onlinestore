$(function() {

  //Верхний слайдер
	$(".sliderTopOwl").owlCarousel({
		loop:true,
		responsiveClass:false,
		nav:true,
		dots:true,
		navText: ['<svg class="sliderTopOwl__angleLeft"><use xlink:href="/web/img/vectorsprites/fa.svg#angle-left" /></svg>',
		'<svg class="sliderTopOwl__angleRight"><use xlink:href="/web/img/vectorsprites/fa.svg#angle-right" /></svg>'],
		responsive:{
			0:{
				items:1
			},
			1200:{
				items:1
			}
		}
	});

  $(".bestSellersBox__owlWrap").owlCarousel({
      loop:true,
      responsiveClass:false,
      nav:true,
      dots:false,
      navText: ['<svg class="bestSellersBox__angleLeft"><use xlink:href="/web/img/vectorsprites/fa.svg#angle-left" /></svg>',
      '<svg class="bestSellersBox__angleRight"><use xlink:href="/web/img/vectorsprites/fa.svg#angle-right" /></svg>'],
      responsive:{
          0:{
              items:1
          },
          768:{
              items:2
          },
          992:{
              items:3
          },
          1200:{
              items:4
          }
      }
  });

  //Синхронная карусель страницы продукта

  var sync1 = $("#owl-sync");
  var sync2 = $("#for-owl-sync");
  var slidesPerPage = 4; //globaly define number of elements per page
  var syncedSecondary = true;

  sync1.owlCarousel({
    items : 1,
    slideSpeed : 2000,
    nav: false,
    autoplay: false,
    dots: false,
    loop: false,
    responsiveRefreshRate : 200, 
  }).on('changed.owl.carousel', syncPosition);

  sync2
    .on('initialized.owl.carousel', function () {
      sync2.find(".owl-item").eq(0).addClass("current");
    })
    .owlCarousel({
    dots: false,
    nav: true,
    loop: false,
    smartSpeed: 200,
    slideSpeed : 500,
    slideBy: 1, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
    responsiveRefreshRate : 100,
    responsive:{
        0:{
            items:2
        },
        768:{
            items:3
        },
        992:{
            items:3
        },
        1200:{
            items:4
        }
    },
    navText: ['<svg class="productSlider__arrowLeft" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>','<svg class="productSlider__arrowRight" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
  }).on('changed.owl.carousel', syncPosition2);

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    var current = el.item.index;
    console.log(current);
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    //var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find('.owl-item.active').length - 1;
    var start = sync2.find('.owl-item.active').first().index();
    var end = sync2.find('.owl-item.active').last().index();
    
    if (current > end) {
      sync2.data('owl.carousel').to(current, 100, true);
    }
    if (current < start) {
      sync2.data('owl.carousel').to(current - onscreen, 100, true);
    }
  }
  
  function syncPosition2(el) {
    console.log(el.item);
    if(syncedSecondary) {
      var number = el.item.index;
      sync1.data('owl.carousel').to(number, 100, true);
    }
  }
  
  sync2.on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).index();
    sync1.data('owl.carousel').to(number, 300, true);
  });


//OWL SYNC END



//CUSTOM SELECT
	
$('select').each(function(){
    var $this = $(this), numberOfOptions = $(this).children('option').length;
  
    $this.addClass('select-hidden'); 
    $this.wrap('<div class="selectWrap"></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next('div.select-styled');

    if($this.children('option').is(':selected')){
      $styledSelect.text($this.children('option:selected').text());
    } else {
      $styledSelect.text($this.children('option').eq(0).text());
    }
    
  
    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);
  
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            class: 'select-option',
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }
  
    var $listItems = $list.children('li');
  
    $styledSelect.on('click', function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').fadeToggle('slow');
    });
    $('.select-options').on('click', '.select-option', function(e) {

        e.stopPropagation();
         console.log($(this));
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        //console.log($this.val());
    });
  
    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.fadeOut('slow');
    });

});

//CUSTOM SELECT END

$('.accordionCategories__title').on('click', function(event) {
	event.preventDefault();

	$(this).next().slideToggle();
});

$('.loginBox,.popupRegisterBox__autho, .orders__login, .loginBoxMobile-login').on('click', function(e) {
    e.preventDefault();
    $('.popupRegisterBox').hide();
    $('#overlay').fadeIn();
    $('.popupLoginBox').fadeIn();
    $("body").css("overflow", "hidden");
});

$('.registerBox,.popupLoginBox__register, .orders__register').on('click', function(e) {
    e.preventDefault();
    $('.popupLoginBox').hide();
    
    $('#overlay').fadeIn();
    $('.popupRegisterBox').fadeIn();
    $("body").css("overflow", "hidden");
});

$('.basketCart').on('click', function(e) {
    e.preventDefault();
    
    $('#overlay').fadeIn();
    $('.popupBasketCart').fadeIn();
    $("body").css("overflow", "hidden");
});


// OVERLAY
// 
$('#overlay, .popupLoginBox__close,.popupRegisterBox__close, .popupBasketCart__close').on('click', function(e) {
  //e.preventDefault();
    
  if($(this).attr('id') == $(e.target).attr('id')){

    $('.popupLoginBox').fadeOut('400', function() {
     $('#overlay').fadeOut('100');
     $("body").css("overflow-y", "auto");
     $('.popupLoginBox__login,.popupLoginBox__pwd').css('border-color','#b5b5b5').val('');
     $('.popupLoginBox__message').html('');
   });

    $('.popupRegisterBox').fadeOut('400', function() {
      $('#overlay').fadeOut('100');
      $("body").css("overflow-y", "auto");
      $('.popupRegisterBox__login,.popupRegisterBox__pwd1,.popupRegisterBox__pwd2').css('border-color','#b5b5b5').val('');
      $('.popupRegisterBox__message').html('');
    });
    $('.popupBasketCart').fadeOut('400', function() {
      $('#overlay').fadeOut('100');
      $("body").css("overflow-y", "auto");
    });
  }
});

$('.popupBasketCart__content').on('click', '.popupBasketCart__cont', function(event) {
  event.preventDefault();

    $('.popupBasketCart').fadeOut('400', function() {
      $('#overlay').fadeOut('100');
      $("body").css("overflow-y", "auto");
    });

});

// OVERLAY END


//MY MENU 
$("#my-menu").mmenu({
         "extensions": [
            "pagedim-black"
         ],
     }, {
         // configuration
         offCanvas: {
            pageNodetype: ".wrapper"
        }
    });

var API = $("#my-menu").data("mmenu");

$("#my-button").on('click', function() {
    API.open();
});

$icon = $('#my-button');

API.bind("open:finish", function() {
   setTimeout(function() {
      $icon.addClass( "is-active" );
   }, 100);
});

API.bind("close:finish", function() {
   setTimeout(function() {
      $icon.removeClass( "is-active" );
   }, 100);
});

//MY MENU END


//CHOOSE BRAND
//$(".productsSet__brandsCheck").prop( "checked", true );

  var $index = window.location.href.indexOf('filter');
  var $location = window.location.href.substr($index);
  $location = $location.replace(/\//g,' ');
  $location = $location.trim();
  $location = $location.split(' ');
  $location.shift();
  $location.pop();
  
  
  $('.productsSet__brandsLable').each(function(index, el) {
    var $symlink = $(this).attr("data-symlink");

    if(~window.location.href.indexOf($symlink)){

      $(this).find('.productsSet__brandsCheck').prop("checked", true );
    }
  });

 
  //$index = $ss.indexOf('/');
  //$ss = $ss.substr($index);
  
  $('.productsSet__brandsLable').on('change', function(e) {
   var $cat = $(this).attr("data-parentcat");
   var $symlink = $(this).attr("data-symlink");
   var $segment = '';

   $('.productsSet__brandsLable').each(function(index, el) {
     if($(this).find('.productsSet__brandsCheck').prop("checked")){
      $segment += '/' + $(this).attr("data-symlink");
    }
  });
   
  if($(this).find('.productsSet__brandsCheck').prop("checked")){

    if($segment) {
      $segment = '/' + $cat + '/filter' + $segment + '/';
    } else {
      $segment = '/' + $cat + '/filter/' + $symlink + '/';
    } 

  } else {

    if($segment) {
      $segment = '/' + $cat + '/filter' + $segment + '/';
    } else {
      $segment = '/' + $cat + '/';
    }
  }
  console.log($segment);
  window.location.href = $segment;
});



//CHOOSE BRAND END

//AJAX QUERIES
$('.productCart__addWrap, .productAddToCart__add').on('click', function(event) {
  event.preventDefault();
  addToCart($(this).attr("data-id"));
    
});

$('.popupBasketCart__inner').on('click', '.popupBasketCart__itemClose', function(event) {
  event.preventDefault();
  removeFromCart($(this).parent().attr("data-id"));
});

$('.popupRegisterBox__register').on('click', function(event) {
  event.preventDefault();
  var email = $('.popupRegisterBox__login').val();
  var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  var msg = $('.popupRegisterBox__message');
  var pwd1 = $('.popupRegisterBox__pwd1');
  var pwd2 = $('.popupRegisterBox__pwd2');

  if (email.length > 0 && email.match(reg)) {
    registerNewUser($('.popupRegisterBox__form input'));
    $('.popupRegisterBox__login').css('border-color','#b5b5b5');
  } else {
    $('.popupRegisterBox__login').css('border-color','red');
    msg.html('<li class="popupRegisterBox__messageItem">*Введите корректный email</li>');
  }

  if(pwd1.val() == '' || pwd2.val() == ''){
    pwd1.css('border-color','red');
    pwd2.css('border-color','red');
    if(msg.html().trim() === ''){
      msg.html('<li class="popupRegisterBox__messageItem">*Введите пароль</li>');
      msg.append('<li class="popupRegisterBox__messageItem">*Введите повтор пароля</li>');
    } else {
      msg.append('<li class="popupRegisterBox__messageItem">*Введите пароль</li>');
      msg.append('<li class="popupRegisterBox__messageItem">*Введите повтор пароля</li>');
    }
  } 

  if(pwd1.val() != pwd2.val()){
    pwd1.css('border-color','red');
    pwd2.css('border-color','red');
    if(msg.html().trim() === ''){
      msg.html('<li class="popupRegisterBox__messageItem">*Пароли не совпадают</li>');
    } else {
      msg.append('<li class="popupRegisterBox__messageItem">*Пароли не совпадают</li>');
    }
  } 
  
});

$('.popupLoginBox__entrance').on('click', function(event) {
  event.preventDefault();

  login($('.popupLoginBox__form input'));
  
});

$('.userBlock__logout').on('click', function(event) {
  event.preventDefault();
  logout();
});

$('.userBox__logout').on('click', function(event) {
  event.preventDefault();
  logout();
  window.location.href = '/';
});



$('.userBlock__personal').on('click', function(event) {
  event.preventDefault();
  window.location.href = '/user/';
});

$('.userBox__save').on('click', function(event) {
  event.preventDefault();

  updateUserData($('.userBox__tr input, .userBox__tr textarea'));
  
});

$('.orders__pay').on('click', function(event) {
  saveOrder();
});

$('.userOrderBox__showBtn').on('click', function(event) {
    showProducts($(this).attr('data-id'));
});



$('.price__min').on('change', function(event) {
  var max = +$('.price__max').val();
  var min = +$(this).val();
  console.log(min);
  console.log(max);
  var dataMax = +$('.price__max').attr('data-max');
  var dataMin = +$(this).attr('data-min');

  if(min < dataMin){
    $(this).val(dataMin);
  } else if(min > max){
    $(this).val(dataMin);
  } else if(min < dataMax){
    $(this).val(min);
  }

  if(!Number.isInteger(min)){
    $(this).val(dataMin);
  }

});

$('.price__max').on('change', function(event) {
  var max = +$(this).val();
  var min = +$('.price__min').val();
  
  var dataMax = +$(this).attr('data-max');
  var dataMin = +$('.price__min').attr('data-min');

  if(max < dataMin){
    $(this).val(dataMin);
  } else if(max < min){
    $(this).val(min);
  } else if(max > dataMax){
    $(this).val(dataMax);
  }
  if(!Number.isInteger(max)){
    $(this).val(dataMax);
  }


});

$('.price__ok').on('click', function(event) {
  var min = $('.price__min').val();
  var max = $('.price__max').val();
  min = parseInt(min);
  max = parseInt(max);
  if(!isNaN(min) && !isNaN(max)){
    var location = window.location.href;
    var reg = /price=[0-9]+-[0-9]+\/(p-[0-9]+)?\/?$/;
    //var reg2 = /(https?):\/\/([a-z]+:?[0-9]*)\/([a-z]+)/;
    var reg2 = /\/([a-z]+)\/filter\/(([a-z]+\/?)+\/?)/;
    var str2 = '/$1/' + 'price=' + min + '-' + max + '/filter/$2';
    var reg3 = /\/([a-z]+)\/price=[0-9]+-[0-9]+\/filter\/(((([a-z]+\/?)+\/)(p-[0-9]+)\/?)|(([a-z]+\/?)+\/?))/;
    var str3 = '/$1/' + 'price=' + min + '-' + max + '/filter/$4';
    var str4 = '/$1/' + 'price=' + min + '-' + max + '/filter/$2';
    
    if(location.match(reg)){
     window.location.href = location.replace(reg, 'price=' + min + '-' + max + '/');

    } else {
      if(location.search(/filter/) != -1){

        if(location.match(reg2)){
          window.location.href = location.replace(reg2, str2);
        } else {
          if(location.search(/p-[0-9]+/) != -1){
            window.location.href = location.replace(reg3, str3);
          } else {
            window.location.href = location.replace(reg3, str4);
          }       
        }
        
      } else {

        if(location.search(/p-[0-9]+/) != -1){
          window.location.href = location.replace(/p-[0-9]+\//, '') + 'price=' + min + '-' + max + '/';
        } else {
          window.location.href = location + 'price=' + min + '-' + max + '/';
        }
      }
      
    }
  }
});



// AJAX JUNCTIONS

function addToCart (itemId) {

  $.ajax({
    type: 'POST',
    async: true,
    url: "/cart/addtocart/" + itemId + "/",
    dataType: 'json',
    success: function(data){
      console.log(data);
      
      if(data['success']){
        $('.basketCart__amount').text(data['cntItems']);
        var trigger = $('.productAddToCart__add[data-id=' + itemId + ']').addClass('productAddToCart__add-active');
        console.log(trigger);
        if(trigger.length == 0){
          $('.productCart__addWrap').each(function(index, el) {
            console.log(123);
            if($(el).attr("data-id") == itemId){
              $(el).addClass('productCart__addWrap-active');
              $html = '<div class="popupBasketCart__item" data-id="' + data['id'] + '"><a href="/product/' + data['id'] + '/" class="popupBasketCart__itemImgWrap"><img src="/web/img/products/' + data['image'] + '" alt="cart_img" class="popupBasketCart__itemImg"></a><h4 class="popupBasketCart__itemName">' + data['name'] + '</h4><div class="popupBasketCart__itemPrice" data-id="' + data['id'] + '" data-price="' + data['price'] + '">' + data['price'] + ' грн</div><div class="popupBasketCart__itemAmountBox"><button class="popupBasketCart__itemAmountLess" data-id="' + data['id'] + '">-</button><div class="popupBasketCart__itemAmountWrap"><input type="text" maxlength="2" name="itemCnt_'+data['id']+'" class="popupBasketCart__itemAmount" value="1" data-id="' + data['id'] + '"> шт.</div><button class="popupBasketCart__itemAmountMore" data-id="' + data['id'] + '">+</button></div><div class="popupBasketCart__itemRealPrice" data-id="' + data['id'] + '">' + data['price'] + ' грн</div><button class="popupBasketCart__itemClose"><svg class="popupBasketCart__itemCloseImg"><use xlink:href="/web/img/vectorsprites/fa.svg#times" /></svg></button> </div>';
              $('.popupBasketCart__empty').remove();
              $('.popupBasketCart__inner').append($html);

              if(!$('.popupBasketCart__buttons').has('a').length){
                $('.popupBasketCart__buttons').append('<a href="#" class="popupBasketCart__cont">Продолжить покупки</a>').append('<button type="submit" class="popupBasketCart__checkout">Оформить заказ</button>');
              }
              $('.popupBasketCart').fadeIn();
              $('#overlay').fadeIn();
              $("body").css("overflow", "hidden");   
            }
          });
        } else {
         $html = '<div class="popupBasketCart__item" data-id="' + data['id'] + '"><a href="/product/' + data['id'] + '/" class="popupBasketCart__itemImgWrap"><img src="/web/img/products/' + data['image'] + '" alt="cart_img" class="popupBasketCart__itemImg"></a><h4 class="popupBasketCart__itemName">' + data['name'] + '</h4><div class="popupBasketCart__itemPrice" data-id="' + data['id'] + '" data-price="' + data['price'] + '">' + data['price'] + ' грн</div><div class="popupBasketCart__itemAmountBox"><button class="popupBasketCart__itemAmountLess" data-id="' + data['id'] + '">-</button><div class="popupBasketCart__itemAmountWrap"><input type="text" maxlength="2" name="amount" class="popupBasketCart__itemAmount" value="1" data-id="' + data['id'] + '"> шт.</div><button class="popupBasketCart__itemAmountMore" data-id="' + data['id'] + '">+</button></div><div class="popupBasketCart__itemRealPrice" data-id="' + data['id'] + '">' + data['price'] + ' грн</div><button class="popupBasketCart__itemClose"><svg class="popupBasketCart__itemCloseImg"><use xlink:href="/web/img/vectorsprites/fa.svg#times" /></svg></button> </div>';
         $('.popupBasketCart__empty').remove();
         $('.popupBasketCart__inner').append($html);

         if(!$('.popupBasketCart__buttons').has('a').length){
          $('.popupBasketCart__buttons').append('<a href="#" class="popupBasketCart__cont">Продолжить покупки</a>').append('<button type="submit" class="popupBasketCart__checkout">Оформить заказ</button>');
         }
        $('.popupBasketCart').fadeIn();
         $('#overlay').fadeIn();
          $("body").css("overflow", "hidden");
          $('.productAddToCart__text').text('Товар добавлен в');
        }

          //$(this).addClass('productCart__addWrap-active');
        

        console.log(data);
        
        //$('#removeCart_' + itemId).show();
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
 
  $.ajax({
    type: 'POST',
    async: true,
    url: "/cart/removefromcart/" + itemId + "/",
    dataType: 'json',
    success: function(data){
      console.log(data);
      
      if(data['success']){
        $('.basketCart__amount').text(data['cntItems']);
        $('.productAddToCart__add').removeClass('productAddToCart__add-active');
        $('.productAddToCart__text').text('Добавить в');
        $('.productCart__addWrap').each(function(index, el) {
          if($(el).attr("data-id") == itemId){
            $(el).removeClass('productCart__addWrap-active');  
          }
        });
        $('.popupBasketCart__inner').each(function(index, el) {
         $('.popupBasketCart__item[data-id="' + itemId + '"]').remove();  
         if($('.popupBasketCart__item').length == 0){
          if(!$('.popupBasketCart__empty').length){
            $('.popupBasketCart__inner').append('<h4 class="popupBasketCart__empty">Ваша корзина пуста.</h4>');
          }
          
          $('.popupBasketCart__checkout').remove();
          $('.popupBasketCart__cont').remove();
        }  
      });
      }
    },
    error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
    }
  });
}

function registerNewUser(dataObj) {
  postData = {};
  dataObj.each(function(index, el) {
    name = $(el).attr('name');
    val = $(el).val();
    postData[name] = val;
  });

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
        $('.registerBlock').removeClass('d-flex');
        $('.registerBlock').addClass('d-none');
        $('.userBlock').removeClass('d-none');
        $('.userBlock').addClass('d-flex');
        $('.popupRegisterBox__form input').css('border-color','#b5b5b5');
        $('.popupRegisterBox').fadeOut();
        $('#overlay').fadeOut();
        $('.popupRegisterBox__form input').each(function(index, el) {
          $(el).val('');
        });
        $("body").css("overflow-y", "auto");
        $('.popupRegisterBox__message').html('');

        if($('.orders__autho').length != 0){
          $('.orders__autho').hide();
          if(!data['name']) data['name'] = ''; 
          if(!data['phone']) data['phone'] = ''; 
          if(!data['address']) data['address'] = ''; 
          var $html = '<h3 class="orders__userTitle">Данные заказчика</h3><div class="orders__infoBox"><table class="orders__infoTable infoTable"><tr class="infoTable__tr"><td class="infoTable__td infoTable__td-first">ФИО</td><td class="infoTable__td infoTable__td-last"><input type="text" name="fio" class="infoTable__input infoTable__fio" value="'+data['name']+'"></td></tr><tr class="infoTable__tr"> <td class="infoTable__td infoTable__td-first">Телефон</td><td class="infoTable__td infoTable__td-last"><input type="text" name="phone" class="infoTable__input infoTable__phone" value="'+data['phone']+'"></td></tr><tr class="infoTable__tr"><td class="infoTable__td infoTable__td-first">Адрес</td><td class="infoTable__td infoTable__td-last"><textarea name="address" class="infoTable__textarea infoTable__address">'+data['address']+'</textarea></td></tr></table></div>';
          $('.orders__totalLeft').append($html);
          $('.orders__pay').removeClass('orders__pay-inactive');
        }

      } else {
        var regBox = $('.popupRegisterBox__message');
        if(regBox.html().trim() !== '') {
          regBox.html('');
        }
        data['message'].forEach(function(element, index) {
          regBox.append('<li class="popupRegisterBox__messageItem">' + element + '</li>');
        });
        
      }
    },
    error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
    }
  });
}

function login(dataObj){
  postData = {};
  dataObj.each(function(index, el) {
    name = $(el).attr('name');
    val = $(el).val();
    postData[name] = val;
  });

  $.ajax({
    type: 'POST',
    async: true,
    data: postData,
    url: "/user/login/",
    dataType: 'json',
    success: function(data){
      console.log(data);
      if(data['success']){
        $('.popupLoginBox__login,.popupLoginBox__pwd').css('border-color','#b5b5b5');
        $('.registerBlock').removeClass('d-flex');
        $('.registerBlock').addClass('d-none');
        $('.userBlock').removeClass('d-none');
        $('.userBlock').addClass('d-flex');
        $('.popupLoginBox').fadeOut();
        $('#overlay').fadeOut();
        $('.popupLoginBox__form input').each(function(index, el) {
          $(el).val('');
        });
        $("body").css("overflow-y", "auto");

        if($('.orders__autho').length != 0){
          $('.orders__autho').hide();
          var $html = '<h3 class="orders__userTitle">Данные заказчика</h3><div class="orders__infoBox"><table class="orders__infoTable infoTable"><tr class="infoTable__tr"><td class="infoTable__td infoTable__td-first">ФИО</td><td class="infoTable__td infoTable__td-last"><input type="text" name="fio" class="infoTable__input infoTable__fio" value="'+data['name']+'"></td></tr><tr class="infoTable__tr"> <td class="infoTable__td infoTable__td-first">Телефон</td><td class="infoTable__td infoTable__td-last"><input type="text" name="phone" class="infoTable__input infoTable__phone" value="'+data['phone']+'"></td></tr><tr class="infoTable__tr"><td class="infoTable__td infoTable__td-first">Адрес</td><td class="infoTable__td infoTable__td-last"><textarea name="address" class="infoTable__textarea infoTable__address">'+data['address']+'</textarea></td></tr></table></div>';
          $('.orders__totalLeft').append($html);
          $('.orders__pay').removeClass('orders__pay-inactive');
        }

        $('.registerBlockMobile').html('<a href="/user/" class="loginBoxMobile loginBoxMobile-unlogin"><svg class="loginBoxMobile__user"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/web/img/vectorsprites/fa.svg#user"></use></svg></a>')

      } else {
        var regBox = $('.popupLoginBox__message');
        $('.popupLoginBox__login,.popupLoginBox__pwd').css('border-color','red');
        data['message'].forEach(function(element, index) {
          regBox.html('<li class="popupLoginBox__messageItem">' + element + '</li>');
        });
      }
    },
    error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
    }
  });
}


function logout() {

  $.ajax({
    type: 'POST',
    async: true,
    url: "/user/logout/",
    dataType: 'json',
    success: function(data){
      console.log(data);
      if(data['success']){
        $('.userBlock').removeClass('d-flex');
        $('.userBlock').addClass('d-none');
        $('.registerBlock').removeClass('d-none');
        $('.registerBlock').addClass('d-flex');

        if($('.orders__totalLeft').length != 0){
          $('.orders__userTitle').remove();
          $('.orders__infoBox').remove();
          $('.orders__autho').fadeIn();
          $('.orders__pay').addClass('orders__pay-inactive');
        }

      } 
    },
    error: function (request, status, error) {
            console.log(request.responseText);
            console.log(status);
            console.log(error);
    }
  });
}

  function updateUserData(dataObj) {
    postData = {};
    dataObj.each(function(index, el) {
      name = $(el).attr('name');
      val = $(el).val();
      postData[name] = val;
    });

    console.log(postData);
    
    $.ajax({
      type: 'POST',
      async: true,
      data: postData,
      url: "/user/update/",
      dataType: 'json',
      success: function(data){
        console.log(data);
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

  function saveOrder(){
    var fio = $('.infoTable__fio').val();
    var phone = $('.infoTable__phone').val();
    var address = $('.infoTable__address').val();
    var postData = {fio: fio, phone: phone, address: address};

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

//AJAX QUERIES END

$('.popupBasketCart__inner').on('click','.popupBasketCart__itemAmountMore', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var itemId = $(this).attr("data-id");
    var inp = $('.popupBasketCart__itemAmount[data-id="' + itemId + '"]');
    amount = +inp.val() + 1;
    if(amount){
      inp.val(amount);
      conversationPrice(itemId);
    }
});

$('.popupBasketCart__inner').on('click', '.popupBasketCart__itemAmountLess', function(event) {
    event.preventDefault();
    event.stopPropagation();
    var itemId = $(this).attr("data-id");
    var inp = $('.popupBasketCart__itemAmount[data-id="' + itemId + '"]');
    amount = +inp.val() - 1;
    if(amount){
      inp.val(amount);
      conversationPrice(itemId);
    }
});

$('.popupBasketCart__itemAmount').on('change', function(event) {
  
  conversationPrice($(this).attr("data-id"));
  
});


function conversationPrice(itemId){
  var newCnt = $('.popupBasketCart__itemAmount[data-id="' + itemId + '"]').val();
  var itemPrice = $('.popupBasketCart__itemPrice[data-id="' + itemId + '"]').attr("data-price");
  var itemRealPrice = newCnt * itemPrice;
  if(itemRealPrice){
    $('.popupBasketCart__itemRealPrice[data-id="' + itemId + '"]').text(itemRealPrice + ' грн');
  }
}

function showProducts(id){
  $('.userOrderBox__tr[data-id=' + id + ']').fadeToggle();
}

});


