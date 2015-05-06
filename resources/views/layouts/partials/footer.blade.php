<footer class="footer">
    <a href="#" id="scroll-top"></a>
    <p>&copy; Keep 2015</p>
    @if (Auth::check())
        <ul class="footer-links text-muted">
            <li><a href="{{ route('users.show', Auth::user()) }}">Profile</a></li>
            <li>&middot;</li>
            <li><a href="#">Notifications</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('users.dashboard', Auth::user()) }}">Dashboard</a></li>
        </ul>
    @endif
</footer>