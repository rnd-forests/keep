<footer class="footer">
    <a href="#" id="scroll-top"></a>
    <p>&copy; Keep 2015</p>
    @if(auth()->check())
        <ul class="footer-links text-muted">
            <li><a href="{{ route('member::profile.show', $authUser) }}">Profile</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::account.show', $authUser) }}">Account</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::dashboard', $authUser) }}">Dashboard</a></li>
        </ul>
    @endif
</footer>