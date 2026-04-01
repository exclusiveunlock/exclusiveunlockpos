<!-- resources/views/emails/user-role-changed-to-reseller.blade.php -->
<x-mail::message>
# Your account has been upgraded to a Reseller

Congratulations {{ $user->name }}! Your account has been upgraded to a Reseller account.

You can now enjoy the benefits of being a reseller on our platform.

<x-mail::button :url="url('/')">
Visit Dashboard
</x-mail::button>

Thank you for using our application!
</x-mail::message>
