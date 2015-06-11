<footer class="footer">
    <a href="#" id="scroll-top"></a>
    <p>&copy; Keep 2015</p>
    @if (Auth::check())
        <ul class="footer-links text-muted">
            <li><a href="{{ route('member::profile', Auth::user()) }}">Profile</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::dashboard', Auth::user()) }}">Dashboard</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::notifications.personal', Auth::user()) }}">Notifications</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::assignments.all', Auth::user()) }}">Assignments</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::groups.all', Auth::user()) }}">Groups</a></li>
        </ul>
    @endif
</footer>