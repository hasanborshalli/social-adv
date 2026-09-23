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
});
