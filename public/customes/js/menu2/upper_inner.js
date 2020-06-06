$(document).ready(function()
{
     //Food Image Animation
     var food_image_count = 0;
     var food_image_pause = 10000;
     var effectsEnd = 'animationend oAnimationEnd mozAnimationEnd webkitAnimationEnd';

     setInterval(function()
     {
       $(".upper_product_image-"+food_image_count).removeClass('fadeInDown');
       $(".upper_product_image-"+food_image_count).addClass('fadeOut');

       $(".upper_inner_price_tag-"+food_image_count).removeClass('fadeInUp');
       $(".upper_inner_price_tag-"+food_image_count).addClass('fadeOut');

       setTimeout(function()
       {
         $(".upper_product_image-"+food_image_count).removeClass('animated fadeOut');
         $(".upper_product_image-"+food_image_count).addClass('hidden');

         $(".upper_inner_price_tag-"+food_image_count).removeClass('animated fadeOut');
         $(".upper_inner_price_tag-"+food_image_count).addClass('hidden');

         food_image_count++;

         $(".upper_product_image-"+food_image_count).removeClass('hidden');
         $(".upper_product_image-"+food_image_count).addClass('animated fadeInDown slower');

         $(".upper_inner_price_tag-"+food_image_count).removeClass('hidden');
         $(".upper_inner_price_tag-"+food_image_count).addClass('animated fadeInUp');

       }, 1300);

     }, food_image_pause);
});