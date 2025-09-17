<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
</head>
<body>
    <h2>Hello {{ $user->full_name ?? 'Test User' }},</h2>
    <p>This is a test mail.</p>
    <p>Password: {{ $plainPassword ?? 'N/A' }}</p>
</body>
</html>
