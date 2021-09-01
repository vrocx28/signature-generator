<!DOCTYPE html>
@extends('layout')
@section('content')
<div class="main">
   <div class="col-lg-12 col-md-12">
      <h3>Signature Generator</h3>
   </div>
   <div class="container">
      <div class="row">

         <div class="col-lg-6 col-md-12 card">
            <div class="card-header">
               <h5 class="heading">Fill details</h5>
            </div>
            <form action="{{ route('data-post') }}" class="input-side form" enctype="multipart/form-data" autocomplete="off" method="post">
               @csrf
               <div class="row g-3">

                  <div class="col-lg-6 col-md-12">
                     <input type="text" class="form-control" name="inputFname" placeholder="First Name*" required autofocus value="vaibhav">
                  </div>
                  <div class="col-lg-6 col-md-12">
                     <input type="text" class="form-control" name="inputLname" placeholder="Last Name*" required autofocus value="bansal">
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <input type="text" class="form-control" name="inputJobPosition" placeholder="Job-Position*" required autofocus value="junior dev">
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <input type="file" class="form-control" name="inputLogopic" accept="image/*" >
                  </div>
                  <div class="col-lg-6 col-md-12">
                     <input type="tel" class="form-control" name="inputPhone" placeholder="Phone No." value="0123456789">
                  </div>
                  <div class="col-lg-6 col-md-12">
                     <input type="tel" class="form-control" name="inputMobile" placeholder="Mobile No." value="0123456789">
                  </div>
                  <div class="col-lg-12 col-md-12">
                     <input type="email" class="form-control" name="inputEmail" placeholder="Email*" required autofocus value="vaibhavbansal@gmail.com"> 
                  </div>

               </div>
               <button type="submit" class="btn btn-primary submit">Generate Signature</button>
            </form>
         </div>

         <div class="col-lg-6 col-md-12 card">
            <div class="card-header">
               <h5 class="heading">Preview</h5>
            </div>
            @php
            echo Session::get('data');
            @endphp

         </div>
         <div class="col-lg-12 col-md-12 card">
            <div class="card-header sign-txt">
               <h5 class="heading">Signature Script</h5>
               <button class="btn copy" data-clipboard-target="#myOutput">
                  <img class="clippy" src="{{asset('images/copy.png')}}" width="13" alt="Copy to clipboard">
               </button>
            </div>
            <pre><code id="myOutput">{{Session::get('data')}}</code></pre>
         </div>
      </div>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
   
   // copy highlight function
   new ClipboardJS('.btn', {
      container: document.getElementById('modal')
   });
</script>

@endsection