document.addEventListener('DOMContentLoaded', function () {
    let likeForms = document.querySelectorAll('.like-form');
    let unlikeForms = document.querySelectorAll('.unlike-form');

    function submitForm(form, method, onSuccess, status) {
        let formData = new FormData(form);

        let xhr = new XMLHttpRequest();
        xhr.open(method, form.action, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', formData.get('_token'));

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                onSuccess(form);

                let buttonId = form.dataset.buttonId;
                sessionStorage.setItem('status_' + buttonId, status);
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        };

        xhr.send(formData);
    }

    function handleLikeFormSubmit(event) {
        event.preventDefault();
        submitForm(this, 'POST', function (form) {
            form.classList.add('hidden');
            let buttonId = form.dataset.buttonId;
            unlikeForms.forEach(function (unlikeForm) {
                if (unlikeForm.dataset.buttonId === buttonId) {
                    unlikeForm.classList.remove('hidden');
                }
            });
        }, 'open');
    }

    function handleUnlikeFormSubmit(event) {
        event.preventDefault();
        submitForm(this, 'DELETE', function (form) {
            form.classList.add('hidden');
            let buttonId = form.dataset.buttonId;
            likeForms.forEach(function (likeForm) {
                if (likeForm.dataset.buttonId === buttonId) {
                    likeForm.classList.remove('hidden');
                }
            });
        }, 'close');
    }

    likeForms.forEach(function (form) {
        form.addEventListener('submit', handleLikeFormSubmit);
    });

    unlikeForms.forEach(function (form) {
        form.addEventListener('submit', handleUnlikeFormSubmit);
    });

    likeForms.forEach(function (likeForm) {
        let buttonId = likeForm.dataset.buttonId;
        let status = sessionStorage.getItem('status_' + buttonId);
        if (status === 'open') {
            likeForm.classList.add('hidden');
            unlikeForms.forEach(function (unlikeForm) {
                if (unlikeForm.dataset.buttonId === buttonId) {
                    unlikeForm.classList.remove('hidden');
                    likeForm.classList.add('hidden');
                }
            });
        } else if (status === 'close') {
            unlikeForms.forEach(function (unlikeForm) {
                if (unlikeForm.dataset.buttonId === buttonId) {
                    unlikeForm.classList.add('hidden');
                    likeForm.classList.remove('hidden');
                }
            });
        }
    });
});
