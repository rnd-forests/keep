<footer class="footer">
    <a href="#" id="scroll-top"></a>
    <p>&copy; Keep 2015 by Vinh Nguyen</p>
    @if(auth()->check())
        <ul class="footer-links text-muted">
            <li><a href="{{ route('member::profile.show', $authUser) }}">Profile</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::dashboard', $authUser) }}">Dashboard</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::notifications',
                ['users' => $authUser, 'type' => 'personal']) }}">Notifications</a></li>
            <li>&middot;</li>
            <li><a href="{{ route('member::groups.all', $authUser) }}">Groups</a></li>
        </ul>
    @endif
</footer>