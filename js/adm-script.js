$(document).ready(function(){
	var picture_num_kray=0;
	var picture_num=0;
	var drag_num=0;
	for(i=0; i<$('.picture-block').length; i++){
		if($('.picture-block').eq(i).children('.img-container').html()!=''){
			picture_num_kray=i;
		}
	}
	$.ajax({
		url: "/admin/del_pictures",
		type: "POST",
		contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
		dataType: 'JSON',
		data: {
			'action':'delete',
		},
	})
	$(document).on('click','.picture-block',function(){
		$(".form-pictures input[type='file']").eq(0).trigger('click');
	})
	$(document).on('click','.picture',function(){
		$("input[type='file']").trigger('click');
	})
	$(".form-pictures, .picture").on('dragenter', function (e){
	  	e.preventDefault();
	  	$(this).css('background', 'rgba(0, 0, 0, 0.1)');
	 });

	 $(".form-pictures, .picture").on('dragover', function (e){
	  	e.preventDefault();
	 });
	$(".form-pictures").on('drop', function (e){
  		$(this).css('background', 'none');
	  	e.preventDefault();
	  	var image = e.originalEvent.dataTransfer.files;
	  	createFormData(image);
	});
	$(".picture").on('drop', function (e){
  		$(this).css('background', 'none');
	  	e.preventDefault();
	  	var image = e.originalEvent.dataTransfer.files;
	  	createFormData2(image);
	});

	$(".form-pictures input[type='file']").on('change', function (e){
		var file_val=$(this).val();
		var parts = file_val.split("\\");
		var loc = parts.pop();  
		files = this.files;
		var this_img=$(this);
		event.stopPropagation(); // остановка всех текущих JS событий
		event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега
		// ничего не делаем если files пустой
		if( typeof files == 'undefined' ) return;
		// создадим объект данных формы
		var formImage = new FormData();
		$.each( files, function( key, value ){
			formImage.append( 'userImage', value );
		});
		uploadFormData(formImage);
	})
	$(".picture-group input[type='file']").on('change', function (e){
		var file_val=$(this).val();
		var parts = file_val.split("\\");
		var loc = parts.pop();  
		files = this.files;
		var this_img=$(this);
		event.stopPropagation(); // остановка всех текущих JS событий
		event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега
		// ничего не делаем если files пустой
		if( typeof files == 'undefined' ) return;
		// создадим объект данных формы
		var formImage = new FormData();
		$.each( files, function( key, value ){
			formImage.append( 'userImage', value );
		});
		uploadFormData2(formImage);
	})
	function createFormData(image){
		var formImage = new FormData();
		formImage.append('userImage', image[0]);
		uploadFormData(formImage);
	}
	function uploadFormData(formData) {
		$.ajax({
		 	url: "/admin/upload",
		 	type: "POST",
		 	data: formData,
		 	contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
			dataType: 'JSON',
		 	contentType:false,
		 	cache: false,
		 	processData: false,
		 	success: function(data){
		 		var img_num=0;
		 		var img_kol=$('.form-pictures .picture-block').length;
		 		var img_isset=false;
		 		var img_upload='/uploads/'+data[0];
		 		for(i=0; i<=img_kol; i++){
		 			if(img_upload==$('.img-container').eq(i).children('img').attr('src')){
		 				img_isset=true;
		 			}
		 		}
		 		if(img_isset==false){
		 			while(img_num<=img_kol){
			 			if($('.form-pictures .picture-block').eq(img_num).children('.img-container').html()==''){
			 				$('.form-pictures .picture-block').eq(img_num).children('.img-container').html('<img src="/uploads/'+data[1]+'">');
			 				break;
			 			} 			
			 			img_num++;
			 		}
			 		$('.picture-block .main_picture').fadeIn(0);
			 		//alert('Номер картинки = '+img_num+', количество картинок = '+img_kol);
			 		if(img_num==img_kol-1){
			 			var picture_block_html=$('.picture-block').eq(img_num).html();
			 			$('.form-pictures').append('<div class="picture-block">'+picture_block_html+'</div>');
			 			$('.form-pictures .picture-block').eq(img_kol).children('.img-container').html('');
			 			$('.form-pictures .picture-block').eq(img_kol).css('order',img_kol).attr('data-order',img_kol);
			 		}
			 		picture_num_kray++;
			 		$.ajax({
					 	url: "/admin/add_picture",
					 	type: "POST",
					 	contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
						dataType: 'JSON',
						data: {
							'img0':'/uploads/'+data[0],
							'img1':'/uploads/'+data[1],
							'img2':'/uploads/'+data[2],
							'img3':'/uploads/'+data[3],
							'order':img_num,
						},
					})
		 		}
		  	}
		});
	}
	function createFormData2(image){
		var formImage = new FormData();
		formImage.append('userImage', image[0]);
		uploadFormData2(formImage);
	}
	function uploadFormData2(formData) {
		$.ajax({
		 	url: "/admin/upload",
		 	type: "POST",
		 	data: formData,
		 	contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
			dataType: 'JSON',
		 	contentType:false,
		 	cache: false,
		 	processData: false,
		 	success: function(data){
		 		var img_kol=$('.form-pictures .picture-block').length;
		 		var img_isset=false;
		 		var img_upload='/uploads/'+data[0];
		 		if(img_upload==$('.img-container').children('img').attr('src')){
		 			img_isset=true;
		 		}
		 		if(img_isset==false){
		 			var news_id='0';
					if($("input[name='news_id']").length>0){
						news_id=$("input[name='news_id']").val();
					}
		 			$('.picture').children('.img-container').html('<img src="/uploads/'+data[3]+'">');
			 		$.ajax({
					 	url: "/admin/add_picture_news",
					 	type: "POST",
					 	contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
						dataType: 'JSON',
						data: {
							'img0':'/uploads/'+data[0],
							'img1':'/uploads/'+data[1],
							'img2':'/uploads/'+data[2],
							'img3':'/uploads/'+data[3],
							'news_id':news_id,
						},
					})
		 		}
		  	}
		});
	}
	var peretaskivanie=false;
	$(document).on('dragstart','.picture-block',function(){
		picture_num=picture_num_kray+2;
	})
	$(document).on('dragenter','.picture-block',function(){
		if(picture_num==picture_num_kray+2){
			peretaskivanie=true;
			picture_num=$('.picture-block').index(this);
		}
		if(peretaskivanie==true){
			if($(this).children('.img-container').html()!=''){
				drag_num=$('.picture-block').index(this);
			} else {
				drag_num=picture_num_kray;
			}
			if(picture_num!=drag_num){
				$('.picture-block').eq(picture_num).css('order',drag_num);
				$('.picture-block').eq(drag_num).css('order',picture_num);
				for(i=0; i<=picture_num_kray; i++){
					if($('.picture-block').eq(i).attr('data-order')!=picture_num&&$('.picture-block').eq(i).attr('data-order')!=drag_num){
						var data_order=$('.picture-block').eq(i).attr('data-order');
						$('.picture-block').eq(i).css('order',data_order);
					}
				}
			}
		}
	})
	
	$(document).on('drop','.picture-block',function(){
		if(peretaskivanie==true){
			picture_num=0;
			var pic1_num=0;
			var pic2_num=0;
			var html1='';
			var html2='';
			for(i=0; i<=picture_num_kray; i++){
				if($('.picture-block').eq(i).css('order')!=$('.picture-block').eq(i).attr('data-order')){
					pic1_num=i;
					pic2_num=$('.picture-block').eq(i).css('order');
					html1=$('.picture-block').eq(i).children('.img-container').html();
					html2=$('.picture-block').eq(pic2_num).children('.img-container').html();
					break;
				}
			}
			$('.picture-block[data-order="'+pic1_num+'"]').css('order',pic1_num).children('.img-container').html(html2);
			$('.picture-block[data-order="'+pic2_num+'"]').css('order',pic2_num).children('.img-container').html(html1);
			var estate_id=$('.pictures').attr('data-id');
			$.ajax({
				url: "/admin/order_pictures",
				type: "POST",
				contentType: "application/x-www-form-urlencoded; charset=ISO-8859-1",
				dataType: 'JSON',
				data: {
					'order1':pic1_num,
					'order2':pic2_num,
					'estate_id':estate_id,
				},
			})
			peretaskivanie=false;
		}
	})
	var ckeditor1 = CKEDITOR.replace( 'description' );
    AjexFileManager.init({
	    returnTo: 'ckeditor',
	    editor: ckeditor1
	});
	
	$("a[href='#coords_calc']").click(function(){
		var google_api=$(".google_api").text();
		var adress=$("input[name='country']").val()+' '+$("input[name='oblast']").val()+' '+$("input[name='city']").val()+' '+$("input[name='adress']").val();
		var resultlat = ''; var resultlng = '';
		$.ajax({
			async: false,
			dataType: "json",
			url: 'https://maps.google.com/maps/api/geocode/json?key='+google_api+'&address='+adress,
			success: function(data){
				for (var key in data.results) {
					resultlat = data.results[key].geometry.location.lat;
					resultlng = data.results[key].geometry.location.lng;
					//alert(resultlat+', '+resultlng);
					map=new google.maps.Map(document.getElementById("map"), {
                        center: { lat: resultlat, lng: resultlng },
                        zoom: 17,
                    });
                    var marker = new google.maps.Marker({
					    position: {lat: resultlat, lng: resultlng},
					    map: map,
					});
					$("input[name='coord_x']").val(resultlat);
					$("input[name='coord_y']").val(resultlng);
				} 
			}
		});
		return false;
	})
})