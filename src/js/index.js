
$(document).ready(function(){

	const 
	$input_1 = $('.INPUT_1'), 
	$con_INPUT_1 = $('.con_INPUT_1');



	$input_1.on('input',function(e){
	    if(e.target.value.length > 3){
	    	sendRequest__GET(e.target.value, function(data){
	    		setItemToList(data);
	    	});
	    }else{
	    	clearItemInput();
	    }
	});


	$input_1.on('focusout',function(e){
		if ($('.con_INPUT_1:hover').length != 0) {
		}else{
			clearItemInput();
		}
	});



    function onClick__item(){
		$('.INPUT_1__item').on('click',function(e){
		    $input_1.val(e.target.innerText);
		    clearItemInput();
		});
    }



	function setItemToList(arr){
		var el_html = '<div class="INPUT_1__elements">';

		jQuery.each(arr, function(index, item) {
		    if(index > 5){
		    	return;
		    }

		    // escapeHtml() <--- There escape no need
		    el_html = el_html+'<div class="INPUT_1__item">'+item+'</div>';
		});	

		el_html = el_html+"</div>";	

		$con_INPUT_1.html(el_html);
		onClick__item();
	}



	function sendRequest__GET(word, callback){
		const url = 'http://'+window.location.hostname+'/api/v1/hintword?word='+word

		$.get(url, function(result, status){
		    if(status === "success"){
		    	result = JSON.parse(result);
		    	console.log(result.data);
		    	if(result.status == "200"){
		    	   callback(result.data);
		    	   return;
		    	}
		    	// Not realized
		    }

		    callback(false);
		    return;
		});		
	}


	function clearItemInput(){
		$con_INPUT_1.html("");
	}




	var entityMap = {
	  '&': '&amp;',
	  '<': '&lt;',
	  '>': '&gt;',
	  '"': '&quot;',
	  "'": '&#39;',
	  '/': '&#x2F;',
	  '`': '&#x60;',
	  '=': '&#x3D;'
	};

	function escapeHtml(string) {
	  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
	    return entityMap[s];
	  });
	}

});



