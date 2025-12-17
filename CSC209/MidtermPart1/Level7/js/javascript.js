let NROWS= 2;
let NAMES = ["Mary","Alice"];
let PART1 =["fa-check","fa-remove"];
let PART2 = ["fa-remove" ,"fa-check"];


let Row = `<tr> 
    <td>Sample text</td> 
    <td>CheckCross1</td> 
    <td>CheckCross2</td>
    </tr>`

  // window.alert (Row);

   let Row2 = `<tr> 
    <td>Sample text</td> 
    <td><i class="fa part1"></i></td> 
    <td><i class="fa part2"></i></td>
    </tr>`
  //window.alert (Row2);


function addRow(){
  for (let i =0;i<NROWS ;i++){
    let Row3 = Row2.replace("Sample text",NAMES[i]).replace("part1",PART1[i]).replace("part2",PART2[i]);
    var table = document.getElementById("table");  
    var newRow = table.insertRow(-1); 
    newRow.innerHTML = Row3;

  }
}

