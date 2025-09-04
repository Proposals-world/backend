@extends('user.layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <h1 class="mb-3">Payment Failed</h1>
      <p class="lead mb-4">We could not process your payment. Please try again or use a different method.</p>
      <a href="{{ route('user.pricing') }}" class="btn btn-outline-primary">Back to Pricing</a>
    </div>
  </div>
</div>
@endsection

