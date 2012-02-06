var containerId = '#tabs-container';

var tabsId = '#tabs';
$(document).ready(function(){
     // Preload tab on page load
     if($(tabsId + ' LI.current A').length > 0){
          loadTab($(tabsId + ' LI.current A'));
     }
     $(tabsId + ' A'+':not(.noajax)').click(function(){
          if($(this).parent().hasClass('current')){ return false; }
          $(tabsId + ' LI.current').removeClass('current');
          $(this).parent().addClass('current');
          loadTab($(this));
          return false;
     });
});
function loadTab(tabObj){
     if(!tabObj || !tabObj.length){ return; }
     $(containerId).addClass('loading');
     $(containerId).fadeOut('fast');
     $(containerId).load(tabObj.attr('href')+'?ajax=true', function(){
          $(containerId).removeClass('loading');
          $(containerId).fadeIn('fast');
     });
}