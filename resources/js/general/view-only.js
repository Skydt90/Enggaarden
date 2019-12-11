$('.view-only').on('change', function() {
    const element = $(this);
    const type =  'type=' + element.children('option:selected').val();
    let url = '/member?';//getUrl(element.data('url-id'));

    window.location = url + type;
});

/* function getUrl(name) {
    
    switch (name) {
        case 'member':
            url = '/member?';
        break;
    }
    return url;
} */