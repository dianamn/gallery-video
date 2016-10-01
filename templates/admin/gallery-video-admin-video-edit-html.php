<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div id="huge_it_gallery_video_edit_videos" style="display:none;">
	<h1><?php echo __( 'Update video', 'gallery-video' ); ?></h1>
	<form method="post" id="form-edit-video" data-gallery-video-id="" data-video-id="" data-video-edit-nonce="<?php echo $gallery_video_edit_video_nonce; ?>">
		<div class="iframe-text-area">
			<iframe class="gallery-video-iframe-area" src=""  frameborder="0"
			        allowfullscreen></iframe>
			<textarea rows="4" cols="50" class="video-text-area" disabled>
			</textarea>
			<input type="text" id="edit_video_input" name="edit_video_input" value=""
			       placeholder="New video url"/><br/>
		</div>
		<a class='button-primary set-new-video'><?php echo __( 'See New Video', 'gallery-video' ); ?></a>
		<a class='button-primary edit-video-button'
		        id='huge-it-insert-video-button'><?php echo __( 'Insert Video', 'gallery-video' ); ?></a>
	</form>
</div>