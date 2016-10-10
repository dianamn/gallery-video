<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Gallery_Video_Admin {

	/**
	 * Array of pages in admin
	 * @var array
	 */
	public $pages = array();

	/**
	 * Instance of Gallery_Video_General_Options class
	 *
	 * @var Gallery_Video_General_Options
	 */
	public $general_options = null;

	/**
	 * Instance of Gallery_Video_Galleries class
	 *
	 * @var Gallery_Video_Galleries
	 */
	public $video_galleries = null;

	/**
	 * Instance of Gallery_Video_Lightbox_Options class
	 *
	 * @var Gallery_Video_Lightbox_Options
	 */
	public $lightbox_options = null;

	/**
	 * Instance of Gallery_Video_Featured_Plugins class
	 *
	 * @var Gallery_Video_Featured_Plugins
	 */
	public $featured_plugins = null;

	/**
	 * Gallery_Video_Admin constructor.
	 */
	public function __construct() {
		$this->init();
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( $this, 'wp_loaded' ) );
		add_action( 'wp_loaded', array( $this, 'wp_loaded_add_video' ) );
		add_action( 'wp_loaded', array( $this, 'wp_loaded_edit_video' ) );
	}

	/**
	 * Initialize Video Gallery's admin
	 */
	protected function init() {
		$this->general_options  = new Gallery_Video_General_Options();
		$this->video_galleries  = new Gallery_Video_Galleries();
		$this->lightbox_options = new Gallery_Video_Lightbox_Options();
		$this->featured_plugins = new Gallery_Video_Featured_Plugins();
		$this->licensing        = new Gallery_Video_Licensing();
	}

	/**
	 * Prints Video Gallery Menu
	 */
	public function admin_menu() {
		$this->pages[] = add_menu_page( __( 'Video Gallery', 'gallery-video' ), __( 'Video Gallery', 'gallery-video' ), 'delete_pages', 'video_galleries_huge_it_video_gallery', array(
			Gallery_Video()->admin->video_galleries,
			'load_video_gallery_page'
		), GALLERY_VIDEO_IMAGES_URL . "/admin_images/video_gallery_icon.png" );
		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Video Galleries', 'gallery-video' ), __( 'Video Galleries', 'gallery-video' ), 'delete_pages', 'video_galleries_huge_it_video_gallery', array(
			Gallery_Video()->admin->video_galleries,
			'load_video_gallery_page'
		) );

		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'General Options', 'gallery-video' ), __( 'General Options', 'gallery-video' ), 'delete_pages', 'Options_video_gallery_styles', array(
			Gallery_Video()->admin->general_options,
			'load_page'
		) );
		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Lightbox Options', 'gallery-video' ), __( 'Lightbox Options', 'gallery-video' ), 'delete_pages', 'Options_video_gallery_lightbox_styles', array(
			Gallery_Video()->admin->lightbox_options,
			'load_page'
		) );

		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Featured Plugins', 'gallery-video' ), __( 'Featured Plugins', 'gallery-video' ), 'delete_pages', 'huge_it_video_gallery_featured_plugins', array(
			Gallery_Video()->admin->featured_plugins,
			'show_page'
		) );

		$this->pages[] = add_submenu_page( 'video_galleries_huge_it_video_gallery', __( 'Licensing', 'gallery-video' ), __( 'Licensing', 'gallery-video' ), 'delete_pages', 'huge_it_video_gallery_licensing', array(
			Gallery_Video()->admin->licensing,
			'show_page'
		) );
	}

	/**
	 * Inserts New Video Gallery
	 */
	public function wp_loaded() {

		if ( isset( $_REQUEST['huge_it_gallery_video_nonce_add_gallery_video'] ) ) {
			$huge_it_gallery_video_nonce_add_gallery_video = $_REQUEST['huge_it_gallery_video_nonce_add_gallery_video'];
			if ( ! wp_verify_nonce( $huge_it_gallery_video_nonce_add_gallery_video, 'huge_it_gallery_video_nonce_add_gallery_video' ) ) {
				wp_die( 'Security check fail' );
			}
		}
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'video_galleries_huge_it_video_gallery' ) {
			if ( gallery_video_get_video_gallery_task() ) {
				if ( gallery_video_get_video_gallery_task() == 'add_cat' ) {
					global $wpdb;
					$table_name = $wpdb->prefix . "huge_it_videogallery_galleries";
					$wpdb->insert(
						$table_name,
						array(
							'name'                        => 'New Video Gallery',
							'sl_height'                   => 375,
							'sl_width'                    => 600,
							'pause_on_hover'              => 'on',
							'videogallery_list_effects_s' => 'cubeH',
							'description'                 => 4000,
							'param'                       => 1000,
							'ordering'                    => 1,
							'published'                   => 300,
							'huge_it_sl_effects'          => 4
						)
					);
					$query    = "SELECT * FROM " . $wpdb->prefix . "huge_it_videogallery_galleries order by id ASC";
					$rowsldcc = $wpdb->get_results( $query );
					$last_key = key( array_slice( $rowsldcc, - 1, 1, true ) );
					foreach ( $rowsldcc as $key => $rowsldccs ) {
						if ( $last_key == $key ) {
							wp_redirect( 'admin.php?page=video_galleries_huge_it_video_gallery&id=' . $rowsldccs->id . '&task=apply' );
						}
					}
				}
			}
		}
	}

	/**
	 * Inserts New Video into Video Gallery
	 */
	public function wp_loaded_add_video() {
		if ( isset( $_REQUEST['huge_it_gallery_nonce_add_video'] ) ) {
			$huge_it_gallery_nonce_add_video = $_REQUEST['huge_it_gallery_nonce_add_video'];
			if ( ! wp_verify_nonce( $huge_it_gallery_nonce_add_video, 'huge_it_gallery_nonce_add_video' ) ) {
				wp_die( 'Security check fail' );
			}
		}
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'video_galleries_huge_it_video_gallery' ) {
			if ( gallery_video_get_video_gallery_task() && gallery_video_get_video_gallery_id() ) {
				if ( gallery_video_get_video_gallery_task() == 'videogallery_video' && $_GET['closepop'] == 1 ) {
					$id = gallery_video_get_video_gallery_id();
					global $wpdb;
					$title       = wp_kses( wp_unslash( $_POST["show_title"] ), 'default' );
					$description = wp_kses( wp_unslash( $_POST["show_description"] ), 'default' );
					$video_url   = sanitize_text_field( $_POST["huge_it_add_video_input"] );
					$link_url    = sanitize_text_field( $_POST["show_url"] );
					if ( isset( $_POST["huge_it_add_video_input"] ) ) {
						if ( $_POST["huge_it_add_video_input"] != '' ) {
							$table_name   = $wpdb->prefix . "huge_it_videogallery_videos";
							$query        = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "huge_it_videogallery_galleries WHERE id= %d", $id );
							$row          = $wpdb->get_row( $query );
							$query        = $wpdb->prepare( "SELECT * FROM " . $wpdb->prefix . "huge_it_videogallery_videos where videogallery_id = %d order by id ASC", $row->id );
							$rowplusorder = $wpdb->get_results( $query );

							foreach ( $rowplusorder as $key => $rowplusorders ) {
								$rowplusorderspl = $rowplusorders->ordering + 1;
								$wpdb->update(
									$table_name,
									array( 'ordering' => $rowplusorderspl ),
									array( 'id' => $rowplusorders->id )
								);
							}
							$wpdb->insert(
								$table_name,
								array(
									'name'                  => $title,
									'videogallery_id'       => $id,
									'description'           => $description,
									'image_url'             => $video_url,
									'sl_url'                => $link_url,
									'sl_type'               => 'video',
									'link_target'           => 'on',
									'ordering'              => 0,
									'published'             => 1,
									'published_in_sl_width' => 1
								)
							);
						}
					}
					wp_redirect( 'admin.php?page=video_galleries_huge_it_video_gallery&id=' . $id . '&task=apply' );
				}
			}
		}
	}

	/**
	 * Edit Video
	 */
	public function wp_loaded_edit_video() {
		if ( isset( $_REQUEST['video_edit_nonce'] ) ) {
			$video_edit_nonce = $_REQUEST['video_edit_nonce'];
			if ( ! wp_verify_nonce( $video_edit_nonce, 'gallery_video_edit_video_nonce' ) ) {
				wp_die( 'Security check fail' );
			}
		}
		if ( isset( $_GET['page'] ) && $_GET['page'] == 'video_galleries_huge_it_video_gallery' ) {
			if ( gallery_video_get_video_gallery_task() && gallery_video_get_video_gallery_task() == 'gallery_video_edit_video' && $_GET['closepop'] == 1 ) {
				global $wpdb;
				$video_unique_id  = absint( $_GET['video_id'] );
				$gallery_video_id = absint( $_GET['gallery_video_id'] );
				$video_url        = sanitize_text_field( $_GET['video_url'] );
				$table_name       = $wpdb->prefix . 'huge_it_videogallery_videos';
				$wpdb->update(
					$table_name,
					array( 'image_url' => $video_url ),
					array( 'id' => $video_unique_id )
				);
				wp_redirect( 'admin.php?page=video_galleries_huge_it_video_gallery&id=' . $gallery_video_id . '&task=apply' );
			}
		}
	}

}

