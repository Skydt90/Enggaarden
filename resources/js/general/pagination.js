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
    }
    return url;
}