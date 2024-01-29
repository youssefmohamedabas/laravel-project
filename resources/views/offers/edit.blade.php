@extends('layouts.app')

<!DOCTYPE html>
<head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
@if (Session::has('success'))
<div class="alert alert-success" role="alert">
   {{ Session::get('success')}}
  </div>
@endif
<div align-center>
    <form method="POST" action="{{ route('updateoffer', ['offerid' => $o->id]) }}">

   @csrf
   
    <div class="form-group">
      <label align-center for="exampleInputEmail1">{{__('messages.OfferName')}}</label>
      <input align-center  value="{{$o->name}}"  name="name" type="text" class="form-control"  placeholder="Offer">
     @error('name')
     <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
         
     @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">{{__('messages.Offerprice')}}</label>
      <input value="{{$o->price}}" name="price" type="text" class="form-control" >
      @error('price')
      <div class="alert alert-danger" role="alert">
        {{$message}}
      </div>
     @enderror
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
    </div>
  </form>