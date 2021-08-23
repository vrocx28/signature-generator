<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

<head>
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
   <link href="{{url('css/layout.css')}}" rel="stylesheet" type="text/css" />
</head>
<div class="main">
   <div class="col-lg-12 col-md-12">
      <h2>Signature Generator</h2>
   </div>
   <div class="container">
      <div class="row">

         <div class="col-lg-6 col-md-12 card">
            <div class="card-header">
               <h5>Fill details</h5>
            </div>
            <form action="{{ route('data-post') }}" class="input-side" id="Gensig" autocomplete="off" method="post">
               @csrf
               <input type="text" class="form-control input1" id="inputFname" name="inputFname" placeholder="First Name" value="Vaibhav">
               <input type="text" class="form-control" id="inputLname" name="inputLname" placeholder="Last Name" value="Bansal">
               <input type="text" class="form-control" id="inputPosition" name="inputPosition" placeholder="Position" value="Junior Dev">
               <input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="Phone No." value="9520175869">
               <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" value="vaibhavbansal28@gmail.com">
               <button type="submit" class="btn btn-primary">Generate Signature</button>

            </form>
         </div>
         <div class="col-lg-6 col-md-12 card">
            <div class="card-header">
               <h5>preview</h5>
            </div>
            @php
               echo Session::get('data');
            @endphp

         </div>
         <div class="col-lg-12 col-md-12 card">
            <div class="card-header">
               <h5>Output</h5>
            </div>
            <code>
               {{Session::get('data')}}
            </code>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
   $(document).ready(function() {
      $('#Gensig').validate({
         rules: {
            inputFname: 'required',
            inputLname: 'required',
            inputPosition: 'required',
            inputPhone: {
               required: true,
               minlength: 10,
               maxlength: 10,
            },
            inputEmail: {
               required: true,
               email: true,
            },
         },
         messages: {
            inputFname: 'This field is required',
            inputLname: 'This field is required',
            inputPosition: 'This field is required',
            inputEmail: 'This field is required',

            inputPhone: {
               minlength: 'Invalid phone number',
               maxlength: 'Invalid phone number',
            },
         },
         submitHandler: function(form) {
            form.submit();
         }
      });
   });
</script>