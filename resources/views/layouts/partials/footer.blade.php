<footer class="footer">
    <a href="#" id="scroll-top"></a>
    <p>&copy; Keep 2015</p>
    @if (Auth::check())
        <ul class="footer-links text-muted">
            <li><a href="{{ route('users.show', Auth::user()->slug) }}">Profile</a></li>
            <li>&middot;</li>
            <li><a href="#">Notifications</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('users.tasks.index', Auth::user()->slug) }}">Tasks</a></li>
        </ul>
    @endif
</footer>