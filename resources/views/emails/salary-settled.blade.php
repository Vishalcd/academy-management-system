<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Salary Settlement Confirmation</title>
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
        <h2 style="font-size: 24px; color: #1f2937; margin-bottom: 32px;">Salary Settlement Confirmation</h2>

        <!-- Employee Info -->
        <p style="color: #374151; font-size: 16px;">Dear <strong>{{$data['name']}}</strong>,</p>

        <p style="color: #374151; font-size: 16px; margin-top: 8px;">
            We are pleased to inform you that your salary for the month of <strong>{{$data['month']}}</strong> has been
            successfully settled.
        </p>

        <p style="color: #374151; font-size: 16px; margin-top: 8px;">
            Amount Paid: <strong>{{formatCurrency($data['amount'])}}</strong><br>
            Last Paid Date: <strong>{{$data['last_paid']}}</strong>
        </p>

        <!-- Login Button -->
        <div style="text-align: center; margin: 24px 0;">
            <a href="{{route('employees.showMe')}}"
                style="background-color: #10b981; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">
                View Your Profile
            </a>
        </div>

        <!-- Footer -->
        <div style="margin-top: 32px; font-size: 14px; color: #6b7280;">
            <p style="margin: 0;">Thank you for your dedication and service,</p>
            <p style="margin: 0;">Blesswin School Administration</p>
            <p style="margin-top: 8px;">Contact: 123-456-7890 | Email: info@blesswin.in</p>
        </div>
    </div>

</body>

</html>