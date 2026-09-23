<!-- ===================== Change profile picture dialog ===================== -->
<div class="modal fade" role="dialog" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <form class="modal-content" action="{{ route('profile.picture.update') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h2 class="modal-title h5" id="changeAvatarLabel">Change profile picture</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <img class="avatar avatar-2xl profile-avatar mb-3" id="avatarPreview" src="{{ auth()->user()->profile_picture_url }}" alt="Current profile picture">

        <div class="dropzone position-relative mb-3">
          <i class="bi bi-cloud-arrow-up fs-2" aria-hidden="true"></i>
          <span class="fw-semibold text-body">Upload a new picture</span>
          <small>Square images look best · at least 320 × 320 px</small>
          <label class="visually-hidden" for="avatarFile">Upload a new profile picture</label>
          <input type="file" id="avatarFile" name="avatar" accept="image/*" data-preview-target="#avatarPreview" required>
        </div>

        @error('avatar')
          <p class="text-danger small mb-0">{{ $message }}</p>
        @enderror
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary px-4">Save picture</button>
      </div>
    </form>
  </div>
</div>
