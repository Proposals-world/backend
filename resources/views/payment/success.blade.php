@extends('user.layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <h1 class="mb-3">Payment Successful</h1>
      <p class="lead mb-4">Thank you! Your payment has been processed. If this was a subscription, it will be active shortly.</p>
      <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
    </div>
  </div>
</div>
@endsection

