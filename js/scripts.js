function confirmDelete() {
    return confirm('Are you sure you want to delete this?');
}

function comparePasswords() {
    let pw1 = document.getElementById('password').value;
    let pw2 = document.getElementById('confirm').value;
    let pwMsg = document.getElementById('pwMsg');

    // compare
    if (pw1 == pw2) {
        pwMsg.innerHTML = '';
        return true;
    }
    else {
        pwMsg.innerText = 'Passwords do not match';
        return false;
    }
}