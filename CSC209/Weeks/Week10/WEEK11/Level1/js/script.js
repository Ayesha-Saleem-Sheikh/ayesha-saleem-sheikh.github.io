function makeTable(data) {
     let html = `
     <table style="width:100%; border-collapse:collapse;" border="1">
      <tr>
        <th>Username</th>
        <th>Password</th>
        <th>Logged Times</th>
      </tr>
  `;


  for (let i = 0; i < data.length; i++) {
    html += `
      <tr>
        <td style="text-align: center;">${data[i].username}</td>
        <td style="text-align: center;">${data[i].password}</td>
        <td style="text-align: center;">${data[i].loggedtimes}</td>
      </tr>
    `;
  }

  html += "</table>";

  
  document.getElementById("table").innerHTML = html;
}

function sortbyUsers(){
    users.sort(function(a,b){
        let x = a.username.toLowerCase();
        let y = b.username.toLowerCase();
        if (x <y) {return -1;}
        if (x>y){return 1;}
        return 0 ;});
        makeTable(users);
        }

function sortbyPassword(){
    users.sort(function(a,b){
        let x = a.password.toLowerCase();
        let y = b.password.toLowerCase();
        if (x <y) {return -1;}
        if (x>y){return 1;}
        return 0 ;});
        makeTable(users);
        }

function sortbyLoggedtimes(){
    users.sort(function(a,b){
    return a.loggedtimes - b.loggedtimes;
    });
    makeTable(users);
}


makeTable(users);
