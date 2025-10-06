<div>
     <label for="name">Título</label>
            <input type="text" id="name" name="name" required>
            </br>
            <label for="description">Descripción</label>
            <textarea id="description" name="description" required></textarea>
            </br>
            <label for="due_date">Fecha de vencimiento</label>
            <input type="date" id="due_date" name="due_date" required>
            </br>
            <label for="status">Estado</label>
            <select id="status" name="status" required>
                <option value="pending">Pendiente</option>
                <option value="in_progress">En progreso</option>
                <option value="completed">Completada</option>
            </select>
            </br>
            <label for="categories">Categorías</label>
            <select id="categories" name="categories[]" multiple>
                @foreach($categorias as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            </br>
</div>