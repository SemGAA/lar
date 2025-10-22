<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Система')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Уведомления -->
    @if (session()->has('ok'))
        <div class="bg-green-500 text-white px-4 py-2 text-center">
            {{ session('ok') }}
        </div>
    @endif
    @if (session()->has('alert'))
        <div class="bg-red-500 text-white px-4 py-2 text-center">
            {{ session('alert') }}
        </div>
    @endif

    <!-- Навигация -->
    <div class="border-b border-gray-300 bg-white">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="text-lg font-medium">
                <a href="{{ route('home') }}" class="hover:text-gray-600">Система</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-gray-700">{{ Auth::user()->fio }}</span>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('dashboard.users.index') }}" class="text-sm text-gray-700 hover:text-gray-900 underline">Пользователи</a>
                        <a href="{{ route('dashboard.categories.index') }}" class="text-sm text-gray-700 hover:text-gray-900 underline">Категории</a>
                    @endif
                    <a href="{{ route('dashboard.posts.index') }}" class="text-sm text-gray-700 hover:text-gray-900 underline">Мои посты</a>
                    <a href="{{ route('dashboard.home') }}" class="text-sm text-gray-700 hover:text-gray-900 underline">Панель управления</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-700 hover:text-gray-900 underline">Выход</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('loginIndex') }}" class="text-sm text-gray-700 hover:text-gray-900 underline">Вход</a>
                    <a href="{{ route('registerIndex') }}" class="text-sm text-gray-700 hover:text-gray-900 underline">Регистрация</a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Контент -->
    <div class="max-w-4xl mx-auto px-4 py-6">
        {{ $slot }}
    </div>

    <!-- Футер -->
    <footer class="border-t border-gray-300 bg-white mt-8">
        <div class="max-w-4xl mx-auto px-4 py-4 text-center text-sm text-gray-600">
            &copy; {{ date('Y') }} Система. Все права защищены.
        </div>
    </footer>

    <!-- Скрипт для автоматического скрытия уведомлений -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Автоматическое скрытие уведомлений через 5 секунд
            const notifications = document.querySelectorAll('.bg-green-500, .bg-red-500');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.transition = 'opacity 0.5s ease';
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.remove();
                    }, 500);
                }, 5000);
            });

            // Подтверждение удаления для всех форм
            const deleteForms = document.querySelectorAll('form[method="POST"][action*="delete"], form[method="DELETE"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Вы уверены, что хотите удалить этот элемент?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>