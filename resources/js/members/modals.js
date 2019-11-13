document.addEventListener("DOMContentLoaded", function() {
    
    //delete modal
    document.querySelector('.member-delete-button').addEventListener('click', function() {
        const ajax = new AjaxRequests();
        const id = this.getAttribute('data-id');
        const url = `/test/delete/${id}`;

        ajax.delete(url, true)
            .then(data => console.log('Server responded with: ' + data))
            .catch(error => console.log(error));
    });


});