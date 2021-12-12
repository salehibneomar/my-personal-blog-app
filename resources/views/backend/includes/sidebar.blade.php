<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item dropdown open">
                <a class="dropdown-toggle" href="{{ route('author.dashboard') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
                
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-profile"></i>
                    </span>
                    <span class="title">Post</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('author.post.all') }}">Manage</a>
                    </li>
                    <li>
                        <a href="{{ route('author.post.create', ['type'=>'status']) }}">Status</a>
                    </li>
                    <li>
                        <a href="{{ route('author.post.create', ['type'=>'picture']) }}">Picture</a>
                    </li>
                    <li>
                        <a href="{{ route('author.post.create', ['type'=>'blog']) }}">Blog</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-message"></i>
                    </span>
                    <span class="title">Message</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('author.message.all') }}">All</a>
                    </li>
                    <li>
                        <a href="{{ route('author.message.deleted') }}">Deleted</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>