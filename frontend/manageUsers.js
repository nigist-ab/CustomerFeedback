document.addEventListener("DOMContentLoaded", () => {
    const userTable = document.getElementById("userTable");
    const addUserForm = document.getElementById("addUserForm");

    // Fetch and display users
    function fetchUsers() {
        fetch('/api/users')
            .then(response => response.json())
            .then(users => {
                userTable.innerHTML = users.map(user => `
                    <tr>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role}</td>
                        <td>
                            <button onclick="editUser(${user.id})">Edit</button>
                            <button onclick="deleteUser(${user.id})">Delete</button>
                        </td>
                    </tr>
                `).join('');
            });
    }

    // Add user
    addUserForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(addUserForm);
        fetch('/api/users/add', {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData)),
            headers: { 'Content-Type': 'application/json' }
        }).then(fetchUsers);
    });

    // Edit user
    window.editUser = (id) => {
        const name = prompt("Enter new name:");
        const email = prompt("Enter new email:");
        const role = prompt("Enter new role:");
        fetch('/api/users/edit', {
            method: 'POST',
            body: JSON.stringify({ id, name, email, role }),
            headers: { 'Content-Type': 'application/json' }
        }).then(fetchUsers);
    };

    // Delete user
    window.deleteUser = (id) => {
        if (confirm("Are you sure you want to delete this user?")) {
            fetch('/api/users/delete', {
                method: 'POST',
                body: JSON.stringify({ id }),
                headers: { 'Content-Type': 'application/json' }
            }).then(fetchUsers);
        }
    };

    fetchUsers();
});
