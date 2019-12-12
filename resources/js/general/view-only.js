$('.view-only').on('change', function() {
    const element = $(this);
    const type =  'type=' + element.children('option:selected').val();
    let url = '/member?';

    window.location = url + type;
});