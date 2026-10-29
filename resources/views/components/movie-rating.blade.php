@props(['rating' => 3.5])

<span class="movie-rating" aria-label="Rating {{ number_format($rating, 1) }} out of 5">
  @foreach (range(1, 5) as $star)
    @php($fill = max(0, min(1, $rating - $star + 1)) * 100)
    <span class="movie-rating-star" aria-hidden="true">
      <i class="fa fa-star"></i>
      <span class="movie-rating-fill" style="width: {{ $fill }}%">
        <i class="fa fa-star"></i>
      </span>
    </span>
  @endforeach
  <span class="movie-rating-value">{{ number_format($rating, 1) }}</span>
</span>
