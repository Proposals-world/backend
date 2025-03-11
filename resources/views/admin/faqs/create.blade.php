@if (isset($faq))
    <form action="{{ route('faqs.update', $faq) }}" id="faqForm" method="POST">
        @method('PUT')
    @else
        <form action="{{ route('faqs.store') }}" id="faqForm" method="POST">
@endif
@csrf
<div class="mb-3">
    <label for="question_en" class="form-label">Question (English)</label>
    <input type="text" name="question_en" id="question_en" class="form-control" value="{{ $faq->question_en ?? '' }}">
</div>
<div class="mb-3">
    <label for="question_ar" class="form-label">Question (Arabic)</label>
    <input type="text" name="question_ar" id="question_ar" class="form-control" value="{{ $faq->question_ar ?? '' }}">
</div>
<div class="mb-3">
    <label for="answer_en" class="form-label">Answer (English)</label>
    <input type="text" name="answer_en" id="answer_en" class="form-control" value="{{ $faq->answer_en ?? '' }}">
</div>
<div class="mb-3">
    <label for="answer_ar" class="form-label">Answer (Arabic)</label>
    <input type="text" name="answer_ar" id="answer_ar" class="form-control" value="{{ $faq->answer_ar ?? '' }}">
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
