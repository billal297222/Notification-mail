<!DOCTYPE html>
<html>
<head>
    <title>Follow a User (SMS Only)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Follow a User (SMS Only)</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guest.follow.sms.submit') }}" method="POST">
        @csrf

        {{-- Select User --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">Select User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- Select User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Guest Name --}}
        <div class="mb-3">
            <label for="guest_name" class="form-label">Your Name</label>
            <input type="text" name="guest_name" id="guest_name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Send SMS</button>
    </form>
</div>
</body>
</html>
