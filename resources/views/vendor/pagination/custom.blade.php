@if ($paginator->hasPages())

<div class="row">

    @if ($paginator->onFirstPage())
        <div class="col-md-6 pr-md-1 mb-1">
            <a class="pg-btn d-inline-block btn btn-black w-100 disabled">
                <i class="fa fa-arrow-left"></i> BACK
            </a>
        </div>
    @else
        <div class="col-md-6 pr-md-1 mb-1">
            <a href="{{ $paginator->previousPageUrl() }}" class="pg-btn d-inline-block btn btn-black w-100">
                <i class="fa fa-arrow-left"></i> BACK
            </a>
        </div>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <div class="col-md-6 pl-md-1 mb-1">
            <a href="{{ $paginator->nextPageUrl() }}" class="pg-btn d-inline-block btn btn-black w-100">
                NEXT <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    @else
        <div class="col-md-6 pl-md-1 mb-1">
            <a class="pg-btn d-inline-block btn btn-black w-100 disabled">
                NEXT <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    @endif

</div>

@endif
