<table class="table">
  <thead>
      <tr>



          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">address</th>
          <th scope="col">اجرائات</th>

      </tr>
  </thead>
  <tbody>

@if(isset($hospitals))
@foreach ( $hospitals as $hospital )
<tr>
 
  <td>{{$hospital->id}}</td>
  <td>{{$hospital->name}}</td>
  <td>{{$hospital->address}}</td>
  <td><a href="{{route('passid',['hospital_id'=>$hospital->id])}}" class="btn btn-success"> عرض الاطباء</a></td>
  <td><a href="{{route('deleteid',$hospital->id)}}" class="btn btn-danger"> مسح المستشفي</a>
  </td>

</tr>

@endforeach
      
@endif
     
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
.btn-success {
  color: #000000;
  background-color: #dbd4ed;

  border-color: #022a0b;
}

.alert-danger {
  color: #f3f3f3;
  background-color: #c00f0f;
  border-color: #2e0404;
}

/* Reset default styles */
body,
h1,
h2,
h3,
p,
ul,
li {
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