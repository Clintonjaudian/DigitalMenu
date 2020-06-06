@extends('layouts.backend.menu2')

@push('css')
  <link rel="stylesheet" href="{{asset('customes/css/menu2/menu2.css')}}">
@endpush

@section('content')
  {{-- Upper --}}
  <div class="container-fluid">
   <div class="row upper">
     {{-- Upper Left --}}
    <div class="col-md-4 col-lg-4 col-xl-4 container-md container-lg container-xl" id="upper-left-side">
     <div class="col-12 pb-3" id="restaurant-name">
      <img src="{{URL::to('/')}}/customes/images/name.png" class="img-fluid animated zoomInDown" width="100%">
     </div>

     <div class="table-responsive-md table-responsive-lg table-responsive-xl container-md container-lg container-xl" style="padding-left: 1%">
      <table class="col-12">
        @forelse ($upper_data as $item)
            <tr>
              <th><p class="font-weight-bold lead upper-table pl-2">{{$item->product}}</p></th>
            </tr>
        @empty
            <tr>
              <th colspan="1"><h3>No Product Available</h3></th>
            </tr>
        @endforelse
      </table>
     </div>

      {{-- Slider
      ================================================== --}}
      <div class="col-12 slider_container">
        <div class="col-12 slider">
            <div class="rect_slider"></div>
        </div>
      </div>
    </div>

    {{-- Upper Inner --}}
    @php
    $count = count($upper_data);
    @endphp

    <input type="hidden" id="upper_total_product" value="{{$count}}">

    <div class="col-md-5 col-lg-5 col-xl-5 container-md container-lg container-xl" id="upper-left-inner-side">
     <div class="col-12">
      <img src="{{URL::to('/')}}/customes/images/logo.png" class="img-fluid animated zoomInDown" id="logo" width="25%">

      <div class="col-12">
        <img src="{{URL::to('/')}}/assets/images/{{$upper_data[0]->food_image}}" class="img-fluid animated fadeInDown upper_product_image-0 upper-inner-product-img" width="95%">
        
        @for ($i = 1; $i < $count; $i++)
        <img src="{{URL::to('/')}}/assets/images/{{$upper_data[$i]->food_image}}" class="img-fluid upper_product_image-{{$i}} hidden upper-inner-product-img" width="95%">
        @endfor
      </div>

      <div class="col-12">
        <img src="{{URL::to('/')}}/assets/images/{{$upper_data[0]->original_price}}" class="img-fluid animated fadeInUpBig upper_inner_price_tag-0 upper-inner-price-tag" width="24%">
      
        @for ($i = 1; $i < $count; $i++)
        <img src="{{URL::to('/')}}/assets/images/{{$upper_data[$i]->original_price}}" class="img-fluid upper_inner_price_tag-{{$i}} hidden  upper-inner-price-tag" width="24%">
        @endfor
      </div>

     </div>
    </div>

    {{-- Upper Right --}}
    <div class="col-md-3 col-lg-3 col-xl-3 container-md container-lg container-xl" id="upper-right-side">

      {{-- addon box --}}
      <div class="col-12 box animated slideInRight">
        <div class="text" id="right_side"></div>
        <div class="image"></div>
      </div>
  
    </div>
   </div>
  </div>


  {{-- Lower 
  ===================================================--}}
  <div class="container-fluid">
    <div class="row lower">
      {{-- Lower Left --}}
      <div class="col-md-4 col-lg-4 col-xl-4 container-md container-lg container-xl" id="lower-left-side">
        <div class="col-12" id="lower-left-clasification">
          {{$lower_left_data->classification}}
        </div>

        <div class="col-12 pl-3" id="lower-left-product-name">
          <small>({{$lower_left_data->product_name}}<span class="product_name-0">&nbsp;w/ {{$upper_data[0]->product}}</span>
            @for ($i = 1; $i < $count; $i++)
              <span class="product_name-{{$i}} hidden">&nbsp;w/ {{$upper_data[$i]->product}}</span>
            @endfor
          )</small>
        </div>

        <div class="row">
          <div class="col-4 container-md container-lg container-xl drink">
            <img src="{{URL::to('/')}}/assets/images/{{$lower_left_data->image_addon}}" class="img-fluid" id="lower-left-img-drink">
          </div>

          <div class="col-5 container-md container-lg container-xl" id="lowerLeft_food_image">

            <img src="{{URL::to('/')}}/assets/images/{{$upper_data[0]->food_image}}" class="img-fluid animated fadeInDown slower lowerLeft_product_image-0 lower-left-img-food">
        
            @for ($i = 1; $i < $count; $i++)
              <img src="{{URL::to('/')}}/assets/images/{{$upper_data[$i]->food_image}}" class="img-fluid lowerLeft_product_image-{{$i}} hidden lower-left-img-food">
            @endfor
          </div>

          <div class="col-3 container-md container-lg container-xl">

            <img src="{{URL::to('/')}}/assets/images/{{$upper_data[0]->dou_price}}" class="img-fluid animated fadeInUpBig lowerLeft_price_tag-0 lower-left-price-tag">
      
            @for ($i = 1; $i < $count; $i++)
            <img src="{{URL::to('/')}}/assets/images/{{$upper_data[$i]->dou_price}}" class="img-fluid lowerLeft_price_tag-{{$i}} hidden  lower-left-price-tag">
            @endfor
          </div>
        </div>

      </div>

      {{-- Lower Inner --}}
      <div class="col-md-5 col-lg-5 col-xl-5 container-md container-lg container-xl" id="lower-left-inner-side">
        <div class="col-12" id="lower-inner-clasification">
          {{$lower_inner_data->classification}}
        </div>

        <div class="col-12 pl-3" id="lower-inner-product-name">
          <small>({{$lower_inner_data->product_name}}<span class="product_name-0">&nbsp;w/ {{$upper_data[0]->product}}</span>
            @for ($i = 1; $i < $count; $i++)
              <span class="product_name-{{$i}} hidden">&nbsp;w/ {{$upper_data[$i]->product}}</span>
            @endfor
          )</small>
        </div>

        <div class="row">
          <div class="col-3 container-md container-lg container-xl">
            <img src="{{URL::to('/')}}/assets/images/{{$lower_inner_data->image_addon1}}" class="img-fluid" id="lower-inner-drinks">
          </div>

          <div class="col-3 container-md container-lg container-xl add_on">
            <img src="{{URL::to('/')}}/assets/images/{{$lower_inner_data->image_addon2}}" class="img-fluid"  id="lower-inner-add_on">
          </div>

          <div class="col-3 container-md container-lg container-xl" id="lowerInner_food_image">

            <img src="{{URL::to('/')}}/assets/images/{{$upper_data[0]->food_image}}" class="img-fluid animated fadeInDown slower lowerInner_product_image-0 lower-inner-food">
        
            @for ($i = 1; $i < $count; $i++)
              <img src="{{URL::to('/')}}/assets/images/{{$upper_data[$i]->food_image}}" class="img-fluid lowerInner_product_image-{{$i}} hidden lower-inner-food">
            @endfor
          </div>

          <div class="col-3 container-md container-lg container-xl">

            <img src="{{URL::to('/')}}/assets/images/{{$upper_data[0]->trio_price}}" class="img-fluid animated fadeInUpBig lowerInner_price_tag-0 lower-inner-price-tag">
      
            @for ($i = 1; $i < $count; $i++)
              <img src="{{URL::to('/')}}/assets/images/{{$upper_data[$i]->trio_price}}" class="img-fluid lowerInner_price_tag-{{$i}} hidden  lower-inner-price-tag">
            @endfor
          </div>
        </div>
      </div>

      {{-- Lower Right --}}
      <div class="col-md-3 col-lg-3 col-xl-3 container-md container-lg container-xl" id="lower-right-side">
        <div class="col-3 price_tag animated fadeIn"></div>
      </div>
    </div>
  </div>

@endsection

@push('js')

    {{-- Right Side --}}
    <script>
      $(document).ready(function()
      {
        var count = 0;
        var num;

        right_side(count);

        setInterval(function()
        {
          count++;

          $(".box").removeClass('animated slideInRight');
          $(".box").addClass('animated fadeOut');

          $(".price_tag").removeClass('animated fadeIn');
          $(".price_tag").addClass('animated fadeOut');

          right_side(count);

          if(num == count)
          {
            count = -1;
          }

        }, 10000);

        function right_side(count)
        {
          $.ajax(
          {
            url:"{{route('menu_dashboard_2')}}",
            method:'get',
            dataType:'json',
            success:function(data)
            { 
              num = parseInt(data.right_side_data.length - 1);

              var output ='<p class="classification">'+data.right_side_data[count].classification+'</p>'+
                '<small class="addon"></small>';

                  addon_data(data.right_side_data[count].id);
                  
              var image = '<img src="{{ URL::to("/") }}/assets/images/'+data.right_side_data[count].product_image+'" class="img-fluid right_side_image" width="100%">';
              var price_tag = '<img src="{{URL::to("/")}}/assets/images/'+data.right_side_data[count].price_tag+'" class="img-fluid" id="right-side-price-tag">';

              $("#right_side").html(output);
              $('.image').html(image);
              $('.price_tag').html(price_tag);

              setTimeout(function()
              {
                $(".box").removeClass('animated fadeOut');
                $(".box").addClass('animated slideInRight');

                $(".price_tag").removeClass('animated fadeOut');
                $(".price_tag").addClass('animated fadeIn');
                
              }, 1500);
            }
          });
        }

        function addon_data(id)
        {
          $.ajax(
            {
              url:"{{route('addon_data')}}",
              method:'post',
              data:{
                id:id,
                '_token':'{{csrf_token()}}'
              },
              dataType:'json',
              success:function(data)
              {
                var addon = '';

                if(data.addon_data.length > 0)
                {
                for(var i = 0; i<data.addon_data.length; i++)
                {
                  addon += '<span class="addons">'+data.addon_data[i].pcs+' '+data.addon_data[i].add_on+'</span><br>';
                }
                }
                else
                {
                addon += '<center>No Data Available</center>';
                }

                $('.addon').html(addon);
              }
            });
        }

      });
    </script>

    <script src="{{asset('customes/js/menu2/upper_left.js')}}"></script>
    <script src="{{asset('customes/js/menu2/upper_inner.js')}}"></script>
    <script src="{{asset('customes/js/menu2/lower_left.js')}}"></script>
    <script src="{{asset('customes/js/menu2/lower_inner.js')}}"></script>
@endpush