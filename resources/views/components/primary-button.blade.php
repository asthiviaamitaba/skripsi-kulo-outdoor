<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-md transition duration-150 ease-in-out'
]) }}>
    {{ $slot }}
</button>
