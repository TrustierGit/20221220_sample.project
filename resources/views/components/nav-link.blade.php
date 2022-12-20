@props(['active'])
@props(['mode'=>Auth::user()->mode_admin])

@php
$classes='inline-flex items-center text-white px-8 pt-2 text-xl font-medium leading-5 focus:outline-none transition duration-150 ease-in-out ';

$user_active   = 'border-black focus:border-white ';
$user_inactive = 'border-transparent hover:text-gray-300 focus:text-gray-900 focus:border-gray-900 ';

switch($mode){
    case '0':
        $classes .= ($active ?? false) ? $user_active . 'bg-indigo-900 ' : $user_inactive . 'hover:border-indigo-600';
        break;
    case '1':
        $classes .= ($active ?? false) ? $user_active . 'bg-red-900 ' : $user_inactive . 'hover:border-red-600';
            break;
    case '9':
        $classes .= ($active ?? false) ? $user_active . 'bg-green-900 ' : $user_inactive . 'hover:border-green-600';
            break;
    default:
    $classes .= ($active ?? false) ? $user_active . 'bg-indigo-800 ' : $user_inactive . 'hover:border-indigo-800';
            break;
}

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
