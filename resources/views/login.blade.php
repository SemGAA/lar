<x-layout title="Авторизация">
    <div class="max-w-md mx-auto">
        <div class="text-xl font-medium mb-6">Авторизация</div>
        
        <div class="bg-white border border-gray-300 p-6">
            <form action="{{ route('login') }}" method="post" class="space-y-4">
                @csrf
                
                <div>
                    <div class="text-sm mb-1">Email</div>
                    <input type="email" name="email" class="w-full border border-gray-300 px-3 py-2" required>
                    @error('email')
                        <div class="text-sm text-gray-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <div class="text-sm mb-1">Пароль</div>
                    <input type="password" name="password" class="w-full border border-gray-300 px-3 py-2" required>
                    @error('password')
                        <div class="text-sm text-gray-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="w-full bg-gray-800 text-white py-2 text-sm">
                    Войти в систему
                </button>
            </form>
            
            <div class="mt-4 pt-4 border-t border-gray-200 text-center">
                <a href="{{ route('registerIndex') }}" class="text-sm underline">Создать аккаунт</a>
            </div>
        </div>
    </div>
</x-layout>