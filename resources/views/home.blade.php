<x-layout>
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Главная страница</h1>
        
        @auth
            <div class=" p-4 rounded mb-4">
                <h2 class="text-xl mb-2">Добро пожаловать, {{ Auth::user()->fio }}!</h2>
                <p>Вы успешно вошли в систему.</p>
                
                @if(Auth::user()->is_admin)
                    <div class="mt-4">
                        <h3 class="font-bold">Админ панель:</h3>

                        <button class="b-4 "> <a href="{{ route('dashboard.users.index') }}" class="text-blue-600 underline">Управление пользователями</a></button>
                    </div>
                @endif
            </div>
        @endauth
        

    </div>
</x-layout>