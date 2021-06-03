
<li class="d-flex align-items-center" style="font-size: 13px;">
    <a class="text-light text-decoration-none" href="{{ route('posts.latest') }}">
        <img src="/storage/uploads/download.png" style="max-width: 20px" alt="">
    </a>
</li>

<span class="text-danger font-weight-bold" style="margin-top: -2px !important; margin-left: -4px;">{{ $posts->count() }}</span>
