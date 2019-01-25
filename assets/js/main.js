(function($) {
    "use strict";
    $(document).ready(function() {
//        $('.apps-area-start').ripples({
//            dropRadius: 25,
//            perturbance: 0.10,
//            
//        });
        
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
        
        $('#msg-close').click(function(){
            $('#msg-close').animate('maxHeight','0');
            $('#msg-close').css('display','none');
        });
        
        
    });
}(jQuery));