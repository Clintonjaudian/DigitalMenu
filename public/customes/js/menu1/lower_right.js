$(document).ready(function()
{
    //Food Image Animation
    var food_image_count = 0;
    var food_image_pause = 13000;
    var total_product = $("#upper_right_total_product").val();

    setInterval(function()
    {
      $(".lowerRight_product_image-"+food_image_count).removeClass('fadeInDown');
      $(".lowerRight_product_image-"+food_image_count).addClass('fadeOut');

      $(".lowerRight_price_tag-"+food_image_count).removeClass('fadeInUpBig');
      $(".lowerRight_price_tag-"+food_image_count).addClass('fadeOut');

      setTimeout(function()
      {
        $(".lowerRight_product_image-"+food_image_count).removeClass('animated fadeOut');
        $(".lowerRight_product_image-"+food_image_count).addClass('hidden');

        $(".lowerRight_price_tag-"+food_image_count).removeClass('animated fadeOut');
        $(".lowerRight_price_tag-"+food_image_count+",.product_right_name-"+food_image_count).addClass('hidden');

        food_image_count++;
        if(food_image_count == total_product)
        {
          food_image_count = 0;
        }

        $(".lowerRight_product_image-"+food_image_count+",.product_right_name-"+food_image_count).removeClass('hidden');
        $(".lowerRight_product_image-"+food_image_count).addClass('animated fadeInDown slower');

        $(".lowerRight_price_tag-"+food_image_count).removeClass('hidden');
        $(".lowerRight_price_tag-"+food_image_count).addClass('animated fadeInUpBig');

      }, 1500);

    }, food_image_pause);
});