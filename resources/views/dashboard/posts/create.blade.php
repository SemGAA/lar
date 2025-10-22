<x-layout title="Создать пост">
    <div class="max-w-4xl mx-auto">
        <div class="text-xl font-medium mb-6">Создать пост</div>
        
        <div class="bg-white border border-gray-300 p-6 rounded">
            <form action="{{ route('dashboard.posts.store') }}" method="post" class="space-y-4">
                @csrf
                
                <div>
                    <div class="text-sm mb-1">Заголовок</div>
                    <input type="text" name="title" value="{{ old('title') }}" 
                           class="w-full border border-gray-300 px-3 py-2 rounded" required>
                    @error('title')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-sm mb-1">Категория</div>
                        <select name="category_id" class="w-full border border-gray-300 px-3 py-2 rounded" required>
                            <option value="">Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="flex items-center">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="is_published" value="1" 
                                   {{ old('is_published') ? 'checked' : '' }} class="rounded">
                            <span class="text-sm">Опубликовать сразу</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <div class="text-sm mb-1">Краткое описание</div>
                    <textarea name="excerpt" class="w-full border border-gray-300 px-3 py-2 rounded" 
                              rows="2" placeholder="Необязательно">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <div class="text-sm mb-1">Содержание</div>
                    <textarea name="content" class="w-full border border-gray-300 px-3 py-2 rounded" 
                              rows="10" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 text-sm rounded">
                        Создать пост
                    </button>
                    <a href="{{ route('dashboard.posts.index') }}" 
                       class="bg-gray-300 text-gray-800 px-4 py-2 text-sm rounded">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>