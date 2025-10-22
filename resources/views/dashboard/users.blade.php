<x-layout title="Пользователи">
    <div class="space-y-4">
        <div class="text-xl font-medium">Пользователи системы</div>
        
        <div class="bg-white border border-gray-300">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="text-left p-3 text-sm font-medium">ФИО</th>
                        <th class="text-left p-3 text-sm font-medium">Email</th>
                        <th class="text-left p-3 text-sm font-medium">Роль</th>
                        <th class="text-left p-3 text-sm font-medium"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="border-b border-gray-200">
                        <td class="p-3 text-sm">{{ $user->fio }}</td>
                        <td class="p-3 text-sm">{{ $user->email }}</td>
                        <td class="p-3 text-sm">
                            @if($user->is_admin)
                                <span class="text-gray-600">Администратор</span>
                            @else
                                <span class="text-gray-600">Пользователь</span>
                            @endif
                        </td>
                        <td class="p-3 text-sm">
                            @if(!$user->is_admin)
                            <form action="{{ route('dashboard.users.delete', $user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm underline" 
                                        onclick="return confirm('Удалить пользователя?')">
                                    Удалить
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div>
            <a href="{{ route('home') }}" class="text-sm underline">На главную</a>
        </div>
    </div>
</x-layout>