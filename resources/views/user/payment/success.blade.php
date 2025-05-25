@extends('user.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center py-5">
                    <!-- Success Icon -->
                    <div class="mb-4">
                        <div class="success-checkmark">
                            <div class="check-icon">
                                <span class="icon-line line-tip"></span>
                                <span class="icon-line line-long"></span>
                                <div class="icon-circle"></div>
                                <div class="icon-fix"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <h2 class="text-success mb-3">Payment Successful!</h2>
                    <p class="text-muted mb-4">Thank you for your purchase. Your payment has been processed successfully.</p>

                    <!-- Payment Details Card -->
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Payment Details</h5>
                                    <div class="row">
                                        <div class="col-sm-6 text-left">
                                            <p class="mb-2"><strong>Package:</strong></p>
                                            <p class="mb-2"><strong>Amount Paid:</strong></p>
                                            <p class="mb-2"><strong>Contacts Added:</strong></p>
                                            <p class="mb-2"><strong>Payment Date:</strong></p>
                                            <p class="mb-2"><strong>Transaction ID:</strong></p>
                                        </div>
                                        <div class="col-sm-6 text-left">
                                            <p class="mb-2">{{ $payment->package->package_name_en }}</p>
                                            <p class="mb-2 text-success font-weight-bold">${{ number_format($payment->amount, 2) }}</p>
                                            <p class="mb-2 text-primary font-weight-bold">{{ number_format($payment->package->contact_limit) }}</p>
                                            <p class="mb-2">{{ $payment->paid_at->format('M d, Y h:i A') }}</p>
                                            <p class="mb-2 text-muted">{{ $payment->transaction_id }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-4">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg mr-3">
                            <i class="iconsminds-home mr-2"></i>
                            Go to Dashboard
                        </a>
                        <a href="{{ route('user.pricing') }}" class="btn btn-outline-primary btn-lg">
                            <i class="iconsminds-wallet mr-2"></i>
                            Buy More Contacts
                        </a>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-4 pt-3 border-top">
                        <p class="text-muted small mb-0">
                            <i class="iconsminds-mail mr-1"></i>
                            A confirmation email has been sent to your registered email address.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Usage Info -->
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="iconsminds-info mr-2"></i>How to Use Your Contacts</h6>
                            <ul class="list-unstyled">
                                <li><i class="simple-icon-check text-success mr-2"></i>Visit the "Find Match" section</li>
                                <li><i class="simple-icon-check text-success mr-2"></i>Browse through potential matches</li>
                                <li><i class="simple-icon-check text-success mr-2"></i>Use contacts to reveal contact information</li>
                                <li><i class="simple-icon-check text-success mr-2"></i>Start meaningful conversations</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="iconsminds-heart mr-2"></i>Need Help?</h6>
                            <p class="text-muted">If you have any questions about your purchase or need assistance, please don't hesitate to contact our support team.</p>
                            <a href="{{ route('user.support.create') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="iconsminds-mail mr-1"></i>
                                Contact Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.success-checkmark {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #4caf50;
    stroke-miterlimit: 10;
    margin: 10px auto;
    box-shadow: inset 0px 0px 0px #4caf50;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    position: relative;
}

.success-checkmark .check-icon {
    width: 56px;
    height: 56px;
    position: absolute;
    left: 12px;
    top: 12px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #fff;
    stroke-miterlimit: 10;
    margin: 0 auto;
    box-shadow: inset 0px 0px 0px #4caf50;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.success-checkmark .check-icon .icon-line {
    height: 3px;
    background-color: #4caf50;
    display: block;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
}

.success-checkmark .check-icon .icon-line.line-tip {
    top: 46px;
    left: 14px;
    width: 25px;
    transform: rotate(45deg);
    animation: icon-line-tip .75s;
}

.success-checkmark .check-icon .icon-line.line-long {
    top: 38px;
    right: 8px;
    width: 47px;
    transform: rotate(-45deg);
    animation: icon-line-long .75s;
}

.success-checkmark .check-icon .icon-circle {
    top: -4px;
    left: -4px;
    z-index: 10;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    position: absolute;
    box-sizing: content-box;
    border: 4px solid rgba(76, 175, 80, .5);
}

.success-checkmark .check-icon .icon-fix {
    top: 8px;
    width: 5px;
    left: 26px;
    z-index: 1;
    height: 85px;
    position: absolute;
    transform: rotate(-45deg);
    background-color: #fff;
}

@keyframes icon-line-tip {
    0% {
        width: 0;
        left: 1px;
        top: 19px;
    }
    54% {
        width: 0;
        left: 1px;
        top: 19px;
    }
    70% {
        width: 50px;
        left: -8px;
        top: 37px;
    }
    84% {
        width: 17px;
        left: 21px;
        top: 48px;
    }
    100% {
        width: 25px;
        left: 14px;
        top: 45px;
    }
}

@keyframes icon-line-long {
    0% {
        width: 0;
        right: 46px;
        top: 54px;
    }
    65% {
        width: 0;
        right: 46px;
        top: 54px;
    }
    84% {
        width: 55px;
        right: 0px;
        top: 35px;
    }
    100% {
        width: 47px;
        right: 8px;
        top: 38px;
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 60px #4caf50;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}
</style>
@endsection