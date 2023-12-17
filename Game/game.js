var count = 0;

document.addEventListener('DOMContentLoaded', function () {
    var table = document.getElementById('shipTable');
    var playerSelect = 1;
    var Pl1cells = [];
    var Pl2cells = [];
  
    function cellClickHandler(event) {
      var cell = event.target;
  
      if (cell.innerHTML === '' && count < 14) {
        cell.style.backgroundColor = 'green';
        count++;

        if (playerSelect === 1){
            var row = cell.parentNode.rowIndex + 1;
            var column = cell.cellIndex + 1; 
            Pl1cells.push({ row: row, column: column });
        }
        else{
            var row = cell.parentNode.rowIndex + 1;
            var column = cell.cellIndex + 1; 
            Pl2cells.push({ row: row, column: column });
        }
  
        if (count === 14) {
          table.removeEventListener('click', cellClickHandler);
          playerSelect = 2;
        }
      }
    }
  
    // Add click event listener to the table
    table.addEventListener('click', cellClickHandler);
  });
  