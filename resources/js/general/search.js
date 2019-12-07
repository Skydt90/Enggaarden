function searchTable(name) {
    
    const input = document.getElementById('search');
    const filter = input.value.toUpperCase();
    const table = document.getElementById(name);
    const tr = table.getElementsByTagName('tr');
    let td;
    let txtValue;
  
    // Loop through all table rows, and hide those who dont match the search query
    for (i = 0; i < tr.length; i++) {
        
        td = tr[i].getElementsByTagName('td')[0]; // only check first td field in row
        if (td) {
            txtValue = td.textContent; // all values from first td in all trs
            
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = '';
            } else {
                tr[i].style.display = 'none';
            }
        }
    }
}