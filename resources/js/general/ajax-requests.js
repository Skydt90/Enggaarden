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