<div class="wrap">
	
	<div id="icon-catablog" class="icon32"><br /></div>
	<h2><?php _e("CataBlog Options", "catablog"); ?></h2>
	
	<noscript>
		<div class="error">
			<strong><?php _e("You must have a JavaScript enabled browser to change the CataBlog options.", "catablog"); ?></strong>
		</div>
	</noscript>
	
	<?php $this->render_catablog_admin_message() ?>
	
	<?php if ($recalculate_thumbnails): ?>
		<div id="catablog-progress-thumbnail" class="catablog-progress">
			<div class="catablog-progress-bar"></div>
			<h3 class="catablog-progress-text"><?php _e("Processing Thumbnail Images...", "catablog"); ?></h3>
		</div>
	<?php endif ?>
	
	<?php if ($recalculate_fullsize): ?>
		<div id="catablog-progress-fullsize" class="catablog-progress">
			<div class="catablog-progress-bar"></div>
			<h3 class="catablog-progress-text"><?php _e("Waiting For LightBox Rendering To Finish...", "catablog"); ?></h3>
		</div>
	<?php endif ?>
	
	<?php if ($recalculate_thumbnails || $recalculate_fullsize): ?>
		<ul id="catablog-console" class="catablog-console-mini"></ul>
	<?php endif ?>
	
	<form action="admin.php?page=catablog-options" id="catablog-options" class="catablog-form" method="post">
		
		<ul id="catablog-options-menu">
			<li><a href="#thumbnails" title="Set size and how thumbnails will be made"><?php _e("Thumbnails", "catablog"); ?></a></li>
			<li><a href="#lightbox" title=""><?php _e("LightBox", "catablog"); ?></a></li>
			<li><a href="#public" title=""><?php _e("Public", "catablog"); ?></a></li>
			<li><a href="#title" title=""><?php _e("Title", "catablog"); ?></a></li>
			<li><a href="#description" title=""><?php _e("Description", "catablog"); ?></a></li>
			<li><a href="#template" title="Control how your catalog is rendered"><?php _e("Template", "catablog"); ?></a></li>
			<li><a href="#store" title=""><?php _e("Store", "catablog"); ?></a></li>
			<li><a id="catablog-options-menu-export" href="#export" title=""><?php _e("Export", "catablog"); ?></a></li>
			<li><a href="#import" title=""><?php _e("Import", "catablog"); ?></a></li>
			<li><a id="catablog-options-menu-system" href="#system" title=""><?php _e("Systems", "catablog"); ?></a></li>
		</ul>
		
		
		<?php /*  THUMBNAIL SETTINGS PANEL */ ?>
		<div id="catablog-options-thumbnails" class="catablog-options-panel">
			<p>
				<label for='thumbnail_width'><?php _e("Thumbnail Width:", "catablog"); ?></label>
				<input type='text' name='thumbnail_width' id='thumbnail_width' class='integer_field' size='5' value='<?php echo $thumbnail_width ?>' />
				<span><?php _e("pixels", "catablog"); ?></span><br />
				
				<small class="error hidden"><?php _e("Your thumbnail width must be a positive integer.", "catablog"); ?><br /></small>
				<small><?php _e("this will change the thumbnail width of all your catalog items.", "catablog"); ?></small>
			</p>
			<p>
				<label for='thumbnail_height'><?php _e("Thumbnail Height:", "catablog"); ?></label>
				<input type='text' name='thumbnail_height' id='thumbnail_height' class='integer_field' size='5' value='<?php echo $thumbnail_height ?>' />
				<span><?php _e("pixels", "catablog"); ?></span><br />
				
				<small class="error hidden"><?php _e("Your thumbnail height must be a positive integer.", "catablog"); ?><br /></small>
				<small><?php _e("this will change the thumbnail height of all your catalog items.", "catablog"); ?></small>
			</p>
			<p>
				<?php $checked = ($keep_aspect_ratio)? "checked='checked'" : "" ?>
				<label for="keep_aspect_ratio"><?php _e("Keep Aspect Ratio:", "catablog"); ?></label>
				<input type="checkbox" name="keep_aspect_ratio" id="keep_aspect_ratio" <?php echo $checked ?> />
				<br />
				<small><?php _e("this will keep the aspect ratio of the original image in your thumbnails, using the background color to fill in the empty space.", "catablog"); ?></small>
			</p>
			<p>
				<label><?php _e("Thumbnail Background Color:", "catablog"); ?></label>
				<input type="text" name="bg_color" id="bg_color" size="8" maxlength="7" value="<?php echo $background_color ?>" />
				<span class="color-swatch hide-if-no-js">&nbsp;</span>
				<small><a class="hide-if-no-js" href="#" id="pickcolor"><?php _e('Select a Color', 'catablog'); ?></a></small>
			</p>
			<div id="color-picker-div">&nbsp;</div>
			<hr />
			<div>
				<label><?php _e("Thumbnail Preview", "catablog"); ?></label>
				<p id="thumbnail_preview">
					<span id='demo_box' class='demo_box' style='width:<?php echo $thumbnail_width ?>px; height:<?php echo $thumbnail_height ?>px;'>&nbsp;</span>
				</p>
			</div>
		</div>
		
		
		
		<?php /*  LIGHTBOX SETTINGS PANEL  */ ?>
		<div id="catablog-options-lightbox" class="catablog-options-panel hide">
			<p>
				<?php $checked = ($lightbox_enabled)? "checked='checked'" : "" ?>
				<label for="lightbox_enabled"><?php _e("Enable LightBox:", "catablog"); ?></label>
				<input type="checkbox" name="lightbox_enabled" id="lightbox_enabled" <?php echo $checked ?> /><br/>
				<small><?php _e("Load the necessary javascript libraries to enlarge an image thumbnail with the LightBox effect.", "catablog"); ?></small>
			</p>
			
			<p>
				<?php $checked = ($lightbox_render)? "checked='checked'" : "" ?>
				<label for="lightbox_render"><?php _e("Render a new image to be used for the lightbox:", "catablog"); ?></label>
				<input type="checkbox" name="lightbox_render" id="lightbox_render" <?php echo $checked ?> /><br />
				<small><?php _e("check this box to render a similarly sized image for each catalog item to be used with the LightBox.", "catablog")?></small>
			</p>
			
			<p>
				<label for='lightbox_image_size'><?php _e("LightBox Size:", "catablog"); ?></label>
				<input type='text' name='lightbox_image_size' id='lightbox_image_size' class='integer_field' size='5' value='<?php echo $lightbox_size ?>' />
				<span><?php _e("pixels", "catablog"); ?></span><br />
				<small class="error hidden"><?php _e("Your lightbox size must be a positive integer.", "catablog"); ?><br /></small>
				<small><?php _e("This is the maximum length of either the height or width, depending on whichever is longer in the original uploaded image.", "catablog") ?></small>
			</p>
			
			<p>
				<label for='lightbox_selector'><?php _e("LightBox jQuery Selector:", "catablog"); ?></label>
				<input type='text' name='lightbox_selector' id='lightbox_selector' class='' size='50' value='<?php echo $lightbox_selector ?>' />
				<br />
				<small><?php _e("This lets you modify the selector used by jQuery to attach the LightBox to image thumbnails. The default value is: .catablog-image", "catablog") ?></small>
			</p>
		</div>
		
		
			   
			     
			      
			        
		
		<?php /*  PUBLIC SETTINGS PANEL  */ ?>
		<div id="catablog-options-public" class="catablog-options-panel hide">
			<p>
				<?php $checked = ($public_posts_enabled)? "checked='checked'" : "" ?>
				<label for="public_posts"><?php _e("Enable Individual Pages and Category Archives:", "catablog"); ?></label>
				<input type="checkbox" name="public_posts" id="public_posts" <?php echo $checked ?> /><br/>
				<small><?php _e("If this is checked, each and every catalog item will get its very own page, complete with permalink.", "catablog") ?></small><br />
				<small><?php _e("Also, each CataBlog Category will have their own archive page automatically generated.", "catablog") ?></small><br />
				<small><?php printf(__("These CataBlog Category pages can easily be added to your %sMenus%s with the Screen Options panel.", "catablog"), "<a href='nav-menus.php#screen-options'>", '</a>') ?></small>
			</p>
			
			<p>
				<label for='public_post_slug'><?php _e("Individual Pages Slug:", "catablog"); ?></label>
				<input type='text' name='public_post_slug' id='public_post_slug' size='20' value='<?php echo $public_posts_slug ?>' /><br />
				<small><?php _e("This is the identifying slug your blog will use to create your individual catalog item pages.", "catablog"); ?></small>
			</p>
			
			<p>
				<label for='public_tax_slug'><?php _e("Category Pages Slug:", "catablog"); ?></label>
				<input type='text' name='public_tax_slug' id='public_tax_slug' size='20' value='<?php echo $public_tax_slug ?>' /><br />
				<small><?php _e("This is the identifying slug your blog will use to create your catalog archive pages.", "catablog") ?></small>
			</p>
			
			<p>&nbsp;</p>
			
			<p>
				<strong class="warning"><?php _e('Catalog Slugs Warning', 'catablog')?></strong><br />
				<small><?php printf(__('Please make sure you do not set either of your catalog slugs to a %sWordPress Reserved Term%s.', 'catablog'), '<a href="http://codex.wordpress.org/Function_Reference/register_taxonomy#Reserved_Terms" target="_blank">', '</a>') ?></small><br />
				<small><?php _e("These labels must also be URL friendly, so they may be transformed from your original input.", 'catablog') ?></small>
			</p>
			
		</div>
		
		
		
		<?php /*  TITLE SETTINGS PANEL  */ ?>
		<div id="catablog-options-title" class="catablog-options-panel hide">
			<p>
				<label for="link_target"><?php _e("Link Target:", "catablog"); ?></label>
				<input type="text" id="link_target" name="link_target" value="<?php echo $link_target ?>" /><br />
				<small>
					<?php _e("The link target setting will set the <strong>target</strong> attribute of all the catalog title links.", "catablog"); ?><br />
					<strong><?php _e("examples:", "catablog"); ?></strong> _blank, _top, _self.
				</small>
			</p>
			<p>
				<label for="link_target"><?php _e("Link Relationship:", "catablog"); ?></label>
				<input type="text" id="link_relationship" name="link_relationship" value="<?php echo $link_relationship ?>" maxlength="30" /><br />
				<small>
					<?php _e("The link relationship will set the <strong>rel</strong> attribute of all the catalog title links.", "catablog"); ?><br />
					<strong><?php _e("examples:", "catablog"); ?></strong> index, next, prev, glossary, chapter, bookmark, nofollow.
				</small>
			</p>
		</div>
		
		
		<?php /*  DESCRIPTION SETTINGS PANEL */ ?>
		<div id="catablog-options-description" class="catablog-options-panel hide">
			<p>
				<?php $checked = ($wp_filters_enabled)? "checked='checked'" : "" ?>
				<label for="catablog-filters-enabled"><?php _e("Enable WordPress Filters:", "catablog"); ?></label>
				<input type="checkbox" name="wp-filters-enabled" id="catablog-filters-enabled" <?php echo $checked ?> /><br/>
				<small>
					<?php _e("Enable the standard WordPress filters for your catalog item's description.", "catablog"); ?><br />
					<?php _e("This allows you to use ShortCodes and media embeds inside your catalog item descriptions.", "catablog"); ?><br />
					<?php _e("Please <strong>do not use the CataBlog ShortCode</strong> inside a catalog item's description.", "catablog"); ?>
				</small>
			</p>
			
			<p>
				<?php $checked = ($nl2br_enabled)? "checked='checked'" : "" ?>
				<label for="catablog-nl2br-enabled"><?php _e("Render Line Breaks:", "catablog"); ?></label>
				<input type="checkbox" name="nl2br-enabled" id="catablog-nl2br-enabled" <?php echo $checked ?> /><br/>
				<small>
					<?php printf(__("Filter your catalog item's description through the standard PHP function %s.", "catablog"), '<a href="http://php.net/manual/en/function.nl2br.php" target="_blank">nl2br()</a>'); ?><br />
					<?php _e("This will insert HTML line breaks before all new lines in your catalog descriptions.", "catablog"); ?><br />
					<?php _e("Turn this off if unwanted line breaks are being rendered on your page.", "catablog"); ?>
				</small>
			</p>
		</div>
		
		<?php /*  TEMPLATE SETTINGS PANEL  */ ?>
		<div id="catablog-options-template" class="catablog-options-panel hide">
			<p>
				<?php $views = new CataBlogDirectory($this->directories['views']); ?>
				<?php if ($views->isDirectory()): ?>
					<select id="catablog-template-view-menu">
						<?php foreach($views->getFileArray() as $key => $view): ?>
							<?php echo "<option value='$view'>$view</option>"; ?>
						<?php endforeach ?>
					</select>
					<a href="<?php echo $this->urls['views'] ?>" id="catablog-view-set-template" class="catablog-load-code button add-new-h2"><?php _e("Load Template", "catablog"); ?></a>
				<?php else: ?>
					<p class="error"><?php _e("Could not locate the views directory. Please reinstall CataBlog.", "catablog"); ?></p>
				<?php endif ?>
				
				
			</p>
			<p>
				<textarea name="view-code-template" id="catablog-view-set-template-code" class="catablog-code" rows="10" cols="30"><?php echo $this->options['view-theme'] ?></textarea>
				
				<small>
					<?php _e("You may change the html code rendered by <strong>CataBlog</strong> here, this allows you to make fundamental changes to how catalogs will appear in your posts. You may choose a template from the drop down menu at top and then click <em>Load Template</em> to load it into the template code. If you want to setup a photo gallery I would recommend that you load the <em>Gallery template</em> and then click save below. To setup a shopping cart you should load the <em>Default Template</em> code and then load a Store Template.", "catablog"); ?>
				</small>
			</p>
			
			<p><small>
				<?php _e("Don't forget to click <strong>Save Changes</strong> at the bottom of the page to finalize your changes and use the new code for your blog.", "catablog"); ?>
			</small></p>
		</div>
		
		
		
		<?php /* BUY NOW TEMPLATE SETTINGS PANEL */ ?>
		<div id="catablog-options-store" class="catablog-options-panel hide">
			<p>
				<label for="paypal_email"><?php _e("PayPal Account Email Address:", "catablog"); ?></label>
				<input type="text" name="paypal_email" id="paypal_email" size="50" value="<?php echo $paypal_email ?>" />
			</p>
			
			<p><small>
				<?php printf(__("Enter in an email address here that has been registered with %sPayPal%s and choose a <em>Buy Now Template</em> below to setup a store. You may then give items a price and product code. When an item has a price above zero a 'Buy Now' button will appear under the description of that CataBlog item.", "catablog"), '<a href="http://www.paypal.com" target="_blank">', '</a>'); ?>
			</small></p>
			
			<hr />
			
			<p>
				<?php $views = new CataBlogDirectory($this->directories['buttons']) ?>
				<?php if ($views->isDirectory()): ?>
					<select id="catablog-template-store-menu">
						<?php foreach($views->getFileArray() as $key => $view): ?>
							<?php echo "<option value='$view'>$view</option>" ?>
						<?php endforeach ?>
					</select>
					<a href="<?php echo $this->urls['buttons'] ?>" id="catablog-view-set-buynow" class="catablog-load-code button add-new-h2"><?php _e("Load Template", "catablog"); ?></a>
				<?php else: ?>
					<p class="error"><?php _e("Could not locate the views directory. Please reinstall CataBlog.", "catablog"); ?></p>
				<?php endif ?>
			</p>
			<p>
				<textarea name="view-code-buynow" id="catablog-view-set-buynow-code" class="catablog-code" rows="10" cols="30"><?php echo $this->options['view-buynow'] ?></textarea>
				<small>
					<?php _e("You may change the html code rendered for the <strong>Buy Now</strong> button here. All value tokens are available here too, so place the title, description or any other values you may want to use from the current catalog item in this code as well.", "catablog"); ?>
				</small>
			</p>
			<p style="clear:both;">&nbsp;</p>
			
			<input type="hidden" name="save" id="save" value="yes" />
			<?php wp_nonce_field( 'catablog_options', '_catablog_options_nonce', false, true ) ?>
			<input id="catablog-options-submit" type="submit" class="hide" value="<?php _e('Save Changes') ?>" />
			
		</div>
	</form>	
	
	
	
	
	<?php /*  EXPORT SETTINGS PANEL  */ ?>
	<div id="catablog-options-export" class="catablog-options-panel hide">
		<?php $function_exists = function_exists('fputcsv') ?>
		
		<p><?php _e("You may export your CataBlog data to a XML or CSV file which may be used to backup and protect your work. The XML or CSV file is a simple transfer of the database information itself and the <strong>images are not included in this backup</strong>. To backup your images follow the directions at the bottom of the page.", "catablog"); ?></p>
		
		<p>&nbsp;</p>
		
		<p>
			<?php $link = wp_nonce_url('admin.php?page=catablog-export&amp;format=xml', 'catablog-export') ?>
			<a href="<?php echo $link ?>" class="button"><?php _e("Save XML BackUp File", "catablog"); ?></a>
			<?php if ($function_exists): ?>
				<span> | </span>
				<?php $link = wp_nonce_url('admin.php?page=catablog-export&amp;format=csv', 'catablog-export') ?>
				<a href="<?php echo $link ?>" class="button"><?php _e("Save CSV BackUp File", "catablog"); ?></a>
			<?php endif ?>
		</p>
		
			
		<?php if (!$function_exists): ?>
			<p class="error"><small>
				<?php printf(__("You must have the function %sfputcsv()%s available on your web server's version of PHP for CSV export to work.", "catablog"), '<strong><a href="http://php.net/manual/en/function.fputcsv.php" target="_blank">', '</a></strong>'); ?>
				<br />
				<?php _e("Please contact your server administrator for more information regarding this error.", "catablog"); ?>
			</small></p>
		<?php else: ?>
			<p>&nbsp;</p>
		<?php endif ?>
		
		<p>
			<strong><?php _e("Backing Up Images:", "catablog"); ?></strong><br />
			<?php _e("Please copy the <em>catablog</em> directory to a secure location.", "catablog"); ?><br />
			<?php _e("The directory for this WordPress blog can be located on your web server at:", "catablog"); ?><br />
			<small><em><?php echo $this->directories['uploads'] ?></em></small>
		</p>
	</div>
	
	



	<?php /*  IMPORT SETTINGS PANEL  */ ?>
	<div id="catablog-options-import" class="catablog-options-panel hide">
		<label><?php _e("Import XML/CSV Data", "catablog"); ?></label>
		<form action="admin.php?page=catablog-import" method="post" enctype="multipart/form-data">
			<?php $function_exists = function_exists('simplexml_load_file') ?>
			
			<p><input type="file" name="catablog_data" id="catablog_data" /></p><br />
			
			<p style="margin-bottom:5px;">&nbsp;
				<input type="checkbox" id="catablog_clear_db" name="catablog_clear_db" value="true" />
				<label for="catablog_clear_db"><?php _e("Replace All Data:", "catablog"); ?></label>
			</p>
			
			<p><input type="submit" class="button" value="<?php _e('Import CataBlog Data', "catablog") ?>" /></p>
			
			<?php if (!$function_exists): ?>
				<p class="error"><small>
					<?php _e("You must have the <strong>Simple XML Library</strong> installed on your web server's version of PHP for XML imports to work. Please contact your server administrator for more information regarding this error.", "catablog"); ?>
				</small></p>
			<?php endif ?>
			
			<p><small>
				<?php _e("To import data into your catalog you simply select a XML or CVS file on your hard drive and click the <em>Import CataBlog Data</em> button. You may choose to completely erase all your data before importing by checking the <em>Replace All Data</em> checkbox.<br />Keep in mind, this <strong>does not import or delete images</strong>.", "catablog"); ?>
			</small></p>
			<p><small>
				<?php printf(__("To import images you should upload them to the <em>originals</em> directory, located at: <em>%s</em>. Once you load the XML or CVS file and the images into the <em>originals</em> directory everything should be set after you %sRegenerate All Images%s in the systems tab.", "catablog"), $this->directories['originals'], '<a href="admin.php?page=catablog-regenerate-images" class="js-warn">', '</a>'); ?>
			</small></p>
			
			<p><small>
				<?php printf(__("You may view XML and CSV examples in the %simport/export documentation%s.", "catablog"), '<a href="http://catablog.illproductions.com/documentation/importing-and-exporting-catalogs/" target="_blank">', '</a>'); ?>
			</small></p>
			
			<?php wp_nonce_field( 'catablog_import', '_catablog_import_nonce', false, true ) ?>
		</form>
	</div>
	
	
	
	<?php /* SYSTEM SETTINGS PANEL */ ?>
	<div id="catablog-options-system" class="catablog-options-panel hide">
		<p>
		<?php $permissions = substr(sprintf('%o', fileperms($this->directories['uploads'])), -4) ?>
		<?php if ($permissions == '0777'): ?>
			<span><?php _e("CataBlog Upload Folders are <strong>Unlocked</strong>", "catablog"); ?></span>
		<?php elseif ($permissions == '0755'): ?>
			<span><?php _e("CataBlog Upload Folders are <strong>Locked</strong>", "catablog"); ?></span>
		<?php else: ?>
			<span><?php _e("Could not lock/unlock the directory. Are you using a unix based server?", "catablog"); ?></span>
		<?php endif ?>
		</p>
		
		<p>
		<?php $link = wp_nonce_url('admin.php?page=catablog-lock-folders#system', 'catablog-lock-folders') ?>
		<a href="<?php echo $link ?>" class="button"><?php _e("Lock Folders", "catablog"); ?></a>
		<?php $link = wp_nonce_url('admin.php?page=catablog-unlock-folders#system', 'catablog-unlock-folders') ?>
		<a href="<?php echo $link ?>" class="button"><?php _e("Unlock Folders", "catablog"); ?></a>				
		</p>
		
		<p><small>
				<?php printf(__("You may lock and unlock your <em>catablog</em> folders with these controls. The idea is to unlock the folders, use your FTP client to upload your original files and then lock the folders to protect them from hackers. After unlocking your directories please upload the original files directly into the <strong>%s</strong> folder without replacing it. <strong>Do not replace any of the CataBlog created folders</strong>. You should then regenerate all your thumbnail and lightbox pictures below. These controls may not work on a Windows server, it depends on your servers PHP settings and if the chmod command is supported.", "catablog"), $this->directories['originals']); ?>
		</small></p>
		
		<hr />
		
		<p><label><?php _e("Rescan Original Image Folder", "catablog"); ?></label></p>
		<?php $link = wp_nonce_url('admin.php?page=catablog-rescan-images', 'catablog-rescan-originals') ?>
		<p><a href="<?php echo $link ?>" class="button js-warn"><?php _e("Rescan Original Images Folder Now", "catablog"); ?></a></p>
		<p><small>
			<?php _e("Click the <em>Rescan Now</em> button to rescan the original catablog images folder and automatically import any new jpeg, gif or png images. It works simply by making a list of all the image names in the database and then compares each file's name in the originals folder against the list of image names in the database. Any newly discovered images will automatically be made into a new catalog item. You should Regenerate Images after running this command.", "catablog"); ?>
		</small></p>
		
		<hr />
		
		<p><label><?php _e("Regenerate Images", "catablog"); ?></label></p>
		<?php $link = wp_nonce_url('admin.php?page=catablog-regenerate-images', 'catablog-regenerate-images') ?>
		<p><a href="<?php echo $link ?>" class="button js-warn"><?php _e("Regenerate All Images Now", "catablog"); ?></a></p>
		<p><small>
				<?php _e("Click the <em>Regenerate Now</em> button to recreate all the thumbnail and lightbox images that CataBlog has generated over the time you have used it. This is also useful when restoring exported data from another version of CataBlog. after you have uploaded your original images you must regenerate your images so they display properly.", "catablog"); ?>
		</small></p>
		
		<hr />
		
		<p><label><?php _e("Remove CataBlog", "catablog"); ?></label></p>
		<?php $link = wp_nonce_url('admin.php?page=catablog-remove', 'catablog-remove') ?>
		<p><a href="<?php echo $link ?>" class="button js-warn" id="button-reset"><?php _e("Remove All CataBlog Data", "catablog"); ?></a></p>
		<p><small>
			<?php _e("Delete your entire catalog, deleting all photos and custom data permanently. Sometimes you can use this to fix an improper installation.", "catablog"); ?>
		</small></p>
	</div>
	
	
	
	<?php /*  SUBMIT FORM BUTTON  */ ?>
	<p class="submit" style="margin-left:100px;">
		<input type="button" id="save_changes" class="button-primary" value="<?php _e('Save Changes') ?>" />
		<span><?php printf(__('or %sundo current changes%s', 'catablog'), '<a href="admin.php?page=catablog-options">', '</a>'); ?></span>
	</p>
	
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		/****************************************
		** BIND SAVE CHANGES BUTTON
		****************************************/
		$('#save_changes').bind('click', function(event) {
			var form_action = $('#catablog-options').attr('action');
			var active_tab  = $('#catablog-options-menu li a.selected').attr('href');
			
			$('#catablog-options').attr('action', (form_action+active_tab))
			$('#catablog-options').submit();
		});
		
		
		/****************************************
		** BIND OPTION PANEL TABS AND CLICK ONE
		****************************************/		
		$('#catablog-options-menu li a').bind('click', function(event) {
			$('.catablog-options-panel:visible').hide();
			$('#catablog-options-menu li a.selected').removeClass('selected');
			
			$(this).addClass('selected');
			var panel = '#catablog-options-' + $(this).attr('href').substring(1);
			$(panel).show();
		});
		
		var path = '#catablog-options-menu li:first a';
		var hash = window.location.hash;
		if (hash.length > 0) {
			path = '#catablog-options-menu li a[href='+hash+']';
		}
		$(path).click();
		
		
		
		
		/****************************************
		** THUMBNAILS PANEL
		****************************************/
		// load image for thumbnail preview
		var thumbnail_preview = new Image;
		thumbnail_preview.onload = function() {
			var preview = '<img src="'+this.src+'" class="hide" />';
			$('#demo_box').append(preview);
			resize_image_adjustment();
		}
		thumbnail_preview.src = "<?php echo $this->urls['images'] ?>/catablog-thumbnail-preview.jpg";
		
		
		
		// update the thumbnail preview size dynamically
		$('#thumbnail_width').bind('keyup', function(event) {
			var v = this.value;
			if (is_integer(v) && (v > 0)) {
				$(this).siblings('small.error').hide();
				resize_image_adjustment();
				jQuery('#demo_box').animate({width:(v-1)}, 100);
			}
		});
		$('#thumbnail_height').bind('keyup', function(event) {
			var v = this.value;
			if (is_integer(v) && (v > 0)) {
				$(this).siblings('small.error').hide();
				resize_image_adjustment();
				jQuery('#demo_box').animate({height:(v-1)}, 100);
			}
		});
		
		
		
		$('#keep_aspect_ratio').bind('change', function(event) {
			resize_image_adjustment();
		});
		
		
		// calculate and resize the image with in the thumbnail preview box
		function resize_image_adjustment() {
			var original_width  = parseInt(thumbnail_preview.width);
			var original_height = parseInt(thumbnail_preview.height);
			var thumbnail_width  = parseInt(jQuery('#thumbnail_width').val());
			var thumbnail_height = parseInt(jQuery('#thumbnail_height').val());
			var thumbnail_crop   = !($('#keep_aspect_ratio').attr('checked'));
			var params = {};
			
			if (thumbnail_crop) {
				if (thumbnail_width > thumbnail_height) {
					params = crop_width(original_width, original_height, thumbnail_width, thumbnail_height);
				}
				else {
					params = crop_height(original_width, original_height, thumbnail_width, thumbnail_height);
				}
			}
			else {
				if (thumbnail_width > thumbnail_height) {
					params = shrink_width(original_width, original_height, thumbnail_width, thumbnail_height);
				}
				else {
					params = shrink_height(original_width, original_height, thumbnail_width, thumbnail_height);
				}
			}
			
			jQuery('#demo_box img').animate(params, 100, function() {
				if (jQuery(this).hasClass('hide')) {
					jQuery(this).removeClass('hide');
				}
			});
		}
		
		
		
		/****************************************
		** LIGHTBOX PANEL
		****************************************/
		// disable lightbox size field if the lightbox is off
		$('#lightbox_image_size').attr('readonly', !$('#lightbox_render').attr('checked'));
		$('#lightbox_render').bind('click', function(event) {
			if (this.checked) {
				$('#lightbox_image_size').attr('readonly', false);
			}
			else {
				$('#lightbox_image_size').attr('readonly', true);
			}
		});
		
		
		
		
		
		/****************************************
		** PUBLIC PANEL
		****************************************/
		$('#public-catalog-slug').attr('readonly', !$('#public-catalog-items').attr('checked'));
		$('#public-catalog-items').bind('click', function(event) {
			if (this.checked) {
				$('#public-catalog-slug').attr('readonly', false);
			}
			else {
				$('#public-catalog-slug').attr('readonly', true);
			}
		});	
		
		
		
		
		
		/****************************************
		** TEMPLATE & BUY BUTTON PANELS
		****************************************/
		// bind the load buttons for the template drop down menus
		$('.catablog-load-code').bind('click', function(event) {
			var id       = this.id;
			var selected = $(this).siblings('select').val();
			var url = this.href + "/" + selected;
			
			$.get(url, function(data) {
				$('#' + id + '-code').val(data);
			});				
			
			return false;
		});
				
		// bind the textareas in the catablog options form to accept tabs
		$('#catablog-options textarea').bind('keydown', function(event) {
			var item = this;
			if(navigator.userAgent.match("Gecko")){
				c = event.which;
			}else{
				c = event.keyCode;
			}
			if(c == 9){
				replaceSelection(item,String.fromCharCode(9));
				$("#"+item.id).focus();	
				return false;
			}
		});
		
		
		
		
		
		
		
		
		
		/****************************************
		** GENERAL FORM BINDINGS
		****************************************/
		// enter key submits form
		$('#catablog-options input').bind('keydown', function(event) {
			if(event.keyCode == 13){
				$('#save_changes').click();
				return false;
			}
		});
		
		// up and down arrow keys for changing integer values
		$('#catablog-options input.integer_field').bind('keydown', function(event) {
			var step = 5;
			var keycode = event.keyCode;
			
			if (keycode == 40) { this.value = parseInt(this.value) - step; }
			if (keycode == 38) { this.value = parseInt(this.value) + step; }
		});
		
		// bind showing an error message when an integer value is incorrect
		$('#catablog-options input.integer_field').bind('keyup', function(event) {
			var v = this.value;
			
			if (is_integer(v) && (v > 0)) {
				// do nothing
			}
			else {
				$(this).siblings('small.error').show();
			}
			
			possibly_disable_save_button();
		});
		
		// confirm with javascript that the user wants to complete the action
		$('div.catablog-options-panel a.js-warn').click(function(event) {
			var message = $(this).html() + "?";
			return confirm(message);
		})
		
		
		
		
		
		
		

		/****************************************
		** BIND COLOR PICKERS
		****************************************/
		var farbtastic;
		function pickColor(a) {
			farbtastic.setColor(a);
			jQuery("#bg_color").val(a);
			jQuery("#demo_box").css("background-color",a)
			jQuery('.color-swatch').css("background-color",a);
		}
		jQuery("#pickcolor").click(function() {
			
			jQuery(this).addClass('selected');
			
			var color_picker = jQuery("#color-picker-div");
			color_picker.css('top', jQuery('#bg_color').offset().top + 21);
			color_picker.css('left', jQuery(this).offset().left);
			color_picker.show();
			
			return false;
		});
		jQuery("#bg_color").keyup(function() {
			var b = jQuery(this).val();
			a = b;
			
			if (a[0]!="#") {
				a = "#"+a;
			}
			
			a = a.replace(/[^#a-fA-F0-9]+/,"");
			if (a != b) {
				jQuery("#bg_color").val(a)
			}
			
			if (a.length == 4 || a.length == 7){
				pickColor(a)
			}
		});	
				
		farbtastic = jQuery.farbtastic("#color-picker-div",function(a){
			pickColor(a)
		});
		pickColor(jQuery("#bg_color").val());
		
		jQuery(document).mousedown(function(){
			jQuery("#color-picker-div").each(function(){
				var a = jQuery(this).css("display");
				if (a == "block") {
					jQuery('#pickcolor.selected').removeClass('selected');
					jQuery(this).fadeOut(2);
				}
			});
		});
		
		
		
		
		
		
		
		/****************************************
		** RECALCULATE IMAGES IF NECESSARY
		****************************************/
	<?php if ($recalculate_thumbnails || $recalculate_fullsize): ?>
		discourage_leaving_page('<?php _e("Please allow the rendering to complete before leaving this page. Click cancel to go back and let the rendering complete.", "catablog"); ?>');
		
		$('#save_changes').attr('disabled', true);
		var nonce   = '<?php echo wp_create_nonce("catablog-render-images") ?>';		
		var images  = ["<?php echo implode('", "', $image_names) ?>"];
		var warning = '<?php _e("Image rendering is not complete, you should let image rendering complete before leaving this page.", "catablog"); ?>';
		
	<?php endif ?>
	
	
	
	<?php if ($recalculate_thumbnails): ?>
		var thumbs = images.slice(0);
		renderCataBlogItems(thumbs, 'thumbnail', nonce, function() {
			// jQuery('#catablog-progress-thumbnail .catablog-progress-text').html(message);
			
			var t = setTimeout(function() {
				jQuery('#catablog-progress-thumbnail').hide('medium');
				jQuery('#message').hide('medium');
			}, 2000);

			$('#save_changes').attr('disabled', false);
			
			<?php if ($recalculate_fullsize == false): ?>
				unbind_discourage_leaving_page();
			<?php endif ?>
		});
	<?php endif ?>
	
	
	
	<?php if ($recalculate_fullsize): ?>
		var fullsize = images.slice(0);
		renderCataBlogItems(fullsize, 'fullsize', nonce, function() {
			// jQuery('#catablog-progress-fullsize .catablog-progress-text').html(message);
			
			var t = setTimeout(function() {
				jQuery('#catablog-progress-thumbnail').hide('medium');
				jQuery('#catablog-progress-fullsize').hide('medium');
				jQuery('#message').hide('medium');
			}, 2000);
			
			$('#save_changes').attr('disabled', false);
			
			unbind_discourage_leaving_page();
		});
	<?php endif ?>

			
			
			
		
	}); // end onReady method
	

	
	
	
</script>