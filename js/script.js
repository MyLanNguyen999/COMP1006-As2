// * add function for confirmDelete for deleting users
function confirmDelete() {
    if (confirm('Are you sure you want to delete this?') == true) {
    //* user clicked OK so execute the link
    return true;
    }
    else {
    //* user clicked Cancel so stop execution
    return false;
  }
}

// * showHide for password icon on Registration page
function togglePassword() {
  let pwInput = document.getElementById('password');
  let img = document.getElementById('showHide');

  if (pwInput.type == 'password') {
    pwInput.type = 'text';
    img.src = 'img/hide.png';
  }

  else {
    pwInput.type = 'password';
    img.src = 'img/show.png';
  }
}

// * function to compare password on registration page
function comparePasswords() {
  let password = document.getElementById('password').value;
  let confirm = document.getElementById('confirm').value;
  let pwErr = document.getElementById('pwErr');

  if (password != confirm) {
    pwErr.innerText = 'Passwords do not match';
    return false;
  }

  else {
    pwErr.innerText = '';
    return true;
  }

}
