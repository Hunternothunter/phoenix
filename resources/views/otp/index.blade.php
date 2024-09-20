<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
</head>
<body>
    <h1>OTP Verification</h1>
    <form method="POST" action="{{ route('verify.otp') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="otp">OTP</label>
            <input type="text" id="otp" name="otp" required>
        </div>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
