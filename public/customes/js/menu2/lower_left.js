$(document).ready(function()
{
    //Food Image Animation
    var food_image_count = 0;
    var food_image_pause = 11000;

    setInterval(function()
    {
      $(".lowerLeft_product_image-"+food_image_count).removeClass('fadeInDown');
      $(".lowerLeft_product_image-"+food_image_count).addClass('fadeOut');

      $(".lowerLeft_price_tag-"+food_image_count).removeClass('fadeInUpBig');
      $(".lowerLeft_price_tag-"+food_image_count).addClass('fadeOut');

      setTimeout(function()
      {
        $(".lowerLeft_product_image-"+food_image_count).removeClass('animated fadeOut');
        $(".lowerLeft_product_image-"+food_image_count).addClass('hidden');

        $(".lowerLeft_price_tag-"+food_image_count).removeClass('animated fadeOut');
        $(".lowerLeft_price_tag-"+food_image_count+",.product_name-"+food_image_count).addClass('hidden');

        food_image_count++;

        $(".lowerLeft_product_image-"+food_image_count+",.product_name-"+food_image_count).removeClass('hidden');
        $(".lowerLeft_product_image-"+food_image_count).addClass('animated fadeInDown slower');

        $(".lowerLeft_price_tag-"+food_image_count).removeClass('hidden');
        $(".lowerLeft_price_tag-"+food_image_count).addClass('animated fadeInUpBig');

      }, 1500);

    }, food_image_pause);
});