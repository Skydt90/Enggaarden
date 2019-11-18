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
            const success = document.getElementById('success');
            const dismiss = document.getElementById('dismiss');
            
            success.click(setTimeout(function() {
                dismiss.click();
            }, 1500));
            
        }
        const result = `${response.statusText}: ${response.status}`;
        return result;
    }
    
    async post(url, data, showSuccess) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
            },
            body: data
        });
        const result = await response.json();
        return result;
    }

}
document.addEventListener("DOMContentLoaded", function() {
    
    //delete modal
    document.querySelector('.member-delete-button').addEventListener('click', function() {
        const ajax = new AjaxRequests();
        const id = this.getAttribute('data-id');
        const url = `/test/delete/${id}`;

        ajax.delete(url, true)
            .then(data => {
                console.log('Server responded with: ' + data);
                document.getElementById('dismiss').click();
            })
            .catch(error => console.log(error));
    });

    //post modal
    document.querySelector('.register-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const ajax = new AjaxRequests();
        const form = new FormData(this);
        const url = 'member';

        ajax.post(url, form)
            .then(data => console.log('Server Responded with: ' + data))
            .catch(error => console.log(error));
    })


});