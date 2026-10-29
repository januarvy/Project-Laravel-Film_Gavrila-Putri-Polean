<div class="form-group">
  <label for="name">Name</label>
  <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $cast->name ?? '') }}" required>
</div>
<div class="form-group">
  <label for="age">Age</label>
  <input id="age" type="number" class="form-control" name="age" value="{{ old('age', $cast->age ?? '') }}" min="1" max="120" required>
</div>
<div class="form-group">
  <label for="bio">Biography</label>
  <textarea id="bio" class="form-control" name="bio" rows="3" required>{{ old('bio', $cast->bio ?? '') }}</textarea>
</div>
