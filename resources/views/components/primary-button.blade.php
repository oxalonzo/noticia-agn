<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#dd6b10] dark:bg-[#dd6b10] border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-[#dd6b10] dark:hover:bg-[#dd6b10] focus:bg-[#dd6b10] dark:focus:bg-[#dd6b10] active:bg-[#dd6b10] dark:active:bg-[#dd6b10] focus:outline-none focus:ring-2 focus:ring-[#dd6b10] focus:ring-offset-2 dark:focus:ring-offset-[#dd6b10] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
