@if (isset($user))
    <form action="{{ route('manageUsers.update', $user->id) }}" id="userForm" method="POST">
        @method('PUT')
@else
    <form action="{{ route('manageUsers.store') }}" id="userForm" method="POST">
@endif
    @csrf

    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" name="first_name" id="first_name" class="form-control"
               value="{{ old('first_name', $user->first_name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" name="last_name" id="last_name" class="form-control"
               value="{{ old('last_name', $user->last_name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control"
               value="{{ old('email', $user->email ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control"
               value="{{ old('phone_number', $user->phone_number ?? '') }}">
    </div>

    @if (!isset($user))
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
    @endif

    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select name="gender" id="gender" class="form-control">
            <option value="male" {{ (isset($user) && $user->gender == 'male') ? 'selected' : '' }}>Male</option>
            <option value="female" {{ (isset($user) && $user->gender == 'female') ? 'selected' : '' }}>Female</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="role_id" class="form-label">Role</label>
        <select name="role_id" id="role_id" class="form-control">
            <option value="1" {{ (isset($user) && $user->role_id == 1) ? 'selected' : '' }}>Admin</option>
            <option value="2" {{ (isset($user) && $user->role_id == 2) ? 'selected' : '' }}>User</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>
