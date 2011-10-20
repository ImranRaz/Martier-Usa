function show_load() {
	jQuery('body').append("<div id='catablog_load_curtain' />");
	jQuery('#catablog_load_curtain').append("<div id='catablog_load_display'>...</div>");
	
	jQuery('#catablog_load_curtain').fadeTo(200, 0.8);
}
function hide_load() {
	setTimeout(function() {
		jQuery('#catablog_load_curtain').fadeOut(400, function() {
			jQuery(this).remove();
		});
	}, 500);
}


function show_image_upload_modal() {
	jQuery('body').append("<div id='catablog_load_curtain' />");
	jQuery('#catablog_load_curtain').append("<div id='catablog_load_display'>...</div>");
	
	jQuery('#catablog_load_curtain').fadeTo(200, 0.8);	
}




function discourage_leaving_page(message) {
	var all_links = jQuery('a').filter(function() {
		return ( jQuery(this).attr('href').charAt(0) != '#' );
	}).filter(function() {
		return (jQuery(this).hasClass('cb_disabled_link') == false);
	});
	
	all_links.bind('click', function(event) {
		if (message == null) {
			message = "you should not leave the page...";
		}
		if(!confirm(message)) {
			return false;
		}
	});
}
function unbind_discourage_leaving_page() {
	var all_links = jQuery('a').filter(function() {
		return ( jQuery(this).attr('href').charAt(0) != '#' );
	});
	
	all_links.unbind('click');
}




function is_integer(s) {
	return (s.toString().search(/^[0-9]+$/) == 0);
}




function enable_save_button() {
	jQuery('#save_changes').attr('disabled', false);
	jQuery('#save_changes').attr('class', 'button-primary');
}

function disable_save_button() {
	jQuery('#save_changes').attr('disabled', true);
	jQuery('#save_changes').attr('class', 'button-disabled');
}



function possibly_disable_save_button() {
	if (jQuery('small.error:visible').size() == 0) {
		jQuery('#save_changes').attr('disabled', false);
		jQuery('#save_changes').attr('class', 'button-primary');
	}
	else {
		jQuery('#save_changes').attr('disabled', true);
		jQuery('#save_changes').attr('class', 'button-disabled');
	}
}



function renderCataBlogItems(images, type, nonce, callback) {
	jQuery('body').ajaxError(function(event, j, a) {
		jQuery('#catablog-console').append('<li class="error">' + j.responseText + '</li>');
		renderCataBlogItem(images.shift(), type, images, nonce, total_count, callback);
	});
	
	total_count = images.length;
	renderCataBlogItem(images.shift(), type, images, nonce, total_count, callback);
}

function renderCataBlogItem(image, type, a, nonce, total_count, callback) {
	var progress_bar  = jQuery('#catablog-progress-' + type + ' .catablog-progress-bar');
	var progress_text = jQuery('#catablog-progress-' + type + ' .catablog-progress-text');
	var percent_complete = 100 - ((a.length / total_count) * 100);
	
	
	var params = {
		'image':    image,
		'type':     type,
		'count':    a.length,
		'total':    total_count,
		'action':   'catablog_render_images',
		'security': nonce
	}
	
	jQuery.post(ajaxurl, params, function(data, textStatus, jqXHR) {
		try {
			data = eval(data);

			var progress_message = data.message;
			progress_text.html(percent_complete.toFixed(1)+'% <small>'+progress_message+'</small>');
			
			if (data.success == false) {
				jQuery('#catablog-console').append('<li class="error">' + data.error + '</li>')
			}
			
		}
		catch(e) {
			jQuery('#catablog-console').append('<li class="error">' + e + '</li>')
		}
		
		if (a.length > 0) {
			progress_bar.css('width', percent_complete + '%');
			renderCataBlogItem(a.shift(), type, a, nonce, total_count, callback);
		}
		else {
			progress_bar.css('width', '100%');
			progress_text.html(progress_message);
			// unbind_discourage_leaving_page();
			callback.call(this);
		}
	});
}










catablog_global_lazyload_elements = null;
	
function calculate_lazy_loads() {
	var scroll_top = jQuery(window).scrollTop();
	var scroll_bottom = scroll_top + jQuery(window).height() - 20;
	
	if (catablog_global_lazyload_elements == null) {
		catablog_global_lazyload_elements = jQuery('#catablog_items a.lazyload');
	}
	

	catablog_global_lazyload_elements.each(function(i) {
		var top_offset = jQuery(this).offset().top;
	
		if (scroll_bottom > top_offset) {
			jQuery(this).removeClass('lazyload');
			jQuery(this).append('<img class="cb_item_icon" />');
			jQuery(this).children('img').hide().attr('src', jQuery(this).attr('rel')).show();
			
			catablog_global_lazyload_elements = catablog_global_lazyload_elements.not(this);
		}
		else {
			return false;
		}
	});
}







function shrink_width(original_width, original_height, thumbnail_width, thumbnail_height) {
	var ratio      = thumbnail_height / original_height;
	var new_width  = original_width * ratio;
	var new_height = thumbnail_height;
	var new_top    = 0;
	var new_left   = ((thumbnail_width - new_width) / 2);;
	
	if (new_width > thumbnail_width) {
		return shrink_height(original_width, original_height, thumbnail_width, thumbnail_height);
	}
	
	return {'top':new_top, 'left':new_left, 'width':new_width, 'height':new_height};
}

function shrink_height(original_width, original_height, thumbnail_width, thumbnail_height) {
	var ratio      = thumbnail_width / original_width;
	var new_width  = thumbnail_width;
	var new_height = original_height * ratio;
	var new_top    = ((thumbnail_height - new_height) / 2);
	var new_left   = 0;
	
	if (new_height > thumbnail_height) {
		return shrink_width(original_width, original_height, thumbnail_width, thumbnail_height);
	}
	
	return {'top':new_top, 'left':new_left, 'width':new_width, 'height':new_height};
}


function crop_width(original_width, original_height, thumbnail_width, thumbnail_height) {
	var ratio      = thumbnail_width / original_width;
	var new_width  = thumbnail_width;
	var new_height = original_height * ratio;
	var new_top    = ((thumbnail_height - new_height) / 2);
	var new_left   = 0;
	
	if (new_height < thumbnail_height) {
		return crop_height(original_width, original_height, thumbnail_width, thumbnail_height);
	}
	
	return {'top':new_top, 'left':new_left, 'width':new_width, 'height':new_height};
}

function crop_height(original_width, original_height, thumbnail_width, thumbnail_height) {
	var ratio      = thumbnail_height / original_height;
	var new_width  = original_width * ratio;
	var new_height = thumbnail_height;
	var new_top    = 0;
	var new_left   = ((thumbnail_width - new_width) / 2);
	
	if (new_width < thumbnail_width) {
		return crop_width(original_width, original_height, thumbnail_width, thumbnail_height);
	}
	
	return {'top':new_top, 'left':new_left, 'width':new_width, 'height':new_height};
}







function replaceSelection (input, replaceString) {
	if (input.setSelectionRange) {
		var selectionStart = input.selectionStart;
		var selectionEnd = input.selectionEnd;
		input.value = input.value.substring(0, selectionStart)+ replaceString + input.value.substring(selectionEnd);

		if (selectionStart != selectionEnd){ 
			setSelectionRange(input, selectionStart, selectionStart + 	replaceString.length);
		}else{
			setSelectionRange(input, selectionStart + replaceString.length, selectionStart + replaceString.length);
		}

	}else if (document.selection) {
		var range = document.selection.createRange();

		if (range.parentElement() == input) {
			var isCollapsed = range.text == '';
			range.text = replaceString;

			 if (!isCollapsed)  {
				range.moveStart('character', -replaceString.length);
				range.select();
			}
		}
	}
}
function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  }
  else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}
