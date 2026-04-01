<x-mail::message>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; background-color: #f9f9f9;">
    <tr>
        <td align="center" style="padding: 20px 0;">
            <!-- Header -->
            <img src="https://via.placeholder.com/150x50?text=GSM+X+Store+Logo" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">
        </td>
    </tr>
    <tr>
        <td style="padding: 0 20px;">
            <!-- Body -->
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-radius: 10px;">
                <tr>
                    <td style="padding: 30px;">
                        <h1 style="font-size: 24px; color: #333333; margin-top: 0;">Funds Added to Your Account</h1>
                        <p style="font-size: 16px; color: #555555;">Hi {{ $user->name }},</p>
                        <p style="font-size: 16px; color: #555555;">We're pleased to inform you that <strong>{{ $amount }}</strong> has been added to your account balance by the administrator.</p>
                        @if($paymentGateway)
                        <p style="font-size: 16px; color: #555555;">This fund was added via <strong>{{ $paymentGateway->name }}</strong>.</p>
                        @endif
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #e8f5e9; border-radius: 10px; margin: 20px 0;">
                            <tr>
                                <td align="center" style="padding: 20px;">
                                    <p style="font-size: 20px; color: #2e7d32; font-weight: bold; margin: 0;">
                                        New Balance: {{ $user->balance }}
                                    </p>
                                </td>
                            </tr>
                        </table>
                        <p style="font-size: 16px; color: #555555;">You can now use your new balance to explore our services.</p>
                        <!-- Button -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" style="padding-top: 30px;">
                                    <a href="{{ route('dashboard') }}" style="background-color: #007bff; color: #ffffff; padding: 15px 30px; border-radius: 5px; text-decoration: none; font-size: 16px; display: inline-block;">View Your Account</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding: 20px 0; font-size: 12px; color: #888888;">
            <!-- Footer -->
            <p style="margin: 0;">Thanks,<br>{{ config('app.name') }}</p>
            <p style="margin-top: 10px;">If you have any questions, please contact us at <a href="mailto:support@{{ config('app.name') }}.com" style="color: #007bff; text-decoration: none;">support@{{ config('app.name') }}.com</a></p>
        </td>
    </tr>
</table>
</x-mail::message>
