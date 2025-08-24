@extends('admin.layout.app')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')
@section('subtitle', 'Overview')

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div
                        class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
                        <h4 class="page-title">Whatsapp QR Code</h4>
                        @if($qrAlreadyExists)
                            {{-- ✅ Already linked → show green button --}}
                            <a class="btn ms-2" style="background-color: green; color: white">
                            <i class="ri-whatsapp-fill"></i> Linked
                            </a>
                        @else
                            {{-- 🔄 Not linked → show blue refresh button --}}
                            <a class="btn  ms-2" style="background-color: red; color: white">
                                <i class="ri-error-warning-line"></i> Not Linked
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- QR Code Button + Container -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <!-- Button -->
                     @if($qrAlreadyExists)
                    <button  class="btn btn-success mt-5" disabled>
                        <i class="ri-qr-code-line"></i> linked
                    </button>
                    @else
                    <button id="load-qr" class="btn btn-success mt-5">
                        <i class="ri-qr-code-line"></i> Load QR Code
                    </button>
                    @endif
                    <!-- Container -->
                    <div id="qr-container" class="text-center mt-4">
                        <p>Click "Load QR Code" to get QR</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

   @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const button = document.getElementById("load-qr");
        const container = document.getElementById("qr-container");

        // Check if QR exists in sessionStorage
        const savedQr = sessionStorage.getItem('whatsappQr');
        if (savedQr) {
            container.innerHTML = `
                <img src="${savedQr}" alt="WhatsApp QR Code"
                     class="img-fluid border p-2 rounded shadow"
                     style="max-width:300px;">
            `;
            // Do not disable the button or change text
        }

        button.addEventListener("click", async function () {
            container.innerHTML = `<p>Loading QR Code...</p>`; // show loading state

            try {
                const response = await fetch("{{ config('app.api_url') }}/sessions/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ sessionId: "{{ Auth::user()->first_name }}" })
                });

                if (!response.ok) {
                    throw new Error("API returned " + response.status);
                }

                const data = await response.json();

                if (data.qr) {
                    // Save QR to sessionStorage
                    sessionStorage.setItem('whatsappQr', data.qr);

                    container.innerHTML = `
                        <img src="${data.qr}" alt="WhatsApp QR Code"
                             class="img-fluid border p-2 rounded shadow"
                             style="max-width:300px;">
                    `;
                } else {
                    container.innerHTML = `<p class="text-danger">QR code not received</p>`;
                }
            } catch (error) {
                console.error(error);
                container.innerHTML = `<p class="text-danger">Failed to load QR code</p>`;
            }
        });
    });
</script>
@endpush


@endsection
