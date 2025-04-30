@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('admin/assets/images/brands/proposals-logo.jpeg') }}" class="logo" alt="{{ config('app.name') }}">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>