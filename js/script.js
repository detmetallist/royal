$(document).ready(function(){
  var price_min=parseInt($('.price_min').text());
  var price_max=parseInt($('.price_max').text());
  //var price_min_pos=(price_max-price_min)/4+price_min;
  //var price_max_pos=(price_max-price_min)/4*3+price_min;
  var price_min_pos=price_min;
  var price_max_pos=price_max;
  $("#price_ot").val(price_min);
  $("#price_do").val(price_max);
  var totalSq_min=parseInt($('.totalSq_min').text());
  var totalSq_max=parseInt($('.totalSq_max').text());
  //var totalSq_min_pos=(totalSq_max-totalSq_min)/4+totalSq_min;
  //var totalSq_max_pos=(totalSq_max-totalSq_min)/4*3+totalSq_min;
  var totalSq_min_pos=totalSq_min;
  var totalSq_max_pos=totalSq_max;
  $("#ploshad_ot").val(totalSq_min);
  $("#ploshad_do").val(totalSq_max);
  if(get_cookie('valut')==null||get_cookie('valut')=='usd'){
    $('.price_switch a[href="#price_usd"]').addClass('active');
  } else if(get_cookie('valut')=='eur'){
    $('.price_switch a[href="#price_eur"]').addClass('active');
  } else {
    $('.price_switch a[href="#price_uah"]').addClass('active');
  }
  if(get_cookie('arenda_prodazha')=='2'){
    $('#input_radio_rent').prop('checked','checked');
  } else if(get_cookie('arenda_prodazha')=='1'){
    $('#input_radio_sell').prop('checked','checked');
  }
  if(get_cookie('property_type')=='1'){
    $('#input_radio_flats').prop('checked','checked');
  } else if(get_cookie('property_type')=='2'){
    $('#input_radio_houses').prop('checked','checked');
  } else if(get_cookie('property_type')=='3'){
    $('#input_radio_lands').prop('checked','checked');
  } else if(get_cookie('property_type')=='4') {
  	$('#input_radio_commerce').prop('checked','checked');
  }
  if(get_cookie('price_ot')){
  	$('#price_ot').val(get_cookie('price_ot'));
  	price_min_pos=get_cookie('price_ot');
  }
  if(get_cookie('price_do')){
  	$('#price_do').val(get_cookie('price_do'));
  	price_max_pos=get_cookie('price_do');
  }
  if(get_cookie('ploshad_ot')){
  	$('#ploshad_ot').val(get_cookie('ploshad_ot'));
  	totalSq_min_pos=get_cookie('ploshad_ot');
  }
  if(get_cookie('ploshad_do')){
  	$('#ploshad_do').val(get_cookie('ploshad_do'));
  	totalSq_max_pos=get_cookie('ploshad_do');
  }
  if(get_cookie('s_remontom_bez')=='2'){
    $('#bez_remonta').prop('checked','checked');
  } else if(get_cookie('s_remontom_bez')=='1'){
    $('#s_remontom').prop('checked','checked');
  }
  if(get_cookie('order')=='price_high'){
  	$("a[href='#price_high']").addClass('order_price');
  	$("input[name='order']").val('price_high');
  }
  if(get_cookie('order')=='price_low'){
  	$("a[href='#price_low']").addClass('order_price');
  	$("input[name='order']").val('price_low');
  }
  for(i=1; i<=10; i++){
  	if(get_cookie('komnat_'+i)){
  		$("input[name='komnat_"+i+"']").prop('checked','checked');
  	}
  }
  if(get_cookie('penthouse')){
  	$("input[name='penthouse']").prop('checked','checked');
  }
  $('#sidebar_form').submit(function(){
    deleteCookie('arenda_prodazha');
    deleteCookie('property_type');
    deleteCookie('price_ot');
    deleteCookie('price_do');
    deleteCookie('ploshad_ot');
    deleteCookie('ploshad_do');
    deleteCookie('s_remontom_bez');
    deleteCookie('order');
    for(i=1; i<=10; i++){
    	deleteCookie('komnat_'+i);
    }
    deleteCookie('penthouse');
    location.reload();
    return false;
  })
  var loading=0;
  $( "#slider-range_price" ).slider({
      range: true,
      min: price_min,
      max: price_max,
      values: [ price_min_pos, price_max_pos ],
      slide: function( event, ui ) {
      	$("#price_ot").val(ui.values[0]);
      	$("#price_do").val(ui.values[1]);
      	set_cookie('price_ot', ui.values[0], 365);
      	set_cookie('price_do', ui.values[1], 365);
        if(loading==0){
          setTimeout(function(){
            load_page();
            loading=0;
          },500);
        }
        loading=1;
      }
    });
    $("#slider-range_ploshad").slider({
   	  range: true,
      min: totalSq_min,
      max: totalSq_max,
      values: [ totalSq_min_pos, totalSq_max_pos ],
      slide: function( event, ui ) {
      	$("#ploshad_ot").val(ui.values[0]);
      	$("#ploshad_do").val(ui.values[1]);
      	set_cookie('ploshad_ot', ui.values[0], 365);
      	set_cookie('ploshad_do', ui.values[1], 365);
      	if(loading==0){
          setTimeout(function(){
            load_page();
            loading=0;
          },500);
        }
        loading=1;
      }
    })
    $("#slider").owlCarousel({
      loop:true,
      nav:true,
      dots:false,
      margin: 8,
      responsive:{
        800:{
          items:6
        },
        680:{
          items:5
        },
        560:{
          items:4
        },
        440:{
          items:3
        },
        320:{
          items:2
        }
      }
  });
  $(document).on('click','.slide a',function(){
    $('.slide').removeClass('active');
    $(this).parent('.slide').addClass('active');
    $url=$(this).attr("href");
    $('.slider_big_img').html('<div class="color_bg"></div>'+'<img src="'+$url+'">');
    return false;
  })
  $(".menu_button").click(function(){
    $(".mobile_menu").stop().animate({'left':'0'},200);
    $(this).fadeOut(0);
    $(".menu_button_close").fadeIn(0);
  });
  $(".menu_button_close").click(function(){
    $(".mobile_menu").stop().animate({'left':'-236px'},200);
    $(this).fadeOut(0);
    $(".menu_button").fadeIn(0);
  })
  var th = $('#sidebar_form');
  function load_page(){
    $.ajax({
      type: "POST",
      url: "/front/search",
      data: th.serialize(),
      contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
      dataType: 'HTML',
      success: function(data){
        $('.products_content').html(data);
      },
      error: function(xhr, status, error) {
        //alert(xhr.responseText + '|\n' + status + '|\n' +error);
      }
    })
  }
  $("#sidebar_search_form").submit(function(){
  	var thf=$(this)
  	$.ajax({
      type: "POST",
      url: "/front/search_id",
      data: thf.serialize(),
      contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
      dataType: 'HTML',
      success: function(data){
        $('.products_content').html(data);
      },
      error: function(xhr, status, error) {
        //alert(xhr.responseText + '|\n' + status + '|\n' +error);
      }
    })
  	return false;
  })
  load_page();
  $('input[name="orenda_prodazha"]').change(function(){
    set_cookie('arenda_prodazha', $(this).val(), 365);
    load_page();
  })
  $('input[name="s_remontom_bez"]').change(function(){
    set_cookie('s_remontom_bez', $(this).val(), 365);
    load_page();
  })
  $('input[name="property_type"]').change(function(){
  	set_cookie('property_type', $(this).val(), 365);
  	load_page();
  })
  $('input[name="price_ot"]').change(function(){
  	set_cookie('price_ot', $(this).val(), 365);
  	location.reload();
  })
  $('input[name="price_do"]').change(function(){
  	set_cookie('price_do', $(this).val(), 365);
  	location.reload();
  })
  $('input[name="ploshad_ot"]').change(function(){
  	set_cookie('ploshad_ot', $(this).val(), 365);
  	location.reload();
  })
  $('input[name="ploshad_do"]').change(function(){
  	set_cookie('ploshad_do', $(this).val(), 365);
  	location.reload();
  })
  $('.tri_comnati_container input').change(function(){
  	var input_name=$(this).attr('name');
  	if($(this).prop('checked')){
  		set_cookie(input_name,1,365);
  	} else {
  		deleteCookie(input_name);
  	}
  	load_page();
  })
  $("#input_search").submit(function(){
  	$("input[name='search_phrase']").val($("#input_search input[name='search']").val());
  	load_page();
  	return false;
  })
  $("a[href='#price_high']").click(function(){
  	$('.price_order a').removeClass('order_price');
  	$(this).addClass('order_price');
  	set_cookie('order','price_high',365);
  	$("input[name='order']").val('price_high');
  	load_page();
  	return false;
  })
  $("a[href='#price_low']").click(function(){
  	$('.price_order a').removeClass('order_price');
  	$(this).addClass('order_price');
  	set_cookie('order','price_low',365);
  	$("input[name='order']").val('price_low');
  	load_page();
  	return false;
  })
  function get_cookie(cookie_name) {
    var results = document.cookie.match('(^|;) ?' + cookie_name + '=([^;]*)(;|$)');
    if (results) return (unescape(results[2]));
    else return null;
  }
  function set_cookie(name, value, expires_day, domain, secure) {
    var cookie_string = name + "=" + escape(value);
    if (expires_day) {
      var real_date = new Date();
      real_date.setDate(real_date.getDate() + expires_day);
      cookie_string += "; expires=" + real_date.toGMTString();
    }
    cookie_string += "; path=" + escape('/');
    if (domain) cookie_string += "; domain=" + escape(domain);
    if (secure) cookie_string += "; secure";
    document.cookie = cookie_string;
  }
  function deleteCookie(name) {
    set_cookie(name, "", -1)
  }
  if($('.description').length>0){
    $('.description h2, .description h3, .description p, .description ul, .description ol').attr('style','');
  }
  if($('.post_description').length>0){
    $('.post_description h2, .post_description h3, .post_description p, .post_description ul, .post_description ol').attr('style','');
  }
  if($('.news_description').length>0){
    $('.news_description h2, .news_description h3, .news_description p, .news_description ul, .news_description ol, .news_description blockquote').attr('style','');
  }
  if($('span#product_id').length>0){
    if(get_cookie('history_ids')==null){
      set_cookie('history_ids',$('span#product_id').text(),365);
    } else {
      if(get_cookie('history_ids').indexOf('_')=='-1'&&get_cookie('history_ids')!=$('span#product_id').text()){
        set_cookie('history_ids',get_cookie('history_ids')+'_'+$('span#product_id').text(),365);
      } else {
        var count = (get_cookie('history_ids').match(/\_/g) || []).length;
        if(count==1){
          var stroki=get_cookie('history_ids').split(['_']);
          if(stroki[0]!=$('span#product_id').text()&&stroki[1]!=$('span#product_id').text()){
            set_cookie('history_ids',get_cookie('history_ids')+'_'+$('span#product_id').text(),365);
          }
        } else  if(count==2){
          var stroki=get_cookie('history_ids').split(['_']);
          if(stroki[0]!=$('span#product_id').text()&&stroki[1]!=$('span#product_id').text()&&stroki[2]!=$('span#product_id').text()){
            set_cookie('history_ids',get_cookie('history_ids')+'_'+$('span#product_id').text(),365);
          }
        } else {
          var stroki=get_cookie('history_ids').split(['_']);
          if(stroki[0]!=$('span#product_id').text()&&stroki[1]!=$('span#product_id').text()&&stroki[2]!=$('span#product_id').text()&&stroki[3]!=$('span#product_id').text()){
            set_cookie('history_ids',stroki[1]+'_'+stroki[2]+'_'+stroki[3]+'_'+$('span#product_id').text(),365);
          }
        }
      }
    }
  }
  $('.price_switch a').click(function(){
    $('.price_switch a').removeClass('active');
    $(this).addClass('active');
    if($(this).attr('href')=='#price_usd'){
      set_cookie('valut','usd',365);
    } else if($(this).attr('href')=='#price_eur'){
      set_cookie('valut','eur',365);
    } else {
      set_cookie('valut','uah',365);
    }
    deleteCookie('price_ot');
    deleteCookie('price_do');
    location.reload();
    return false;
  })
});