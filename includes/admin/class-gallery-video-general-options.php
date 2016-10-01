<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Gallery_Video_General_Options {

	public function __construct() {
		add_action( 'gallery_video_save_general_options', array( $this, 'save_options' ) );
	}

	/**
	 * Loads General options page
	 */
	public function load_page() {
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'Options_video_gallery_styles' ) {
			if ( isset( $_GET['task'] ) ) {
				if ( $_GET['task'] == 'save' ) {
					do_action( 'gallery_video_save_general_options' );
				}
			} else {
				$this->show_page();
			}
		}
	}

	/**
	 * Shows General options page
	 */
	public function show_page() {
		require( GALLERY_VIDEO_TEMPLATES_PATH . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'gallery-video-admin-general-options-html.php' );
	}

}