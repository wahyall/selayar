<div class="pagination">
  @if ($paginator->currentPage() > 1)
    <a class="btn prev" href="{{ $paginator->previousPageUrl() }}">
      <i class="fas fa-chevron-left"></i> Prev
    </a>
  @endif
  
  @if ($paginator->currentPage() < $paginator->lastPage())
    <a class="btn next" href="{{ $paginator->nextPageUrl() }}">
      Next <i class="fas fa-chevron-right"></i>
    </a>
  @endif
</div>
