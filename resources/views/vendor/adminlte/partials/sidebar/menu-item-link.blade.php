<li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item">

    @if(str_starts_with($item['url'],'/'))
    @if(request()->is('home') && ($item['text'] == 'Dashboard'))
    <a class="nav-link active {{ $item['class'] }} @if(isset($item['shift'])) {{ $item['shift'] }} @endif"
       href="{{ $item['href'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
       {!! $item['data-compiled'] ?? '' !!}>
        @else
        <a class="nav-link {{ request()->is(substr($item['url'],1)) ? 'active':'' }}{{ $item['class'] }} @if(isset($item['shift'])) {{ $item['shift'] }} @endif"
           href="{{ $item['href'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
           {!! $item['data-compiled'] ?? '' !!}>
            @endif

            @else
            <a class="nav-link {{ request()->is($item['url'].'*') ? 'active':'' }}{{ $item['class'] }} @if(isset($item['shift'])) {{ $item['shift'] }} @endif"
               href="{{ $item['href'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif
               {!! $item['data-compiled'] ?? '' !!}>
                @endif
                <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
                   }}"></i>

                <p>
                    {{ $item['text'] }}

                    @if(isset($item['label']))
                    <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                        {{ $item['label'] }}
                    </span>
                    @endif
                </p>

            </a>

            </li>