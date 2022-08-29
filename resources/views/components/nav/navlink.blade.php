<li class="nav-item shadow mb-2 bg-body rounded">
  <a href="{{ route("$routeName") }}" class="nav-link @if($active) active @endif" aria-current="page">
    {{ $slot }}
  </a>
</li>


 