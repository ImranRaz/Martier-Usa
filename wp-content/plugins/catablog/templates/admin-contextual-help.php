<?php


switch ($screen) {


	case 'toplevel_page_catablog':
		
		if (isset($_GET['id'])) {
			$message  = "<p>";
			$message .= __("You may edit your catalog entry as you see fit in this panel.", "catablog") . " ";
			$message .= __("Notice that the description accepts HTML code. This makes it easy to refine your catalog layout inside your description.", "catablog") . " ";
			$message .= "</p>";
		}
		else {
			$message  = "<p>";
			$message .= __("CataBlog is a comprehensive and easy to use cataloging system for WordPress. ", "catablog");
			$message .= "<p>";
			$message .= __("Get started by making your first catalog item, click the <strong>Add New</strong> button near the page title. ", "catablog");
			$message .= "</p>";
			$message .= "<p>";
			$message .= sprintf(__("You may learn more about CataBlog at %scatablog.illproductions.com%s. ", "catablog"), "<a href='http://catablog.illproductions.com/' target='_blank'>", "</a>");
			$message .= "</p>";
			$message .= "<p>";
			$message .= sprintf(__("A lot of time and effort has gone into creating this plugin, %splease donate%s to Zach and help the continued development of CataBlog.", "catablog"), "<a href='http://catablog.illproductions.com/donate/' target='_blank'>", "</a>");
			$message .= "</p>";
		}
		echo $message;
		break;


	case 'catablog_page_catablog-upload':
		$message  = "<p>";
		$message .= __("To create a new catalog entry first upload an image by selecting a file and then clicking the upload button. ", "catablog");
		$message .= __("After the upload is successful a new catalog entry will be generated with the name of the file you uploaded. ", "catablog");
		$message .= "</p>";
		echo $message;
		break;



	case 'catablog_page_catablog-options':
		$message  = "<p>";
		$message .= __("CataBlog offer many options that let you modify your catalog and its appearance.", "catablog");
		$message .= "</p>";
		echo $message;
		break;


	case 'catablog_page_catablog-about':
		$message  = "<p>";
		$message .= __("Please make sure to support the plugin author by donating.", "catablog");
		$message .= "</p>";
		echo $message;
		break;


	case 'admin_page_catablog-rescan-images':
		$message  = "<p>";
		$message .= __("Your CataBlog originals upload folder is being scanned for any files that are not currently in the database.", "catablog");
		$message .= "</p>";
		echo $message;
		break;


	case 'admin_page_catablog-regenerate-images':
		$message  = "<p>";
		$message .= __("CataBlog is regenerating all the images in the CataBlog thumbnail and LightBox folders.", "catablog");
		$message .= "</p>";
		echo $message;
		break;


	case 'admin_page_catablog-remove':
		$message  = "<p>";
		$message .= __("CataBlog is being completely removed, afterwards you may go back to the library view to reinstall the default settings.", "catablog");
		$message .= __("If you wish to completely remove CataBlog, do not go to the library view, instead disable CataBlog after this is complete.", "catablog");
		$message .= "</p>";
		echo $message;
		break;

	default:
		echo $contextual_help;


}