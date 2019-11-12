document.addEventListener("DOMContentLoaded", function() {
    
    //delete modal
    document.querySelector('.member-delete-button').addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const request = 'DELETE';
        const url = `/test/delete/${id}`;

        ajaxRequests(request, url, null, true, function(result) {
            console.log('success status from ajax callback: ' + result);
        });
    });

    //generalised function to handle all ajax calls. Work in progress!
    function ajaxRequests(request, url, data, showSuccess, callback) {
        const xhr = new XMLHttpRequest();
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        xhr.open(request, url);
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        xhr.send();
        xhr.onload = function() {
            
            if(this.status >= 200 && this.status < 300) {

                if(showSuccess) {
                    document.getElementById('success-button').click();
                }

                if(callback !== undefined) {
                    return callback(this.status);
                }
                return;
            } 
        }
    }

});