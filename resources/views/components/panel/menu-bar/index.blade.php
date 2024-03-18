<aside id="menu_bar" class="z-20 lg:static fixed -translate-x-full transition-transform lg:translate-x-0 w-80 overflow-y-auto bg-gray-700 lg:block" style="height: calc(100vh - 63.5px)">
    <div class="text-gray-500 pt-2 h-full">
        <ul>
            <x-panel.menu-bar.menu-item :title="__('Dashboard')" href="{{ route('dashboard') }}" :icon="__('dashboard')" :active="__('dashboard')" />
            <x-panel.menu-bar.admin />
        </ul>
    </div>
</aside>
@push('scripts')
    <script type="text/javascript">
        var mainItems = document.querySelectorAll('.main-item');
        mainItems.forEach(function(item) {
            item.addEventListener('click', function() {
                var submenu = this.querySelector('.sub-menu');
                var arrow = this.querySelector('.arrow');
                var allSubmenus = document.querySelectorAll('.sub-menu');
                var allArrows = document.querySelectorAll('.arrow');
                allSubmenus.forEach(function(sub) {
                    if (sub !== submenu) {
                        sub.classList.add('hidden');
                    }
                });
                allArrows.forEach(function(arr) {
                    if (arr !== arrow) {
                        arr.classList.add('-rotate-90');
                    }
                });
                arrow.classList.toggle('-rotate-90');
                submenu.classList.toggle('hidden');
            });
        });
    </script>
@endpush
