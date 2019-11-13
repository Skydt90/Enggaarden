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
class AjaxRequests 
{

    async delete(url, showSuccess) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        
        if(response.ok && showSuccess) {
            document.getElementById('success-button').click();
        }
        const result = `${response.statusText}: ${response.status}`;
        return result;
    }
    
    async post(url, data, showSuccess) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        return result;
    }

}