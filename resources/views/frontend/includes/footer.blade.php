<footer>
    <div class="container">
        
        @yield('main_pagination')

        <p class="text-centered foot-cp">
            <a href="{{ route('index') }}" title="{{ $site_info->settings->name }}">&copy; {{ date('Y').', '.$site_info->settings->name }}</a>
        </p>
    </div>
</footer>

<a href="javascript:void(0)" id="scroll-to-top" title="Top">
    <i class="fa fa-chevron-circle-up"></i>
</a>