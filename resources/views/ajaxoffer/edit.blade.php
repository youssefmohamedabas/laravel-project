@extends('layouts.app')
@section('content')
<!DOCTYPE html>


<form method="POST" id="update" action="">
    @csrf

    <div class="form-group">
        <label for="name">{{ __('messages.OfferName') }}</label>
        <input value="{{ $o->id }}" name="id" type="text" class="form-control" style="display: none">
        <input value="{{ $o->name }}" name="name" type="text" class="form-control" placeholder="Offer">
        @error('name')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">{{ __('messages.Offerprice') }}</label>
        <input value="{{ $o->price }}" name="price" type="text" class="form-control">
        @error('price')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>

    <button id="update_offer" class="btn btn-primary">{{ __('messages.save') }}</button>
</form>

  @stop
  @section('scripts')
<script>
    $(document).ready(function () {
    $('#update_offer').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#update')[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('ajax.update') }}",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    // Optionally, you can redirect or perform other actions here
                    $('#success_msg').show();
                } else {
                    alert("Error: " + response.error);
                    // Handle errors if needed
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("AJAX request failed.");
                // Handle AJAX errors here
            }
        });
    });
});

</script>
@endsection