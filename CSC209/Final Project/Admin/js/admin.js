function makeTable(data) {
  if (!Array.isArray(data)) {
    data = [];
  }

  const baseCols = ['username', 'password', 'position'];


  const extraSet = new Set();

  for (let i = 0; i < data.length; i++) {
    const user = data[i];
    for (const key in user) {
      if (!baseCols.includes(key)) {
        extraSet.add(key);
      }
    }
  }

  const extraCols = Array.from(extraSet);
  const cols = baseCols.concat(extraCols);  


  let html = '<table border="1" style="border-collapse:collapse;width:100%">';
  html += '<tr>';
  cols.forEach(col => {
    const label = col.charAt(0).toUpperCase() + col.slice(1);
    html += `<th>${label}</th>`;
  });
  html += '<th>Action</th>';
  html += '</tr>';


  for (let i = 0; i < data.length; i++) {
    const user = data[i];
    html += '<tr>';

    cols.forEach(col => {
      const value = user[col] !== undefined ? user[col] : '';
      html += `<td>${value}</td>`;
    });

    html += `
      <td>
        <button class="editBtn" index="${i}">Edit</button>
        <button class="deleteBtn" username="${user.username}">Delete</button>
      </td>
    `;

    html += '</tr>';
  }

  html += '</table>';
  document.getElementById('table').innerHTML = html;


  const editBtns = document.querySelectorAll('.editBtn');
  editBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const index = this.getAttribute('index');
      editUser(index);
    });
  });

  const deleteBtns = document.querySelectorAll('.deleteBtn');
  deleteBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const username = this.getAttribute('username');
      deleteUser(username);
    });
  });
}


function refresh(){
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'admin.html.php?ajax=1');
  xhr.onload = function(){
    try {
      const data = JSON.parse(xhr.responseText);
      users = data;
      makeTable(users);
    } catch (e) {
      console.error('Error parsing JSON:', e, xhr.responseText);
      document.getElementById('table').innerHTML = '<p>Error loading users.</p>';
    }
  };
  xhr.send();
}

function deleteUser(username){
  if (!confirm('Are you sure you want to delete user "' + username + '"?')) {
    return;
  }
  const formData = new FormData();
  formData.append('username', username);

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'deleteUser.php');
  xhr.onload = function(){
    const response = JSON.parse(xhr.responseText);
    if (response.success) {
      alert('User deleted successfully!');
      refresh();
    } else {
      alert('Error: ' + (response.message || 'Failed to delete user'));
    }
  };
  xhr.send(formData);
}

function editUser(index){
  const user = users[index];
  const oldUsername = user.username;

  let newUsername = prompt('Enter new username (leave blank to keep current):', user.username);
  if (newUsername == null) return;

  let newPassword = prompt('Enter new password (leave blank to keep current):', user.password);
  if (newPassword == null) return;

  const finalUsername = newUsername.trim() === '' ? oldUsername : newUsername.trim();
  const finalPassword = newPassword.trim() === '' ? user.password : newPassword.trim();

  if (finalUsername === oldUsername && finalPassword === user.password) {
    alert('No changes made.');
    return;
  }

  const formData = new FormData();
  formData.append('oldUsername', oldUsername);
  formData.append('newUsername', finalUsername);
  formData.append('newPassword', finalPassword);
  formData.append('position', user.position);

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'editUser.php');
  xhr.onload = function(){
    const response = JSON.parse(xhr.responseText);
    if (response.success) {
      alert('User updated successfully!');
      refresh();
    } else {
      alert('Error: ' + (response.message || 'Failed to update user'));
    }
  };
  xhr.send(formData);
}

document.getElementById('refreshBtn').addEventListener('click', refresh);
refresh();
