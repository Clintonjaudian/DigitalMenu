@extends('layouts.backend.menu1')

@push('css')
  <link rel="stylesheet" href="{{asset('customes/css/menu1/menu1.css')}}">
@endpush

@section('content')
	{{-- Upper --}}
	<div class="container-fluid">
		<div class="row upper">
			{{-- Upper Left --}}
			<div class="col-md-6 col-lg-6 col-xl-6 container-md container-lg container-xl" id="upper_left">
				<div class="table-responsive-md table-responsive-lg table-responsive-xl container-md container-lg container-xl upper_left_table">
					<table class="col-12">
						@forelse ($upper_left_data as $item)
							<tr>
								<th><p class="font-weight-bold lead upper_left_tr pl-2">{{$item->product_name}} <span class="float-right"><sup>&#x20b1;</sup>{{$item->price}}</span></p></th>
							</tr>
						@empty
							<tr>
								<th colspan="1"><h3>No Product Available</h3></th>
							</tr>
						@endforelse
					</table>
				 </div>

				 @php
				 $count = count($upper_left_data);
				 @endphp

				<input type="hidden" id="upper_left_total_product" value="{{$count}}">

				 <div class="row">
					<div class="col-12">
						<img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[0]->food_image}}" class="img-fluid animated slideInLeft upper_left_product_image-0 upper_left_product_img">
					
						@for ($i = 1; $i < $count; $i++)
						<img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[$i]->food_image}}" class="img-fluid upper_left_product_image-{{$i}} hidden upper_left_product_img">
						@endfor
					</div>
		
					<div class="col-12">
						<img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[0]->price_tag}}" class="img-fluid animated fadeInUpBig slower upper_left_price_tag-0 upper_left_price_tag">
					
						@for ($i = 1; $i < $count; $i++)
						<img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[$i]->price_tag}}" class="img-fluid upper_left_price_tag-{{$i}} hidden  upper_left_price_tag">
						@endfor
					</div>
				 </div>

				{{-- Slider
				================================================== --}}
				<div class="col-12 upper_left_slider_container">
					<div class="col-12  upper_left_slider">
						<div class=" upper_left_rect_slider"></div>
					</div>
				</div>
			</div>

			{{-- Upper Right --}}
			<div class="col-md-6 col-lg-6 col-xl-6 container-md container-lg container-xl" id="upper_right">
				<div class="table-responsive-md table-responsive-lg table-responsive-xl container-md container-lg container-xl upper_right_table">
					<table class="col-12">
						@forelse ($upper_right_data as $item)
							<tr>
								<th><p class="font-weight-bold lead upper_right_tr pl-2">{{$item->product_name}} <span class="float-right"><sup>&#x20b1;</sup>{{$item->price}}</span></p></th>
							</tr>
						@empty
							<tr>
								<th colspan="1"><h3>No Product Available</h3></th>
							</tr>
						@endforelse
					</table>
				 </div>

				 @php
				  $upper_right_total_product = count($upper_right_data);
				 @endphp

				 <input type="hidden" id="upper_right_total_product" value="{{$upper_right_total_product}}">

				 <div class="row">
					<div class="col-12">
						<img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[0]->food_image}}" class="img-fluid animated slideInRight upper_right_product_image-0 upper_right_product_img">
					
						@for ($i = 1; $i < $upper_right_total_product; $i++)
						<img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[$i]->food_image}}" class="img-fluid upper_right_product_image-{{$i}} hidden upper_right_product_img">
						@endfor
					</div>
		
					<div class="col-12">
						<img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[0]->price_tag}}" class="img-fluid animated fadeInUpBig slower upper_right_price_tag-0 upper_right_price_tag">
					
						@for ($i = 1; $i < $upper_right_total_product; $i++)
						<img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[$i]->price_tag}}" class="img-fluid upper_right_price_tag-{{$i}} hidden  upper_right_price_tag">
						@endfor
					</div>
				 </div>

				 {{-- Slider
				================================================== --}}
				<div class="col-12 upper_right_slider_container">
					<div class="col-12  upper_right_slider">
						<div class=" upper_right_rect_slider"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Lower --}}
	<div class="container-fluid">
		<div class="row lower">
			{{-- Lower Left --}}
			<div class="col-md-6 col-lg-6 col-xl-6 container-md container-lg container-xl" id="lower_left">
			 <div class="row">
				<div class="col-5">
					<div class="col-12" id="lower_left_clasification">
						{{$lower_left_data->classification}}
					</div>
	   
					<div class="col-12 pl-3" id="lower_left_product_name">
						<small>({{$lower_left_data->product_name}}<span class="product_name-0">&nbsp;w/ {{$upper_left_data[0]->product_name}}</span>
							@for ($i = 1; $i < $count; $i++)
								<span class="product_name-{{$i}} hidden">&nbsp;w/ {{$upper_left_data[$i]->product_name}}</span>
							@endfor
						)</small>
					</div>
				</div>
	
				<div class="col-7 row">
					<div class="col-3 container-md container-lg container-xl price_tag">
						<img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[0]->dou_price}}" class="img-fluid animated fadeInUpBig lowerLeft_price_tag-0 lower_left_price_tag">
			 
						@for ($i = 1; $i < $count; $i++)
						 <img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[$i]->dou_price}}" class="img-fluid lowerLeft_price_tag-{{$i}} hidden  lower_left_price_tag">
						@endfor
					</div>

					<div class="col-4 container-md container-lg container-xl addon">
						<img src="{{URL::to('/')}}/assets/images/{{$lower_left_data->image_addon}}" class="img-fluid lower_left_addon">
					</div>
	
					<div class="col-5 container-md container-lg container-xl food_image">
						<img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[0]->food_image}}" class="img-fluid animated fadeInDown slower lowerLeft_product_image-0 lower_left_img_food">
				 
						@for ($i = 1; $i < $count; $i++)
							<img src="{{URL::to('/')}}/assets/images/{{$upper_left_data[$i]->food_image}}" class="img-fluid lowerLeft_product_image-{{$i}} hidden lower_left_img_food">
						@endfor
					</div>
				</div>
			 </div>
			</div>
			 
			{{-- Lower Right --}}
			<div class="col-md-6 col-lg-6 col-xl-6 container-md container-lg container-xl" id="lower_right">
				<div class="row">
					<div class="col-5">
						<div class="col-12" id="lower_right_clasification">
							{{$lower_right_data->classification}}
						</div>
		   
						<div class="col-12 pl-3" id="lower_right_product_name">
							<small>({{$lower_right_data->product_name}}<span class="product_right_name-0">&nbsp;w/ {{$upper_right_data[0]->product_name}}</span>
								@for ($i = 1; $i < $upper_right_total_product; $i++)
									<span class="product_right_name-{{$i}} hidden">&nbsp;w/ {{$upper_right_data[$i]->product_name}}</span>
								@endfor
							)</small>
						</div>
					</div>
		
					<div class="col-7 row">
						<div class="col-3 container-md container-lg container-xl price_tag">
							<img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[0]->dou_price}}" class="img-fluid animated fadeInUpBig lowerRight_price_tag-0 lower_right_price_tag">
				 
							@for ($i = 1; $i < $upper_right_total_product; $i++)
							 <img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[$i]->dou_price}}" class="img-fluid lowerRight_price_tag-{{$i}} hidden  lower_right_price_tag">
							@endfor
						</div>
	
						<div class="col-4 container-md container-lg container-xl addon">
							<img src="{{URL::to('/')}}/assets/images/{{$lower_right_data->image_addon}}" class="img-fluid lower_right_addon">
						</div>
		
						<div class="col-5 container-md container-lg container-xl food_image">
							<img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[0]->food_image}}" class="img-fluid animated fadeInDown slower lowerRight_product_image-0 lower_right_img_food">
					 
							@for ($i = 1; $i < $upper_right_total_product; $i++)
								<img src="{{URL::to('/')}}/assets/images/{{$upper_right_data[$i]->food_image}}" class="img-fluid lowerRight_product_image-{{$i}} hidden lower_right_img_food">
							@endfor
						</div>
					</div>
				</div>
			</div>
	 </div>
	</div>
@endsection

@push('js')
	<script src="{{asset('customes/js/menu1/upper_left.js')}}"></script>
	<script src="{{asset('customes/js/menu1/upper_right.js')}}"></script>
	<script src="{{asset('customes/js/menu1/lower_left.js')}}"></script>
	<script src="{{asset('customes/js/menu1/lower_right.js')}}"></script>
@endpush