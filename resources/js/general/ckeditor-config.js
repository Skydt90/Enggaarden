document.addEventListener("DOMContentLoaded", function() {
    
    ClassicEditor.create( document
        .querySelector('.ck-editor'))
        .catch( error => {
            console.error(error);
        });
});