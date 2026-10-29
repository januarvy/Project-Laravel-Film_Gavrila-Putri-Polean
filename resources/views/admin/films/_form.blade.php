<div class="form-group">
  <label for="title">Judul</label>
  <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $film->title ?? '') }}" required>
</div>
<div class="form-group">
  <label for="genre_id">Genre</label>
  <select id="genre_id" class="form-control" name="genre_id" required>
    <option value="">-- Pilih Genre --</option>
    @foreach ($genres as $genre)
      <option value="{{ $genre->id }}" {{ old('genre_id', $film->genre_id ?? '') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="year">Tahun</label>
  <input id="year" type="number" class="form-control" name="year" value="{{ old('year', $film->year ?? '') }}" min="1900" max="2100" required>
</div>
<div class="form-group">
  <label for="sinopsis">Sinopsis</label>
  <textarea id="sinopsis" class="form-control" name="sinopsis" rows="5" required>{{ old('sinopsis', $film->sinopsis ?? '') }}</textarea>
</div>
<div class="form-group">
  <label for="poster">Poster</label>
  @isset($film)
    <div style="margin-bottom:8px;">
      <img style="width:120px;" class="img-responsive" src="{{ asset($film->poster) }}" alt="">
    </div>
  @endisset
  <input id="poster" type="file" name="poster" accept="image/*">
</div>
