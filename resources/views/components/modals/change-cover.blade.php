<!-- ===================== Change cover photo dialog ===================== -->
<div class="modal fade" role="dialog" id="changeCoverModal" tabindex="-1" aria-labelledby="changeCoverLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form class="modal-content" action="{{ route('profile.cover.update') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h2 class="modal-title h5" id="changeCoverLabel">Change cover photo</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <img class="cover rounded mb-3" id="coverPreview" src="{{ auth()->user()->cover_photo_url }}" alt="Current cover photo">

        <div class="dropzone position-relative">
          <i class="bi bi-image fs-2" aria-hidden="true"></i>
          <span class="fw-semibold text-body">Upload a new cover</span>
          <small>Wide images work best · at least 1600 × 500 px</small>
          <label class="visually-hidden" for="coverFile">Upload a new cover photo</label>
          <input type="file" id="coverFile" name="cover" accept="image/*" data-preview-target="#coverPreview" required>
        </div>

        @error('cover')
          <p class="text-danger small mb-0 mt-2">{{ $message }}</p>
        @enderror

        <div class="form-text mt-2">Your cover photo is public and visible to anyone who opens your profile.</div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary px-4">Save cover</button>
      </div>
    </form>
  </div>
</div>
