<div class="social-authentication">
    <a href="{{ route('oauth::google') }}">
        <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Google authentication">
            <i class="fa fa-google"></i>
        </button>
    </a>
    <a href="{{ route('oauth::github') }}">
        <button class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="GitHub authentication">
            <i class="fa fa-github"></i>
        </button>
    </a>
    <a href="{{ route('oauth::facebook') }}">
        <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Facebook authentication">
            <i class="fa fa-facebook"></i>
        </button>
    </a>
</div>
