<x-layout title="Панель управления">
    <div class="space-y-6">
        <div class="text-xl font-medium">Панель управления</div>
        
        <!-- Статистика -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white border border-gray-300 p-4">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['users_count'] }}</div>
                <div class="text-sm text-gray-600">Пользователей</div>
            </div>
            <div class="bg-white border border-gray-300 p-4">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['posts_count'] }}</div>
                <div class="text-sm text-gray-600">Постов</div>
            </div>
            <div class="bg-white border border-gray-300 p-4">
                <div class="text-2xl font-bold text-gray-800">{{ $stats['categories_count'] }}</div>
                <div class="text-sm text-gray-600">Категорий</div>
            </div>
        </div>
        
        <!-- Быстрые действия -->
        <div class="bg-white border border-gray-300 p-4">
            <div class="text-sm font-medium mb-3">Быстрые действия</div>
            <div class="flex flex-wrap gap-3">
                @if(Auth::user()->is_admin)
                    <a href="{{ route('dashboard.users.index') }}" 
                       class="bg-gray-800 text-white px-4 py-2 text-sm">
                        Управление пользователями
                    </a>
                    <a href="{{ route('dashboard.categories.index') }}" 
                       class="bg-gray-800 text-white px-4 py-2 text-sm">
                        Управление категориями
                    </a>
                @endif
                <a href="{{ route('dashboard.posts.index') }}" 
                   class="bg-gray-800 text-white px-4 py-2 text-sm">
                    Мои посты
                </a>
                <a href="{{ route('dashboard.posts.create') }}" 
                   class="bg-green-600 text-white px-4 py-2 text-sm">
                    Создать пост
                </a>
            </div>
        </div>
        
        <div>
            <a href="{{ route('home') }}" class="text-sm underline">На главную</a>
        </div>
    </div>
</x-layout>