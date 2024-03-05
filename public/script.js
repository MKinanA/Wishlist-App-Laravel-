const aftertag = document.URL.split('#')[1];
if (aftertag == 'back') {
    sessionStorage.setItem('reload', 'true');
    history.back();
};

window.addEventListener('pageshow', function() {
    if (sessionStorage.getItem('reload') == 'true') {
        sessionStorage.removeItem('reload');
        location.reload();
    };

    if (sessionStorage.getItem('edit') == 'true') {
        document.body.scrollTop = document.documentElement.scrollTop = 0;
        document.querySelector('#input-card form').setAttribute('action', '../update');
        document.getElementById('input-title').innerText = 'Editing an existing wishlist item';
        document.getElementById('input-id').value = sessionStorage.getItem('id');
        document.getElementById('input-name').value = sessionStorage.getItem('name');
        document.getElementById('input-price').value = sessionStorage.getItem('price');
        document.getElementById('input-desc').value = sessionStorage.getItem('desc');
        document.getElementById('image-type-input').value = sessionStorage.getItem('img_type');
        document.getElementById('image-preview').setAttribute('src', `data:${sessionStorage.getItem('img_type')};base64,${sessionStorage.getItem('img')}` != 'data:;base64,' ? `data:${sessionStorage.getItem('img_type')};base64,${sessionStorage.getItem('img')}` : '../image_placeholder.png');
        document.getElementById('reload-button').removeAttribute('hidden');
        document.getElementById('submit-button').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>';
        sessionStorage.removeItem('edit');
    };

    if (sessionStorage.getItem('scroll-bottom') == 'true') {
        sessionStorage.removeItem('scroll-bottom');
        document.body.scrollTop = document.body.scrollHeight;
        document.documentElement.scrollTop = document.documentElement.scrollHeight;
    };
});

const image_preview = document.getElementById('image-preview'),
image_input = document.getElementById('image-input'),
image_type_input = document.getElementById('image-type-input'),
reader = new FileReader();

reader.addEventListener('load', function(event) {
    image_preview.setAttribute('src', event.target.result);
});

image_input.addEventListener('change', function() {
    var file = this.files[0];
    image_type_input.value = file.type;
    if (file) {
        reader.readAsDataURL(file);
    };
});