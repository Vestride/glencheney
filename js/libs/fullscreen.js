var fullscreenImage = function() {
    $('.project .project-desc').click(function() {
        // put in container div with overflow hidden?
        var $mask = $('<div></div>', {"class": "blockbox-mask", style : "cursor: pointer;"}),
            $projectImg = $('.project-img'),
            imgUrl = $projectImg.attr('data-full'),
            imgWidth = $projectImg.attr('data-full-width'),
            imgHeight = $projectImg.attr('data-full-height'),
            isLandscape = imgWidth > imgHeight,
            $img = $('<img>', {src : imgUrl, alt : 'Full view', title : 'click to close'}),
            $div = $('<div></div>', {style : 'overflow:hidden;text-align:center;'});

        // Make sure the image will fit in the window
        if (isLandscape) {
            if (imgWidth > $(window).width()) {
                $img.width($(window).width());
                $div.height($(window).height());
            }
        } else {
            if (imgHeight > $(window).height()) {
                $img.height($(window).height());
                $div.width($(window).width());
            }
        }

        // Clicking anywhere will remove everything
        $mask.click(function(){
            $(this).remove();
        });

        $div.append($img)
        $mask.append($div);
        $('body').append($mask);
    });
}