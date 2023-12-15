function showPreview(event) {
    const input = event.target;

    if (input.files) {
        const reader = new FileReader();

        reader.onload = (e) => {
            const previewContainer = document.querySelector('#image-preview');
            previewContainer.innerHTML = '';

            const imgContainer = document.createElement('div');
            imgContainer.classList.add('preview-image-wrapper', 'relative');

            const imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            imgElement.classList.add('rounded-md', 'mt-4', 'w-full');

            const removeIcon = document.createElement('i');
            removeIcon.classList.add('fa-solid', 'fa-circle-xmark', 'fa-2xl', 'remove-image', 'absolute', 'top-2', 'right-0', 'p-4', 'text-third', 'cursor-pointer');
            removeIcon.addEventListener('click', function () {
                previewContainer.innerHTML = '';
                input.value = '';
            });

            imgContainer.appendChild(imgElement);
            imgContainer.appendChild(removeIcon);
            previewContainer.appendChild(imgContainer);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const previewContainer = document.querySelector('#image-preview');
    const existingImage = document.querySelector('#existing-image');
    const removeIcon = document.querySelector('#remove-icon');

    if (existingImage) {
        const isLocal = window.location.hostname === 'localhost';
        const imageName = isLocal ? existingImage.src.split('/').pop() : existingImage.src;

        removeIcon.addEventListener('click', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const xhr = new XMLHttpRequest();
            xhr.open("DELETE", "/delete-image", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

            xhr.send(JSON.stringify({ imageName }));

            previewContainer.innerHTML = '';
        });

        const imgContainer = document.createElement('div');
        imgContainer.classList.add('preview-image-wrapper', 'relative');

        imgContainer.appendChild(existingImage);
        imgContainer.appendChild(removeIcon);
        previewContainer.appendChild(imgContainer);
    }
});