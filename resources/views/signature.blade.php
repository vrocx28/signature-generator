<!DOCTYPE html>
@extends('adminlayout')
@section('content')
<div class="main">
   <div class="col-lg-12 col-md-12">
      <h3>Signature Generator</h3>
   </div>
   <div class="container">
      <div class="row">

         <div class="col-lg-6 col-md-12 card">
            <div class="card-header">
               <h5>Fill details</h5>
            </div>
            <form action="{{ route('data-post') }}" class="input-side" id="Gensig" autocomplete="off" method="post">
               @csrf
               <input type="text" class="form-control input1" id="inputFname" name="inputFname" placeholder="First Name">
               <input type="text" class="form-control" id="inputLname" name="inputLname" placeholder="Last Name">
               <input type="text" class="form-control" id="inputJobPosition" name="inputJobPosition" placeholder="Job-Position">
               <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="Phone No.">
               <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
               <button type="submit" class="btn btn-primary submit">Generate Signature</button>
            </form>
         </div>

         <div class="col-lg-6 col-md-12 card">
            <div class="card-header">
               <h5>Preview</h5>
            </div>
            @php
            echo Session::get('data');
            @endphp

         </div>
         <div class="col-lg-12 col-md-12 card">
            <div class="card-header sign-txt">
               <h5>Signature Script</h5>
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
<script>
   new ClipboardJS('.btn', {
      container: document.getElementById('modal')
   });
</script>

@endsection