$(document).ready(function()
		{
			var upper_right_total_product = $("#upper_right_total_product").val();
			var upper_left_total_product = $("#upper_left_total_product").val();
			var upper_right_margin_top = 8;
			var upper_right_max_width = 40;
			var upper_right_product_img_left = 2;
			var upper_right_price_tag_left = 35;

			if(upper_right_total_product >= 2)
			{
				for(var i = 2; i <= upper_right_total_product; i++)
				{
					upper_right_margin_top += 6;
					upper_right_max_width -= 4;
					upper_right_product_img_left += 2;
				}

				upper_right_price_tag_left -= upper_right_total_product;

				$('.upper_right_product_img').css({'margin-top': upper_right_margin_top+'vh', 'max-width': upper_right_max_width+'vw', 
				'left': upper_right_product_img_left+'vw'});

				$('.upper_right_price_tag').css({'left': upper_right_price_tag_left+'vw'});
			}

			// Rectangle Animation
			var  upper_right_count = 0;
			var  upper_right_image_count = 0;
			var  upper_right_pause = 13000;
			var  upper_right_animationSpeed = 1300;

			var  upper_right_slider = upper_right_total_product * 6;

			$('.upper_right_slider').css('height',  upper_right_slider+'vh');
			
			setInterval(function()
			{
				$(".upper_right_rect_slider").animate({'top':'+=38px'},  upper_right_animationSpeed, function()
				{
					upper_right_count++;

					if(upper_right_total_product >= upper_left_total_product)
					{
						if(upper_right_count == upper_right_total_product)
						{
							location.reload();
						}
					}

					if(upper_right_count == upper_right_total_product)
					{
						upper_right_count = 0;
						$('.upper_right_rect_slider').css('top', 0);
						// location.reload();
					}
				});

				$(".upper_right_product_image-"+upper_right_image_count).removeClass('slideInRight');
				$(".upper_right_product_image-"+upper_right_image_count).addClass('fadeOut');

				$(".upper_right_price_tag-"+upper_right_image_count).removeClass('fadeInUp');
				$(".upper_right_price_tag-"+upper_right_image_count).addClass('fadeOut');

				setTimeout(function()
				{
					$(".upper_right_product_image-"+upper_right_image_count).removeClass('animated fadeOut');
					$(".upper_right_product_image-"+upper_right_image_count).addClass('hidden');

					$(".upper_right_price_tag-"+upper_right_image_count).removeClass('animated fadeOut');
					$(".upper_right_price_tag-"+upper_right_image_count).addClass('hidden');

					upper_right_image_count++;

					if(upper_right_image_count == upper_right_total_product)
					{
						upper_right_image_count = 0;
					}

					$(".upper_right_product_image-"+upper_right_image_count).removeClass('hidden');
					$(".upper_right_product_image-"+upper_right_image_count).addClass('animated slideInRight');

					$(".upper_right_price_tag-"+upper_right_image_count).removeClass('hidden');
					$(".upper_right_price_tag-"+upper_right_image_count).addClass('animated fadeInUp');

				}, 1000);
	   
			}, upper_right_pause);

		});