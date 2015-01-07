<nav>
    <ul>
        <li><a href="{{ URL::route('home') }}">Home</a></li>

        @if(Auth::check())
        <li><a href="{{ URL::route('account-sign-out') }}">Sign Out</a></li>
        <li><a href="{{ URL::route('account-change-password') }}">Change Password</a></li>
        <li><a href="{{ URL::route('profile-user-get', array('username' => Auth::user()->username)) }}">Profile</a></li>
        <li><a href="{{ URL::route('user-tasks') }}">Tasks</a></li>


        @else
            <li><a href="{{ URL::route('account-sign-in') }}">Sign In</a></li>
            <li><a href="{{ URL::route('account-create') }}">Create an account</a></li>
            <li><a href="{{ URL::route('account-forgot-password') }}">Forgot Password</a></li>

        @endif
    </ul>
</nav>