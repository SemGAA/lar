<x-layout title="Редактировать пост">
    <div class="max-w-4xl mx-auto">
        <div class="text-xl font-medium mb-6">Редактировать пост</div>
        
        <div class="bg-white border border-gray-300 p-6">
            <form action="{{ route('dashboard.posts.update', $post) }}" method="post" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <div class="text-sm mb-1">Заголовок</div>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" 
                           class="w-full border border-gray-300 px-3 py-2" required>
                    @error('title')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-sm mb-1">Категория</div>
                        <select name="category_id" class="w-full border border-gray-300 px-3 py-2" required>
                            <option value="">Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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
                                   {{ old('is_published', $post->is_published) ? 'checked' : '' }} class="rounded">
                            <span class="text-sm">Опубликован</span>
                        </label>
                    </div>
                </div>
                
                <div>
                    <div class="text-sm mb-1">Краткое описание</div>
                    <textarea name="excerpt" class="w-full border border-gray-300 px-3 py-2" 
                              rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div>
                    <div class="text-sm mb-1">Содержание</div>
                    <textarea name="content" class="w-full border border-gray-300 px-3 py-2" 
                              rows="10" required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 text-sm">
                        Обновить пост
                    </button>
                    <a href="{{ route('dashboard.posts.index') }}" 
                       class="bg-gray-300 text-gray-800 px-4 py-2 text-sm">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>