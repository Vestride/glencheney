/* Author:

*/
var Vurino = {
    
    currentYear : '1960',
    
    timeline : {
        0 : '1930',
        120 : '1940',
        240 : '1950',
        360 : '1960',
        480 : '1970',
        600 : '1980',
        720 : '1990',
        840 : '2000',
        960 : '2010' // problem, this only goes to 940... Grid needs to be redone.
    }
};

$(document).ready(function() {
    $('.timeline-playhead').draggable({
        axis : 'x',
        grid : [60, 50], // 60x, 50y
        containment: '.timeline-track',
        drag : function(event, ui) {
            $(this).parent().width(ui.position.left);
        },
        stop : function(event, ui) {
            if (Vurino.timeline.hasOwnProperty(ui.position.left) && Vurino.currentYear != Vurino.timeline[ui.position.left]) {
                $('.timeline').trigger('timeline', Vurino.timeline[ui.position.left]);
            }
        }
    });
    
    $('.timeline').on('timeline', function(evt, year) {
        $('[data-year="' + Vurino.currentYear + '"]').removeClass('current').fadeOut(function() {
            $('[data-year="' + year + '"]').fadeIn();
            Vurino.currentYear = year;
        });
    });
    
    $('.wine-gallery .gallery').simpleCarousel();
});


