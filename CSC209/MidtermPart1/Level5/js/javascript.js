let Row = `<tr> 
    <td>Sample text</td> 
    <td>CheckCross1</td> 
    <td>CheckCross2</td>
    </tr>`

  // window.alert (Row);

   let Row2 = `<tr> 
    <td>Sample text</td> 
    <td><i class="fa fa-check"></i></td> 
    <td><i class="fa fa-remove"></i></td>
    </tr>`
  //window.alert (Row2);

function addRow(part1,part2){
    let Row3 = Row2.replace("fa-check",part1).replace("fa-remove",part2);
    var table = document.getElementById("table");  
    var newRow = table.insertRow(-1); 
    newRow.innerHTML = Row3;

  }