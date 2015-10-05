<div class="modal fade" id="social-auth">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <a class="btn btn-block btn-social btn-google"
               href="{{ route('oauth.google') }}">
                <i class="fa fa-google"></i>
                Authentication with Google
            </a>
            <a class="btn btn-block btn-social btn-github"
               href="{{ route('oauth.github') }}">
                <i class="fa fa-github"></i>
                Authentication with GitHub
            </a>
            <a class="btn btn-block btn-social btn-facebook"
               href="{{ route('oauth.facebook') }}">
                <i class="fa fa-facebook"></i>
                Authentication with Facebook
            </a>
        </div>
    </div>
</div>
