@extends('layouts.app')
<!-- csrf token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>{{ config('app.name', 'Practical') }} | Product List</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0)" class="btn btn-info ml-3" id="add-product">Add New</a>
                    <button class="btn btn-danger m-1">Delete</button>
                </div>

                <div class="card-body">
                    @include('product-table')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Model For Add / Update -->
<div class="modal fade" id="product-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="productAddUpdate"></h4>
            </div>
            <div class="modal-body">
                <form id="product_form" name="product_form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="product_id" />
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Name" value="" maxlength="50" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">UPC</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="upc_no" name="upc_no" placeholder="Enter UPC" value="" maxlength="50" required="" maxlength="12" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" value="" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="status" name="status">
                                <option value="Active">Active</option>
                                <option value="Deactive">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input id="image" type="file" name="image" accept="image/*" onchange="readURL(this);"/>
                            <input type="hidden" name="hidden_image" id="hidden_image" />
                        </div>
                    </div>
                    <img id="img-preview" src="../no-image.png" alt="Preview" class="form-group hidden" width="100" height="100" />
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script >
$(document).ready(function() {    
    //  add product 
    $('#add-product').click(function() {
        $('#product_id').val('');
        $('#product_form').trigger("reset");
        $('#productAddUpdate').html("Add New Product");
        $('#product-modal').modal('show');
        $('#img-preview').attr('src', '../no-image.png');
    });

    // edit product
    $('body').on('click', '#edit-product', function() {
        var product_id = $(this).data('pid');
        $.ajax({
            type: "get",
            url: '/product-details/'+product_id,
            success: function(data) {
                $('#productAddUpdate').html("Edit Product");
                $('#product-modal').modal('show');
                $('#product_id').val(data.id);
                $('#product_name').val(data.name);
                $('#upc_no').val(data.upc);
                $('#price').val(data.price);
                $('#status').val(data.status);
                $('#img-preview').attr('alt', 'No image available');
                if (data.image) {
                    $('#img-preview').attr('src', '../storage/product/' + data.image);
                    $('#hidden_image').val(data.image);
                }
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });

    // delete product
    $('body').on('click', '#delete-product', function() {
        var product_id = $(this).data("pid");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (confirm("Are You sure want to delete this product !")) {
            $.ajax({
                type: "delete",
                url: '/product-delete/'+product_id,
                success: function(data) {
                    alert("Product deleted successfully");
                    $('#p_table').html(data.view);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});

// add/update product data
$('body').on('submit', '#product_form', function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var productData = new FormData(this);
    $.ajax({
        type: 'post',
        url: '{{ route('product.add-update') }}',
        data: productData,
        cache: false,
        contentType: false,
        processData: false,
        success: function( data ) {
            $('#product_form').trigger("reset");
            $('#product-modal').modal('hide');
            $('#p_table').html(data.view);
        },
        error: function(data) {
            console.log('error:', data);
        }
    });
});

function readURL(input) {
    id = '#img-preview';
    // alert(id);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(id).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
        $('#img-preview').removeClass('hidden');
    }
}
</script>
@endsection