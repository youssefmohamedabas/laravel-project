


<table class="table">
    <thead>
      <tr>
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li class="nav-item active">
            <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">  {{ $properties['native'] }}<span class="sr-only">(current)</span></a>
          </li>
          @endforeach
        <th scope="col">#</th>
        <th scope="col">{{__('messages.OfferName')}}</th>
        <th scope="col">{{__('messages.Offerprice')}}</th>
       
      </tr>
    </thead>
    <tbody>
        @foreach ( $offers as $of )
            
       
      <tr>
        <th scope="row">{{$of->id}}</th>
        <td>{{$of->name}}</td>
        <td>{{$of->price}}</td>
        <td><a class="btn btn-l" href="{{url('/offer/edit/'.$of->id)}}" role="button">Edit</a>
          <a class="btn btn-delete" href="{{route('offerdelete',['offerid' => $of->id])}}" role="button">Delete</a></td>
        
      </tr>
    
    
      @endforeach
      <tbody>
        @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
           {{ Session::get('success')}}
          </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
           {{ Session::get('error')}}
          </div>
        @endif
        
  </table>

  <style>
    .alert {
  padding: 15px;
  border: 1px solid transparent;
  border-radius: 4px;
}

.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}
.alert-danger {
  color: #f3f3f3;
  background-color: #c00f0f;
  border-color: #2e0404;
}

    /* Reset default styles */
body, h1, h2, h3, p, ul, li {
    margin: 0;
    padding: 0;
  }
  
  /* Table Styles */
  .table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
    font-size: 16px;
  }
  
  .table th,
  .table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  .table th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
  
  /* Button Styles */
  .btn-delete {
    display: inline-block;
    padding: 8px 16px;
    background-color: #d01238;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
}
  .btn-l {
    display: inline-block;
    padding: 8px 16px;
    background-color: #00ff95;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
  }
  
  /* Active Nav Item Styles */
  .nav-item.active .nav-link {
    color: #007bff;
    font-weight: bold;
  }
  
  /* Responsive Styles */
  @media (max-width: 768px) {
    .table th,
    .table td {
      padding: 8px;
    }
  }
  
  </style> 