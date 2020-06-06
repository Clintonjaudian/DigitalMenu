$(document).ready(function()
{
    //Food Image Animation
    var food_image_count = 0;
    var food_image_pause = 11000;

    setInterval(function()
    {
      $(".lowerInner_product_image-"+food_image_count).removeClass('fadeInDown');
      $(".lowerInner_product_image-"+food_image_count).addClass('fadeOut');

      $(".lowerInner_price_tag-"+food_image_count).removeClass('fadeInUpBig');
      $(".lowerlowerInner_price_tagLeft_price_tag-"+food_image_count).addClass('fadeOut');

      setTimeout(function()
      {
        $(".lowerInner_product_image-"+food_image_count).removeClass('animated fadeOut');
        $(".lowerInner_product_image-"+food_image_count).addClass('hidden');

        $(".lowerInner_price_tag-"+food_image_count).removeClass('animated fadeOut');
        $(".lowerInner_price_tag-"+food_image_count).addClass('hidden');

        food_image_count++;

        $(".lowerInner_product_image-"+food_image_count).removeClass('hidden');
        $(".lowerInner_product_image-"+food_image_count).addClass('animated fadeInDown slower');

        $(".lowerInner_price_tag-"+food_image_count).removeClass('hidden');
        $(".lowerInner_price_tag-"+food_image_count).addClass('animated fadeInUpBig');

      }, 1300);

    }, food_image_pause);
});