@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success" id="success_msg" role="alert">
        succefuly added
        
    </div>
    <form id="offerForm" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Offer Name</label>
            <input name="name" type="text" class="form-control" placeholder="Offer">
            <div id="nameError" class="text-danger"></div>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">{{__('messages.Offerprice')}}</label>
            <input name="price" type="text" class="form-control">
            <div id="priceError" class="text-danger"></div>
        </div>
        <div class="form-group">
            <label for="photo">Upload Image</label>
            <input name="photo" type="file" class="form-control">
            <div id="photoError" class="text-danger"></div>
        </div>
        <button id="saveOffer" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#saveOffer').click(function (e) {
            e.preventDefault();

            // Get form data
            var formData = new FormData($('#offerForm')[0]);

            // Send an AJAX request
            $.ajax({
                type: "POST",
                url: "{{ route('offer.storee') }}",
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting content type
                dataType: "json", // Expect JSON response

                success: function (response) {
                    if (response.success) {
                        $('#success_msg').show();
                    } else {
                        // Clear any previous error messages
                        $('#nameError').text(''); // Clear the 'name' error message
                        $('#priceError').text(''); // Clear the 'price' error message
                        $('#photoError').text(''); // Clear the 'photo' error message

                        // Handle validation errors and display them in the labels
                        $.each(response.errors, function (key, value) {
                            $('#' + key + 'Error').text(value[0]);
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("AJAX request failed.");
                }
            });
        });
    });
</script>
@endsection
