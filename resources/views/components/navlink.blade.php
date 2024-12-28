{{-- Default prop state --}}
@props([
  'active' => false,
  'type' => 'link'
])

@if ($type === 'link')
  <a
    class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"
    aria-current="{{ request()->is('/') ? 'page' : '' }}"
    {{ $attributes }}
  >
    {{ $slot }}
  </a>

@elseif ($type === 'button')
  <button
    class="button"
    {{ $attributes }}
  >
    {{ $slot }}
  </button>

@endif