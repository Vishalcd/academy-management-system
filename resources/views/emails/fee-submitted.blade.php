<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Fee Deposit Confirmation</title>
</head>

<body style="background-color: #f9fafb; padding: 20px; font-family: sans-serif;">

    <!-- Logo -->
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="https://iili.io/3DHv6AB.png" alt="Logo" style="height: 60px;">
    </div>

    <!-- Email Container -->
    <div
        style="background-color: #ffffff; border-radius: 8px; padding: 24px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);">

        <!-- Header -->
        <h2 style="font-size: 24px; color: #1f2937; margin-bottom: 32px;">Fee Deposit Confirmation</h2>

        <!-- Student Info -->
        <p style="color: #374151; font-size: 16px;">Hello <strong>{{$data['name']}}</strong>,</p>
        <p style="color: #374151; font-size: 16px; margin-top: 8px;">
            We have received a fee deposit of <strong>{{formatCurrency($data['amount'])}}</strong> for your class
            <strong>{{$data['class']}}</strong>.
        </p>
        <p style="color: #374151; font-size: 16px;">
            Your remaining fees is <strong>{{formatCurrency($data['fees_due'])}}</strong>.
        </p>

        <!-- Login Button -->
        <div style="text-align: center; margin: 24px 0;">
            <a href="{{route('students.showMe')}}"
                style="background-color: #3b82f6; margin: 10px 0;color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">
                View Profile
            </a>
        </div>

        <!-- Footer -->
        <div style="margin-top: 32px; font-size: 14px; color: #6b7280;">
            <p style="margin: 0;">Thanks,</p>
            <p style="margin: 0;">Blesswin School</p>
            <p style="margin-top: 8px;">Contact: 123-456-7890 | Email: info@blesswin.in</p>
        </div>
    </div>

</body>

</html>