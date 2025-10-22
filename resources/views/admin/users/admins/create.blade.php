@if (isset($admin))
    <form action="{{ route('admins.update', ['admin' => $admin->id]) }}" id="adminForm" method="POST">
        @method('PUT')
@else
    <form action="{{ route('admins.store') }}" id="adminForm" method="POST">
@endif
    @csrf

    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $admin->first_name ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $admin->last_name ?? '') }}">
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select name="gender" id="gender" class="form-select">
            <option value="male" {{ (old('gender', $admin->gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
            <option value="female" {{ (old('gender', $admin->gender ?? '') == 'female') ? 'selected' : '' }}>Female</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>
