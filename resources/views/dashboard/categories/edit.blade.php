<x-layout title="Редактировать категорию">
    <div class="max-w-2xl mx-auto">
        <div class="text-xl font-medium mb-6">Редактировать категорию</div>
        
        <div class="bg-white border border-gray-300 p-6">
            <form action="{{ route('dashboard.categories.update', $category) }}" method="post" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <div class="text-sm mb-1">Название категории</div>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                           class="w-full border border-gray-300 px-3 py-2" required>
                    @error('name')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <div class="text-sm mb-1">Описание</div>
                    <textarea name="description" class="w-full border border-gray-300 px-3 py-2" 
                              rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 text-sm">
                        Обновить категорию
                    </button>
                    <a href="{{ route('dashboard.categories.index') }}" 
                       class="bg-gray-300 text-gray-800 px-4 py-2 text-sm">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>