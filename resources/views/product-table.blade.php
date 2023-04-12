<table class="table table-striped" id="p_table">
    <thead>
        <tr class="text-center">
        <th scope="col">Id</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">UPC</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(sizeof($all_product) > 0)
            @foreach($all_product as $product)
            <tr id="row_id_{{$product['id']}}" class="text-center">
                <td scope="row">{{$product['id']}}</td>
                <td><img src="../storage/product/{{$product['image']}}" alt="{{$product['name']}}" class="img-responsive" width="100" /></td>
                <td>{{$product['name']}}</td>
                <td>{{$product['price']}}</td>
                <td>{{$product['upc']}}</td>
                <td>{{$product['status']}}</td>
                <td>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-pid="{{ $product['id'] }}" data-original-title="Edit" class="edit btn btn-success edit-product" id="edit-product">
                        Edit
                    </a>
                    &nbsp;&nbsp;
                    <a href="javascript:void(0);" id="delete-product" data-toggle="tooltip" data-original-title="Delete" data-pid="{{ $product['id'] }}" class="delete btn btn-danger">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        @else
            <tr id="no_data">
                <td colspan=8 align="center">No Product Found !</td>
            </tr>
        @endif
    </tbody>
</table>