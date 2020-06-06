$(document).ready(function()
{
    var total_product = $("#upper_total_product").val();

    // Rectangle Animation
    var rect_slider_count = 0;
    var rect_slider_pause = 9800;
    var rect_slider_animationSpeed = 1000;

    var slider = total_product * 7.08;

    $('.slider').css('height', slider+'vh');
        
    setInterval(function()
    {
        $(".rect_slider").animate({'top':'+=7vh'}, rect_slider_animationSpeed, function()
        {
        rect_slider_count++;

        if(rect_slider_count == total_product)
        {
            // rect_slider_count = 0;
            // $('.rect_slider').css('top', 0);
            location.reload();
        }
        });
    },  rect_slider_pause);
});