<!-- Create Ticket Modal -->
<div class="modal fade" id="createTicketModal" tabindex="-1" role="dialog" aria-labelledby="createTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTicketModalLabel">{{ __('userDashboard.support.create_ticket') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="create-ticket-form" action="{{ route('user.support.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    
                    <!-- Subject Field -->
                    <div class="form-group">
                        <label for="subject">{{ __('userDashboard.support.subject') }} <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control @error('subject') is-invalid @enderror" 
                            id="subject" 
                            name="subject" 
                            value="{{ old('subject') }}"
                            placeholder="{{ __('userDashboard.support.subject_placeholder') }}"
                            required
                        >
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="subject-error">
                            {{ __('userDashboard.support.subject_required') }}
                        </div>
                    </div>
                    
                    <!-- Message Field -->
                    <div class="form-group">
                        <label for="description">{{ __('userDashboard.support.description') }} <span class="text-danger">*</span></label>
                        <textarea 
                            class="form-control @error('description') is-invalid @enderror" 
                            id="description" 
                            name="description" 
                            rows="5"
                            placeholder="{{ __('userDashboard.support.description_placeholder') }}"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="description-error">
                            {{ __('userDashboard.support.description_required') }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        {{ __('userDashboard.support.cancel') }}
                    </button>
                    <button type="submit" id="submit-ticket" class="btn btn-primary">
                        <i class="simple-icon-paper-plane mr-2"></i>{{ __('userDashboard.support.submit_ticket') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation
        const form = document.getElementById('create-ticket-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                let valid = true;
                const subject = document.getElementById('subject');
                const description = document.getElementById('description');
                
                // Reset previous validation
                subject.classList.remove('is-invalid');
                description.classList.remove('is-invalid');
                
                // Validate subject
                if (!subject.value.trim()) {
                    subject.classList.add('is-invalid');
                    document.getElementById('subject-error').style.display = 'block';
                    valid = false;
                }
                
                // Validate description
                if (!description.value.trim()) {
                    description.classList.add('is-invalid');
                    document.getElementById('description-error').style.display = 'block';
                    valid = false;
                }
                
                if (!valid) {
                    e.preventDefault();
                } else {
                    // Show loading state on button
                    document.getElementById('submit-ticket').innerHTML = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> {{ __('userDashboard.support.submitting') }}';
                    document.getElementById('submit-ticket').disabled = true;
                }
            });
        }

        // Reset form when modal is closed
        $('#createTicketModal').on('hidden.bs.modal', function () {
            if (form) {
                form.reset();
                document.getElementById('subject').classList.remove('is-invalid');
                document.getElementById('description').classList.remove('is-invalid');
            }
        });
    });
</script>
@endpush