<li>
    <a href="{{ $menu->url() }}" class="sf-with-ul" target="{{ $menu->target() }}" data-text="{{ $menu->name() }}">
        {{ $menu->name() }}
    </a>

    @if ($menu->isFluid())
        @include('public.layout.navigation.fluid', ['subMenus' => $menu->subMenus()])
    @else
        @include('public.layout.navigation.dropdown', ['subMenus' => $menu->subMenus()])
    @endif
</li>