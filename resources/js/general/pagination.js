$('.paginate').on('change', function() {
    const element = $(this);
    const amount =  'amount=' + element.children('option:selected').val();
    let url = getUrl(element.data('url-id'));
    
    window.location = url + amount;
});

function getUrl(name) {
    
    switch (name) {
        case 'member':
            url = '/member?';
        break;
        case 'email':
            url = '/email?';
        break;
        case 'activity':
            url = '/activity?'
        break;
        case 'contribution':
            url = '/contribution?'
        break;
    }
    return url;
}