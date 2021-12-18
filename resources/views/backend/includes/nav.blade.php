<div class="header">
    <div class="logo logo-dark">
        <a href="{{ route('author.dashboard') }}">
            <p class="m-4">
                <img src="{{ asset(Auth::user()->settings->logo) }}" >
                <img class="logo-fold" src="{{ asset(Auth::user()->settings->logo) }}" >
            </p>
        </a>
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown dropdown-animated scale-left" >
                @php
                    $notification = message_notification();
                @endphp
                <a href="javascript:void(0);" data-toggle="dropdown" style="position: relative;">
                    <span class="badge badge-pill badge-primary" style="position:  absolute; font-size: 6.5pt; top: 0%; right: 0%;">{{ $notification->get('count') }}</span>
                    <i class="anticon anticon-bell notification-badge"></i>
                </a>
                <div class="dropdown-menu pop-notification" style="width: 300px;">
                    <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                        <p class="text-dark font-weight-semibold m-b-0">
                            <i class="anticon anticon-bell"></i>
                            <span class="m-l-10">Notifications</span>
                        </p>
                        <a class="btn-sm btn-default btn" href="{{ route('author.message.all') }}">
                            <small>View All</small>
                        </a>
                    </div>
                    <div class="relative">
                        <div class="overflow-y-auto relative scrollable" style="max-height: 300px;">

                            @forelse ($notification->get('messages') as $message)
                            <a href="{{ route('author.message.details', ['id'=>$message->id]) }}" class="dropdown-item d-block p-15 border-bottom">
                                <div class="d-flex">
                                    <div class="px-3">
                                        <p class="m-b-0 text-dark">
                                            {{ Str::limit($message->subject, 20, '...') }}
                                        </p>
                                        <p class="m-b-0 text-break text-wrap ">
                                        <small >
                                            {{ 'From '.$message->sender_name.', '.$message->created_at->diffForHumans() }}
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            @empty
                            <div class="d-flex">
                                <div >
                                    <p class="m-b-0 p-3">
                                        No unread messages!
                                    </p>
                                </div>
                            </div>

                            @endforelse

                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown dropdown-animated scale-left">
                <div class="pointer" data-toggle="dropdown">
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        <img src="{{ asset(Auth::user()->image) }}" >
                    </div>
                </div>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-50">
                            <div class="avatar avatar-lg avatar-image">
                                <img src="{{ asset(Auth::user()->image) }}" >
                            </div>
                            <div class="m-l-15 m-t-10">
                                <p class="m-b-0 text-dark font-weight-semibold">
                                    {{ Auth::user()->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('author.profile.view') }}" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                <span class="m-l-10">Profile</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                    <a href="{{ route('author.setting.edit') }}" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-lock"></i>
                                <span class="m-l-10">Setting</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display: block !important;">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item d-block p-h-15 p-v-10" onclick="event.preventDefault();
                        this.closest('form').submit();" >
                    </form>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                <span class="m-l-10">Logout</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                </div>
            </li>

        </ul>
    </div>
</div>  