$(document).ready(function()
		{
			var total_product = $("#upper_left_total_product").val();
			var upper_right_total_product = $("#upper_right_total_product").val();
			var margin_top = 8;
			var max_width = 40;
			var product_img_left = 2;
			var price_tag_left = 35;

			if(total_product >= 2)
			{
				for(var i = 2; i <= total_product; i++)
				{
					margin_top += 6;
					max_width -= 4;
					product_img_left += 2;
				}

				price_tag_left -= total_product;

				$('.upper_left_product_img').css({'margin-top': margin_top+'vh', 'max-width': max_width+'vw', 
				'left': product_img_left+'vw'});

				$('.upper_left_price_tag').css({'left': price_tag_left+'vw'});
			}

			// Rectangle Animation
			var  upper_left_count = 0;
			var  food_image_count = 0;
			var  upper_left_pause = 10000;
			var  upper_left_animationSpeed = 1300;

			var slider = total_product * 6;

			$('.upper_left_slider').css('height', slider+'vh');
			
			setInterval(function()
			{
				$(".upper_left_rect_slider").animate({'top':'+=38px'},  upper_left_animationSpeed, function()
				{
					upper_left_count++;

					if(total_product >= upper_right_total_product)
					{ 
						if(upper_left_count == total_product)
						{
							location.reload();
						}
					}

					if(upper_left_count == total_product)
					{
						upper_left_count = 0;
						$('.upper_left_rect_slider').css('top', 0);
						// location.reload();
					}
				});

				$(".upper_left_product_image-"+food_image_count).removeClass('slideInLeft');
				$(".upper_left_product_image-"+food_image_count).addClass('fadeOut');

				$(".upper_left_price_tag-"+food_image_count).removeClass('fadeInUp');
				$(".upper_left_price_tag-"+food_image_count).addClass('fadeOut');

				setTimeout(function()
				{
					$(".upper_left_product_image-"+food_image_count).removeClass('animated fadeOut');
					$(".upper_left_product_image-"+food_image_count).addClass('hidden');

					$(".upper_left_price_tag-"+food_image_count).removeClass('animated fadeOut');
					$(".upper_left_price_tag-"+food_image_count).addClass('hidden');

					food_image_count++;

					if(food_image_count == total_product)
					{
						food_image_count = 0;
					}

					$(".upper_left_product_image-"+food_image_count).removeClass('hidden');
					$(".upper_left_product_image-"+food_image_count).addClass('animated slideInLeft');

					$(".upper_left_price_tag-"+food_image_count).removeClass('hidden');
					$(".upper_left_price_tag-"+food_image_count).addClass('animated fadeInUp');

				}, 1000);
			},   upper_left_pause);
			
		});