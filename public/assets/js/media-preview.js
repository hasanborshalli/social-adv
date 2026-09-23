document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[type="file"][data-preview-target]').forEach((input) => {
    const target = document.querySelector(input.dataset.previewTarget);

    if (!target) {
      return;
    }

    const originalSrc = target.src;

    input.addEventListener('change', () => {
      const file = input.files && input.files[0];

      if (!file) {
        return;
      }

      const reader = new FileReader();
      reader.onload = () => {
        target.src = reader.result;
      };
      reader.readAsDataURL(file);
    });

    const modal = input.closest('.modal');

    if (modal) {
      modal.addEventListener('hidden.bs.modal', () => {
        input.value = '';
        target.src = originalSrc;
      });
    }
  });

  document.querySelectorAll('input[type="file"][data-preview-image]').forEach((input) => {
    const imagePreview = document.querySelector(input.dataset.previewImage);
    const videoPreview = input.dataset.previewVideo ? document.querySelector(input.dataset.previewVideo) : null;
    const hint = input.dataset.previewHint ? document.querySelector(input.dataset.previewHint) : null;

    if (!imagePreview) {
      return;
    }

    let objectUrl = null;

    const reset = () => {
      imagePreview.src = '';
      imagePreview.classList.add('d-none');

      if (videoPreview) {
        videoPreview.pause();
        videoPreview.removeAttribute('src');
        videoPreview.load();
        videoPreview.classList.add('d-none');
      }

      if (objectUrl) {
        URL.revokeObjectURL(objectUrl);
        objectUrl = null;
      }

      hint?.classList.remove('d-none');
    };

    input.addEventListener('change', () => {
      const file = input.files && input.files[0];

      if (!file) {
        reset();
        return;
      }

      hint?.classList.add('d-none');

      if (videoPreview && file.type.startsWith('video/')) {
        imagePreview.classList.add('d-none');
        objectUrl = URL.createObjectURL(file);
        videoPreview.src = objectUrl;
        videoPreview.classList.remove('d-none');
        return;
      }

      videoPreview?.classList.add('d-none');

      const reader = new FileReader();
      reader.onload = () => {
        imagePreview.src = reader.result;
        imagePreview.classList.remove('d-none');
      };
      reader.readAsDataURL(file);
    });

    const modal = input.closest('.modal');

    if (modal) {
      modal.addEventListener('hidden.bs.modal', () => {
        input.value = '';
        reset();
      });
    }
  });
});
