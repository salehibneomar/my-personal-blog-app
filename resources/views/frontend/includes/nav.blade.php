<div class="main-nav">
    <div class="container">
        <header class="group top-nav">
            <nav class="navbar logo-w navbar-left" >
                <a class="logo" href="{{ route('index') }}" title="{{ $site_info->settings->name }}">
                    <img src="{{ asset($site_info->settings->logo) }}" alt="{{ $site_info->settings->name }}" title="{{ $site_info->settings->name }}" >&ensp;
                    {{ $site_info->settings->name }}
                </a>
            </nav>
            <div class="navigation-toggle" data-tools="navigation-toggle" data-target="#navbar-1">
                <span class="logo" title="{{ $site_info->settings->name }}" >
                    <img src="{{ asset($site_info->settings->logo) }}" alt="{{ $site_info->settings->name }}" title="{{ $site_info->settings->name }}" >&ensp;{{ $site_info->settings->initial_name }}
                </span>
            </div>
            <nav id="navbar-1" class="navbar item-nav navbar-right">
                <ul>
                    <li class="@if (Request::routeIs('index'))
                        {{ 'active' }}
                    @endif" >
                        <a href="{{ route('index') }}" title="HOME">
                            <b>HOME</b>
                        </a>
                    </li>
                    <li class="@if (Request::routeIs('contact'))
                    {{ 'active' }}
                    @endif" >
                        <a href="{{ route('contact') }}" title="CONTACT">
                            <b>CONTACT</b>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
    </div>
</div>