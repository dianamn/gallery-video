jQuery(document).ready(function(){
	jQuery(".hg_submit_triger").on('click', function(){
		i = jQuery(this).data("id");
		var buttonp = jQuery('#hg_submit_'+i);
		download_pdf(buttonp);

	});
	function download_pdf(e){
		var hg_view_name = e.parent().find(".hg_view_name").attr('value');
		if(hg_view_name == "") {
			hg_view_name = "No Name";
		}
		var hg_video_id = e.parent().find(".hg_video_id").attr('value');
		var videogallery_id = e.parent().find(".videogallery_id").attr('value');		
		var hg_view_count = e.parent().find(".hg_view_count").attr('value');
		
		if(hg_view_count == "") {
			hg_view_count = "0";
		}console.log(report, pathname);
		window.open("admin.php/pdf.php?hg_view_name="+hg_view_name+"&hg_video_id="+hg_video_id+"&videogallery_id="+videogallery_id+"&hg_view_count="+hg_view_count+"",'_blank');
		return false;
	};
});

