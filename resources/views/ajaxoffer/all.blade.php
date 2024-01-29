@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.OfferName')}}</th>
                <th scope="col">{{__('messages.Offerprice')}}</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $of)
            <tr>
                <th scope="row">{{$of->id}}</th>
                <td>{{$of->name}}</td>
                <td>{{$of->price}}</td>
                <td>
                    <a class="btn btn-l" href="{{route('ajax.edit',$of->id)}}" role="button">Edit</a>
                    <a class="btn btn-delete" data-offid="{{$of->id}}" href="#" role="button">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('scripts')
<script>
    $(document).ready(function () {
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            var offid = $(this).data('offid'); // Use $(this) to reference the clicked element
            var $row = $(this).closest('tr');
            $.ajax({
                type: "POST",
                url: "{{ route('ajax.delete') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': offid
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $row.remove();
                        $('#success_msg').show();
                      
                        // Optionally, you can redirect or perform other actions here
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
