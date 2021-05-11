
<a href="{{ $item['route'] }}" class="btn btn-{{ $item['color']}}" target="{{ isset($item['target']) ? $item['target'] : '' }}">
    <i class="fas fa-{{$item['icon']}}"></i> {{$item['label']}}
</a>
