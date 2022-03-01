@extends('layouts.app')
@section('sec')
<?php
        use App\Http\Controllers\ProductController;
        $total = ProductController::cartItem();
        ?>
       
     cart (<span class="total">{{$total}}</span> )  
@stop
@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <h2>All Products In Our Store</h2>

    <div class="alert alert-success" style="display: none"></div>

    @if($products->count()>0)
    @foreach ($products as $product)
        <div class="card mt-3" style="width: 18rem; margin-left: 15px;">
            <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <h6 class="card-subtitle mb-2 text-muted">price : {{$product->price}}</h6>
            <p class="card-text">{{$product->description}}</p>
            {{-- <a href="{{route('detail',$product->id)}}" class="card-link">product detail</a> --}}
            @if(!$product->flag) 
            <form action="" method="POST">
                @csrf
                <input type="hidden" product_id="{{$product->id}}" name="product_id" value="{{$product->id}}">
                <button product_id="{{$product->id}}" product_flag="1"  class="add_btn btn btn-primary">Add To Cart</button> 
            </form>
            @else
            <form action="" method="POST">
                @csrf
                <button product_id="{{$product->id}}" product_flag="0" class="remove_btn btn btn-primary">remove from Cart</button>
            </form>
            @endif 
            </div>
        </div>
    @endforeach
    @else
      <p>there is no products to show</p>  
    @endif
</div>
</div>
</div>
@stop
@section('scripts')
    <script type="text/javascript">
    jQuery(document).ready(function(){
               ////another jquery
               jQuery('.add_btn').click(function(e){
               e.preventDefault();
               var product_id = $(this).attr('product_id');
               var product_flag = $(this).attr('product_flag');
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                    type: 'post',
                    url: "{{ route('add-to-cart') }}",
                    data: {
                        'product_id' : product_id,
                        'product_flag' : product_flag,
                    },
                    success: function(data){
                        if(data.status){ 
                            jQuery('.alert').show();
                            jQuery('.alert').html(data.msg);
                            window.location.href = "products";
                        }
                       
                    },
                    error: function(result){
                        console.log(result.responseText);
                    }
                    });
               });
               //end of another
               ////delete
               jQuery('.remove_btn').click(function(e){
               e.preventDefault();
               var product_id = $(this).attr('product_id');
               var product_flag = $(this).attr('product_flag');
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                    type: 'post',
                    url: "{{ route('remove-from-cart') }}",
                    data: {
                        'product_id' : product_id,
                        'product_flag' : product_flag,
                    },
                    success: function(data){
                        if(data.status){
                            jQuery('.alert').show();
                            jQuery('.alert').html(data.msg);
                            window.location.href = "products";
                        }
                       
                    },
                    error: function(result){
                        console.log(result.responseText);
                    }
                    });
               });
               //end of delete
               
            });
            ///////////////////////////
            /////////////////////////
    </script>
    
@endsection