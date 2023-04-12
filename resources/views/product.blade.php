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
                            <input id="image" type="file" name="image" accept="image/*" />
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
var all_product = {{ count($all_product) }};
$(document).ready(function() {
    
    //  add product 
    $('#add-product').click(function() {
        $('#product_id').val('');
        $('#product_form').trigger("reset");
        $('#productAddUpdate').html("Add New Product");
        $('#product-modal').modal('show');
        $('#img-preview').attr('src', '../no-image.png');
    });
});
</script>
@endsection