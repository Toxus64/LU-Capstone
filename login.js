// Finds the form and listens for the submit button
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
});
function handleLogin(event) {
    // Finds the username and password boxes
    event.preventDefault();
    const username = document.getElementById('employeeUsername').value;
    const password = document.getElementById('employeePassword').value;

    // Hardcoded username/password
    const employee = {
        username: 'employee',
        password: 'password123',
        role: 'employee'
    };

    // Console for debugging purposes, if needed
    console.log(`Attempting login with username: ${username} and password: ${password}`);

    // Successful login
    if (username === employee.username && password === employee.password) {
        console.log('Login successful');
        localStorage.setItem('loggedInEmployee', JSON.stringify(employee));
        window.location.href = 'index.php';
    } else { // Not successful
        console.log('Login failed');
        document.getElementById('login-status').innerText = 'Invalid username or password'; // Updates status on login.html with the message
    }
}
