"use strict";
function Gallery_Video_Playlist( id ) {
    var _this = this;
    _this.container = jQuery('#' + id + '.main-playlist');
    _this.gallery_id = _this.container.data("gallery_video_id");
    _this.galleryPlaylistSearchNonce = _this.container.data("playlist-nonce");
    _this.scroll = _this.container.data("scroll");
    _this.position = _this.container.data("position");

    ///// on thumbnail click open video
    _this.AttachThumbClick = function (){
        jQuery('#'+id).children().find(".huge_it_videogallery_item").on('click', function( event ) {
            event.preventDefault();
            jQuery('.main-video'+_this.gallery_id).attr('src', jQuery(this).attr('href') );
        });
    };
    _this.AttachThumbClick();

    ///// turn on first video
    jQuery('#'+id).children().find('#vid-list a').first().click();

    ///// resize responsive container
    _this.resizeRespons = function () {
        jQuery(window).resize(function () {
            if ( jQuery(".main-playlist").height()<650) {
                _this.container.find('.vid-thumb-description').each(function () {
                    if ( jQuery(this).text().length > 25 ) {
                        var shortVal = shorten(jQuery(this).text(),25);
                        jQuery(this).text(shortVal);
                    }
                })
            }
            jQuery('ul#vid-list').height(jQuery('.playlist-container').width() * 9 / 16);
            jQuery('.video-wrapper').height(jQuery('.playlist-container').width() * 9 / 16);
        });
    };

    _this.resizeRespons();

    ///// scroll on mouse move
    if (_this.scroll=='off') {
        if (_this.position=='top' || _this.position=='bottom') {
            var newX = 0,
                prevX = 0,
                scrollRight = 0,
                thumbContWidth = 0;
            thumbContWidth = jQuery(".playlist-thumbs").width();
            jQuery(".playlist-scroll").mousemove(function (event) {
                var scrollSize = 0;
                var mouseMoveSize = 0;
                var thumbs_cont = jQuery(this).find('.playlist-thumbs');
                prevX = newX;
                newX = event.pageX;
                mouseMoveSize = newX - prevX;
                jQuery(".main-video").height();
                if (mouseMoveSize < 10) {
                    if (( mouseMoveSize > 0 ) && ( scrollRight < thumbContWidth )) {
                        scrollSize = scrollRight + mouseMoveSize;
                        thumbs_cont.animate({
                            scrollLeft: scrollSize
                        }, {
                            duration: 10,
                            specialEasing: {
                                width: "swing",
                                height: "easeOutBounce"
                            }
                        });
                        scrollRight = scrollSize;
                    } else {
                        if (( mouseMoveSize < 0 ) && ( scrollRight > -1 )) {
                            scrollSize = scrollRight + mouseMoveSize;
                            thumbs_cont.animate({
                                scrollLeft: scrollSize
                            }, {
                                duration: 10,
                                specialEasing: {
                                    width: "swing",
                                    height: "easeOutBounce"
                                }
                            });
                            scrollRight = scrollSize;
                        }

                    }
                }
            });
        } else {
            var newY = 0,
                prevY = 0,
                scrollTop = 0,
                thumbContHeight = 0;
            thumbContHeight = jQuery(".playlist-thumbs").height();
            jQuery(".playlist-scroll").mousemove(function (event) {
                var scrollSize = 0;
                var mouseMoveSize = 0;
                var thumbs_cont = jQuery(this).find('.playlist-thumbs');
                prevY = newY;
                newY = event.pageY;
                mouseMoveSize = newY - prevY;
                jQuery(".main-video").height();
                if (mouseMoveSize < 10) {
                    if (( mouseMoveSize > 0 ) && ( scrollTop < thumbContHeight )) {
                        scrollSize = scrollTop + mouseMoveSize;
                        thumbs_cont.animate({
                            scrollTop: scrollSize
                        }, {
                            duration: 10,
                            specialEasing: {
                                width: "swing",
                                height: "easeOutBounce"
                            }
                        });
                        scrollTop = scrollSize;
                    } else {
                        if (( mouseMoveSize < 0 ) && ( scrollTop > -1 )) {
                            scrollSize = scrollTop + mouseMoveSize;
                            thumbs_cont.animate({
                                scrollTop: scrollSize
                            }, {
                                duration: 10,
                                specialEasing: {
                                    width: "swing",
                                    height: "easeOutBounce"
                                }
                            });
                            scrollTop = scrollSize;
                        }

                    }
                }
            });
        }
    }

    ///// thumbnail text shortener
    function shorten(text, maxLength) {
        var ret = text;
        if (ret.length > maxLength) {
            ret = ret.substr(0,maxLength-3) + "…";
        }
        return ret;
    }
    _this.container.find('.vid-thumb-title').each(function () {
        if ( jQuery(this).text().length > 20 ) {
            var shortVal = shorten(jQuery(this).text(),20);
            jQuery(this).text(shortVal);
        }
    });
    _this.container.find('.vid-thumb-description').each(function () {
        if ( jQuery(this).text().length > 35 ) {
            var shortVal = shorten(jQuery(this).text(),35);
            jQuery(this).text(shortVal);
        }
    })

    /// social share buttons
    jQuery('.shareLook').on('click', function () {
        jQuery('.rwd-share-buttons').css({'visibility': 'visible'});
    });
    _this.socialShare = function () {
        setTimeout(function () {
            jQuery('#rwd-share-facebook').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + (encodeURIComponent(window.location.href)));
            jQuery('#rwd-share-twitter').attr('href', 'https://twitter.com/intent/tweet?text=&url=' + (encodeURIComponent(window.location.href)));
            jQuery('#rwd-share-googleplus').attr('href', 'https://plus.google.com/share?url=' + (encodeURIComponent(window.location.href)));
        }, 200);
    };
    _this.socialShare();
}

var video_galleries = [];
jQuery(document).ready(function () {
    jQuery(".main-playlist.view-playlist").each(function (i) {
        var id = jQuery(this).attr('id');
        video_galleries[i] = new Gallery_Video_Playlist(id);
    });
});

jQuery(window).load(function(){
    jQuery(".main-playlist.view-playlist").each(function (i) {
        var id = jQuery(this).attr('id');
            jQuery('ul#vid-list').height(jQuery('.playlist-container').width() * 9 / 16);
            jQuery('playlist-scroll').height(jQuery('.playlist-container').width() * 9 / 16);
            jQuery('.video-wrapper').height(jQuery('.playlist-container').width() * 9 / 16);
    });
});
