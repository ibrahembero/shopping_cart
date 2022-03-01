@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <h2>Add New Product In Our Store</h2>
         {{-- begin of form --}}
         <form action="" id="offerForm"  method="POST">
            @csrf
            
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" id="name" name="name"  placeholder="Name of Product">
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" id="price" name="price"  placeholder="Price of Product">
            </div>
            <div class="form-group">
                <label for="">Category</label>
                <input type="text" class="form-control" id="category" name="category"  placeholder="Category of Product">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input type="text" class="form-control" id="description" name="description"  placeholder="Description of Product">
            </div>
            <div class="form-group">
                <label for="">Gallery</label>
                <input type="text" class="form-control" id="gallery" name="gallery"  placeholder="Gallery of Product">
            </div>
            <div class="alert alert-success" style="display: none"></div>
            <button id="ajaxSubmit" class="btn btn-primary">Add Product</button>
        </form>
         {{--end of form --}}
   

    
</div>
</div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function(){
               ////another jquery
               jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
               jQuery.ajax({
                    type: 'post',
                    url: "{{ route('save_product') }}",
                    data: {
                    name : $('#name').val(),
                    price : $('#price').val(),
                    category : $('#category').val(),
                    description : $('#description').val(),
                    gallery : $('#gallery').val(),
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
  
            });
            ///////////////////////////
            /////////////////////////
    </script>
    
@endsection