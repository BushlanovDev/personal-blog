@if ($paginator->hasPages())
    <div class="-mx-4 flex flex-wrap">
        <div class="w-full px-4">
            <ul class="flex items-center justify-center pt-8">
                @if ($paginator->onFirstPage())
                    <li class="mx-1 disabled">
                        <span class="flex h-9 min-w-[36px] items-center justify-center rounded-md bg-body-color bg-opacity-[15%] px-4 text-sm text-body-color">{{__('Prev')}}</span>
                    </li>
                @else
                    <li class="mx-1">
                        <a rel="prev" href="{{$paginator->previousPageUrl()}}" class="flex h-9 min-w-[36px] items-center justify-center rounded-md bg-body-color bg-opacity-[15%] px-4 text-sm text-body-color transition hover:bg-primary hover:bg-opacity-100 hover:text-white">{{__('Prev')}}</a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="mx-1 disabled">
                            <span class="flex h-9 min-w-[36px] items-center justify-center rounded-md bg-body-color bg-opacity-[15%] px-4 text-sm text-body-color transition hover:bg-primary hover:bg-opacity-100 hover:text-white">{{$element}}</span>
                        </li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="mx-1">
                                    <span class="flex h-9 min-w-[36px] items-center justify-center rounded-md bg-body-color bg-opacity-[15%] px-4 text-sm text-body-color transition hover:bg-primary hover:bg-opacity-100 hover:text-white">{{$page}}</span>
                                </li>
                            @else
                                <li class="mx-1">
                                    <a href="{{$url}}" class="flex h-9 min-w-[36px] items-center justify-center rounded-md bg-body-color bg-opacity-[15%] px-4 text-sm text-body-color transition hover:bg-primary hover:bg-opacity-100 hover:text-white">{{$page}}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="mx-1">
                        <a rel="next" href="{{$paginator->nextPageUrl()}}" class="flex h-9 min-w-[36px] items-center justify-center rounded-md bg-body-color bg-opacity-[15%] px-4 text-sm text-body-color transition hover:bg-primary hover:bg-opacity-100 hover:text-white">{{__('Next')}}</a>
                    </li>
                @else
                    <li class="mx-1 disabled">
                        <span class="flex h-9 min-w-[36px] items-center justify-center rounded-md bg-body-color bg-opacity-[15%] px-4 text-sm text-body-color">{{__('Next')}}</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endif
