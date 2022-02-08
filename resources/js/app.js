// JavaScript Document

$('a[data-showid]').click(function(){
    $('#'+$(this).data('showid')).show();
    $(this).remove();
})