<x-layout title="Категории">
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <div class="text-xl font-medium">Категории</div>
            <a href="{{ route('dashboard.categories.create') }}" 
               class="bg-gray-800 text-white px-4 py-2 text-sm">
                Создать категорию
            </a>
        </div>
        
        <div class="bg-white border border-gray-300">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="text-left p-3 text-sm font-medium">Название</th>
                        <th class="text-left p-3 text-sm font-medium">Кол-во постов</th>
                        <th class="text-left p-3 text-sm font-medium">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr class="border-b border-gray-200">
                        <td class="p-3 text-sm">
                            <div class="font-medium">{{ $category->name }}</div>
                            @if($category->description)
                                <div class="text-gray-600 text-xs mt-1">{{ $category->description }}</div>
                            @endif
                        </td>
                        <td class="p-3 text-sm">{{ $category->posts_count }}</td>
                        <td class="p-3 text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('dashboard.categories.edit', $category) }}" 
                                   class="text-blue-600 underline text-sm">
                                    Редактировать
                                </a>
                                <form action="{{ route('dashboard.categories.destroy', $category) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 underline text-sm" 
                                            onclick="return confirm('Удалить категорию?')">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div>
            <a href="{{ route('dashboard.home') }}" class="text-sm underline">В панель управления</a>
        </div>
    </div>
</x-layout>