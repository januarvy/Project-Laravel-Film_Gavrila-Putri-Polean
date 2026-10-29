<div class="form-group">
  <label for="actor">Character / Role Name</label>
  <input id="actor" type="text" class="form-control" name="actor" value="{{ old('actor', $peran->actor ?? '') }}" placeholder="e.g. Bryan (Medical Courier)" required>
</div>
<div class="form-group">
  <label for="film_id">Film</label>
  <select id="film_id" class="form-control" name="film_id" required>
    <option value="">-- Select a Film --</option>
    @foreach ($films as $film)
      <option value="{{ $film->id }}" {{ old('film_id', $peran->film_id ?? '') == $film->id ? 'selected' : '' }}>{{ $film->title }}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="cast_id">Cast Member</label>
  <select id="cast_id" class="form-control" name="cast_id" required>
    <option value="">-- Select a Cast Member --</option>
    @foreach ($casts as $cast)
      <option value="{{ $cast->id }}" {{ old('cast_id', $peran->cast_id ?? '') == $cast->id ? 'selected' : '' }}>{{ $cast->name }}</option>
    @endforeach
  </select>
</div>
