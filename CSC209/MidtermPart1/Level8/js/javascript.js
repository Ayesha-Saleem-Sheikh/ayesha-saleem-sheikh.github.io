let NROWS= 3;
let NAMES = ["Mary","Alice","Jake"];
let PART1 =["fa-check","fa-remove","fa-remove"];
let PART2 = ["fa-remove" ,"fa-check","fa-remove"];
let current = 0;


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

function addAll(){
  for (let i =0;i<NROWS ;i++){
    addRow();}
}

function addRow(){
  if (current< NROWS){
    let Row3 = Row2.replace("Sample text",NAMES[current]).replace("part1",PART1[current]).replace("part2",PART2[current]);
    var table = document.getElementById("table");  
    var newRow = table.insertRow(-1); 
    newRow.innerHTML = Row3;
    current ++;}
  else{
    alert("Not Enough Data. You are viewiing all the information!")
  }
  
}

