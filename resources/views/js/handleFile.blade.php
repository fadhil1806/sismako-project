<script>
function handleFileUpload(event, inputName) {
    const fileInput = event.target;
    const files = fileInput.files;
    const removeButton = document.getElementById(`btn-remove-${inputName}`);
    if (files.length > 0) {
      removeButton.classList.remove('d-none');
    } else {
      removeButton.classList.add('d-none');
    }
}

function removeFile(inputName) {
  const fileInput = document.querySelector(`input[name="${inputName}"]`);
  fileInput.value = '';
  console.log(`File removed: ${inputName}`);
}
</script>