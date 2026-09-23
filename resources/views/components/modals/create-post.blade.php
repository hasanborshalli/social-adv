<!-- ===================== Create post dialog ===================== -->
<div class="modal fade" role="dialog" id="createPostModal" tabindex="-1" aria-labelledby="createPostLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <form class="modal-content" action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h2 class="modal-title h5" id="createPostLabel">Create post</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="d-flex align-items-center gap-2 mb-3">
          <img class="avatar" src="{{ auth()->user()?->profile_picture_url }}" alt="">
          <div>
            <p class="fw-semibold mb-1">{{ auth()->user()?->name }}</p>
            <label class="visually-hidden" for="postPrivacyStatus">Who can see this post</label>
            <select class="form-select form-select-sm w-auto" id="postPrivacyStatus" name="privacy_status">
              @php $privacyStatus = old('privacy_status', auth()->user()?->privacy_status?->value); @endphp
              <option value="public" @selected($privacyStatus === 'public')>🌐 Public</option>
              <option value="private" @selected($privacyStatus === 'private')>🔒 Only me</option>
            </select>
            @error('privacy_status')
              <p class="text-danger small mb-0">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <label class="visually-hidden" for="postBody">Post text</label>
        <textarea class="form-control border-0 fs-5 mb-3" id="postBody" name="body" rows="4"
                  placeholder="What's on your mind, {{ explode(' ', auth()->user()?->name ?? '')[0] }}?">{{ old('body') }}</textarea>
        @error('body')
          <p class="text-danger small mb-0">{{ $message }}</p>
        @enderror

        <div class="dropzone position-relative">
          <div id="postMediaHint">
            <i class="bi bi-image fs-2" aria-hidden="true"></i>
            <span class="fw-semibold text-body">Add a photo or video</span>
            <small>One file per post · or drag and drop it here</small>
          </div>
          <img class="dropzone-preview d-none" id="postMediaPreviewImage" alt="Selected photo preview">
          <video class="dropzone-preview d-none" id="postMediaPreviewVideo" muted playsinline autoplay loop></video>
          <label class="visually-hidden" for="postMedia">Attach a photo or video</label>
          <input type="file" id="postMedia" name="media" accept="image/*,video/*"
                 data-preview-image="#postMediaPreviewImage" data-preview-video="#postMediaPreviewVideo" data-preview-hint="#postMediaHint">
        </div>
        @error('media')
          <p class="text-danger small mb-0">{{ $message }}</p>
        @enderror
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary px-4">Post</button>
      </div>
    </form>
  </div>
</div>
