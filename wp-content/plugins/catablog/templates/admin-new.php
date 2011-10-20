<div class="wrap">
	
	<div id="icon-catablog" class="icon32"><br /></div>
	<h2><?php _e("Add New CataBlog Entry", "catablog") ?></h2>
	
	<?php $this->render_catablog_admin_message() ?>
	
	<form id="catablog-create" class="catablog-form clear_float" method="post" action="admin.php?page=catablog-create" enctype="multipart/form-data">
		
		<div id="upload-form-left-col">
			
			<div id="dynamic_title">
				<h3><strong><?php _e("Upload An Image To Create A New Catalog Item", "catablog"); ?></strong></h3>
				<h3 class="hide"><strong><?php _e("Upload Multiple Images", "catablog"); ?></strong></h3>
			</div>

			<div id="select_images_form">
				<div id="upload_buttons">
					<input type="file" id="new_image" name="new_image"  />
					<?php wp_nonce_field( 'catablog_create', '_catablog_create_nonce', false, true ) ?>
					<input type="submit" name="save" value="<?php _e("Upload", "catablog") ?>" class="button-primary" />
					<p class="error"><?php _e("Flash upload was not enabled because either JavaScript is disabled or your version of Flash is too old.", "catablog")?></p>
				</div>

				<p><?php printf(__("Maximum upload file size: %sB", "catablog"), ini_get('upload_max_filesize')); ?></p>

				<p><small>
					<?php _e("Select images on your computer to upload and make new catalog items with.", "catablog"); ?><br />
					<?php _e("You may upload JPEG, GIF and PNG graphic formats only.", "catablog"); ?><br />
					<strong><?php _e("No animated GIFs please.", "catablog"); ?></strong>
				</small></p>
			</div>
<?php /*
			<h3><strong><?php _e("Choose Categories","catablog") ?></strong></h3>
			<ul id="catablog-category-checklist" class="list:category categorychecklist form-no-clear">

				<?php $categories = $this->get_terms() ?>
				<?php $result = new CataBlogItem() ?>
				<?php ?>

				<?php if (count($categories) < 1): ?>
					<li><span><?php _e("You currently have no categories.", 'catablog'); ?></span></li>
				<?php endif ?>

				<?php foreach ($categories as $category): ?>
				<li>
					<label class="catablog-category-row">
						<?php $checked = (in_array($category->term_id, array_keys($result->getCategories())))? 'checked="checked"' : '' ?>
						<input id="in-category-<?php echo $category->term_id ?>" type="checkbox" <?php echo $checked ?> name="categories[]"  value="<?php echo $category->term_id ?>" />
						<?php $default_term = $this->get_default_term() ?>
						<?php if ($category->name != $default_term->name): ?>
							<a href="#delete" class="catablog-category-delete hide"><small><?php _e("[DELETE]", 'catablog'); ?></small></a>
						<?php endif ?>
						<span><?php echo $category->name ?></span>

					</label>
				</li>
				<?php endforeach ?>
			</ul>
			<p><small><?php _e("Check the categories you wish all new catalog items to be put into.", "catablog") ?></small></p>
*/ ?>
		</div>
		
		<div id="upload-form-right-col" class="hide">
			<div id="upload-feedback">
				<p><?php printf(__('currently uploading %s of %s', 'catablog'), '<strong id="current_number"></strong>', '<strong id="total_number"></strong>') ?></p>
				<div id="catablog-progress-current-upload" class="catablog-progress">
					<div class="catablog-progress-bar"></div>
					<small class="catablog-progress-text">&nbsp;</small>
				</div>
				<div id="catablog-progress-all-uploads" class="catablog-progress">
					<div class="catablog-progress-bar"></div>
					<small class="catablog-progress-text">&nbsp;</small>
				</div>
			</div>
			<ul id="new-items-editor"></ul>
		</div>
		
	</form>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		flash_version = swfobject.getFlashPlayerVersion();
		if (flash_version.major < 10) {
			return false;
		}
		
		swfu = new SWFUpload({
			upload_url : "<?php echo $this->urls['plugin'] . '/lib/catablog.upload.php' ?>",
			flash_url : "<?php echo includes_url('js/swfupload/swfupload.swf'); ?>",
		
			file_types : "*.jpg;*.jpeg;*.gif;*.png",
			file_type_description: "Web Image Files",
			file_size_limit : "<?php printf('%sB', ini_get('upload_max_filesize')) ?>",
		
			button_placeholder_id : 'upload_buttons',
			button_image_url : "<?php echo includes_url('images/upload.png'); ?>",
			button_width : 132,
			button_height: 23,
			button_text : '<span class="button"><?php _e("Select Images", "catablog") ?></span>',
			button_text_style : ".button { text-align:center; font-weight:bold; font-family:'Lucida Grande',Verdana,Arial,'Bitstream Vera Sans',sans-serif; font-size:10px; text-shadow: 0 1px 0 #FFFFFF; color:#464646;}",
			button_text_top_padding: 3,
			button_cursor: SWFUpload.CURSOR.HAND,
		
			post_params : {
				"auth_cookie" : "<?php echo (is_ssl() ? $_COOKIE[SECURE_AUTH_COOKIE] : $_COOKIE[AUTH_COOKIE]); ?>",
	               "logged_in_cookie": "<?php echo $_COOKIE[LOGGED_IN_COOKIE]; ?>",
	               "_wpnonce" : "<?php echo wp_create_nonce('catablog_swfupload'); ?>",
				"categories" : [],
			},
		
			swfupload_loaded_handler : catablog_swfupload_loaded,
			
			file_dialog_complete_handler : catablog_swfupload_file_dialog_complete,
			
			file_queued_handler : catablog_swfupload_file_queued,
			file_queued_error_handler : catablog_swfupload_file_queued_error,
			upload_start_handler : catablog_swfupload_upload_start,
			upload_progress_handler : catablog_swfupload_upload_progress,
			upload_error_handler : catablog_swfupload_upload_error,
			upload_success_handler : catablog_swfupload_upload_success,
			upload_complete_handler : catablog_swfupload_upload_complete,
		});
		
		var to_show = jQuery('#dynamic_title h3:hidden');
		var to_hide = jQuery('#dynamic_title h3:visible');

		to_show.show();
		to_hide.hide();

		jQuery('#upload-form-left-col').addClass('left-col');
		jQuery('#upload-form-right-col').addClass('right-col');
	});

	function catablog_micro_save(event) {
		if (event.type == "keypress") {
			var key_code = (event.keyCode ? event.keyCode : event.which);
			if (key_code != 13) {
				return true;
			}
		}
	
		if (this.disabled) {
			return false;
		}
	
		var container   = jQuery(this).closest('li');
		var button      = container.find('input.button-primary');
		var title       = container.find('input.title').val();
		var description = container.find('textarea.description').val();
		var item_id     = container.find('input.id').val();
	
		container.find('input').attr('readonly', true);
		container.find('textarea').attr('readonly', true);
		container.next('li').find('input.title').focus().select();
		
		button.attr('disabled', true);
		button.addClass('button button-disabled').removeClass('button-primary');
		button.after('<span class="ajax-save">&nbsp;</span>');
	
		var params = {
			'action':   'catablog_micro_save',
			'security': '<?php echo wp_create_nonce("catablog-micro-save") ?>',
			'id' : item_id,
			'title' : title,
			'description': description
		}
	
		jQuery.post(ajaxurl, params, function(data) {
			try {
				var json = eval(data);
				if (json.success == false) {
					alert(json.message);
				}
				
				container.hide(800, function() {
					jQuery(this).remove();
				});
			}
			catch(error) {
				alert(error);
			}
		});					
	
		return false;
	}
		

</script>