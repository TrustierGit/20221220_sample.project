<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-4 bg-indigo-800 border border-transparent rounded-full font-semibold text-lg text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
