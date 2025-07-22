<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        :root {
            --primary: #f59e0b;
            --primary-hover: #d97706;
            --secondary: #f3f4f6;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --border: #e5e7eb;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--bg-primary);
            border-right: 1px solid var(--border);
            padding: 1.5rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
            }
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .sidebar-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .nav-links {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--secondary);
            color: var(--primary);
        }

        .nav-link i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: 600;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            width: 300px;
        }

        .search-bar input {
            border: none;
            outline: none;
            background: transparent;
            width: 100%;
            margin-left: 0.5rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: var(--bg-primary);
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-card-title {
            font-size: 1rem;
            color: var(--text-secondary);
        }

        .stat-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-card-value {
            font-size: 1.875rem;
            font-weight: 600;
        }

        .stat-card-description {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-top: 0.5rem;
        }

        .bg-primary-light {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--primary);
        }

        .bg-success-light {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--primary);
        }

        .bg-warning-light {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--primary);
        }

        .bg-danger-light {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--primary);
        }

        /* User Table */
        .card {
            background-color: var(--bg-primary);
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
            overflow-x: auto;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            outline: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--secondary);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background-color: var(--border);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        th {
            font-weight: 600;
            color: var(--text-secondary);
        }

        tbody tr:hover {
            background-color: var(--bg-secondary);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-details {
            margin-left: 1rem;
        }

        .user-name {
            font-weight: 500;
        }

        .user-email {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .status {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-inactive {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--secondary);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-icon:hover {
            background-color: var(--border);
            color: var(--text-primary);
        }

        /* Modal */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: var(--bg-primary);
            border-radius: 0.5rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .modal-close {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.25rem;
            color: var(--text-secondary);
        }

        .modal-body {
            padding: 1.25rem;
        }

        .modal-footer {
            padding: 1.25rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            outline: none;
            transition: border-color 0.2s ease;
            background-color: var(--bg-primary);
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 1rem;
        }

       
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h1>AdminPanel</h1>
            </div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div style="display: flex; align-items: center;">
                    
                    <h1>Dashboard</h1>
                </div>
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search...">
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3 class="stat-card-title">Total Users</h3>
                        <div class="stat-card-icon bg-primary-light">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-card-value" id="totalUsers">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3 class="stat-card-title">Active Users</h3>
                        <div class="stat-card-icon bg-success-light">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <div class="stat-card-value" id="activeUsers">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3 class="stat-card-title">Inactive Users</h3>
                        <div class="stat-card-icon bg-warning-light">
                            <i class="fas fa-user-clock"></i>
                        </div>
                    </div>
                    <div class="stat-card-value" id="inactiveUsers">0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-header">
                        <h3 class="stat-card-title">New Users</h3>
                        <div class="stat-card-icon bg-danger-light">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <div class="stat-card-value" id="pendingUsers">0</div>
                </div>
            </div>

            <!-- User Management -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">User Management</h2>
                    <button class="btn btn-primary" id="addUserBtn">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            <!-- User rows will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Add/Edit User Modal -->
    <div class="modal" id="userModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Add New User</h2>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" id="userId" value="">
                    <div class="form-group">
                        <label for="userName" class="form-label">Full Name</label>
                        <input type="text" id="userName" class="form-control" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmail" class="form-label">Email Address</label>
                        <input type="email" id="userEmail" class="form-control" placeholder="Enter email address" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="userRole" class="form-label">Role</label>
                            <select id="userRole" class="form-select" required>
                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                <option value="Moderator">Moderator</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userStatus" class="form-label">Status</label>
                            <select id="userStatus" class="form-select" required>
                                <option value="">Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" id="userPassword" class="form-control" placeholder="Enter password">
                        <div class="form-hint" id="passwordHint">Leave blank to keep current password when editing</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelBtn">Cancel</button>
                <button class="btn btn-primary" id="saveUserBtn">Save User</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Confirm Delete</h2>
                <button class="modal-close" id="closeDeleteModal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                <input type="hidden" id="deleteUserId" value="">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelDeleteBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const userModal = document.getElementById('userModal');
        const deleteModal = document.getElementById('deleteModal');
        const addUserBtn = document.getElementById('addUserBtn');
        const closeModal = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const saveUserBtn = document.getElementById('saveUserBtn');
        const closeDeleteModal = document.getElementById('closeDeleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const modalTitle = document.getElementById('modalTitle');
        const userForm = document.getElementById('userForm');
        const userId = document.getElementById('userId');
        const deleteUserId = document.getElementById('deleteUserId');
        const searchInput = document.getElementById('searchInput');
        const userTableBody = document.getElementById('userTableBody');
        const totalUsersElement = document.getElementById('totalUsers');
        const activeUsersElement = document.getElementById('activeUsers');
        const inactiveUsersElement = document.getElementById('inactiveUsers');
        const pendingUsersElement = document.getElementById('pendingUsers');

        // Sample user data (in a real app, this would come from a database)
        let users = [
            {
                id: 1,
                name: 'Aditya satpute',
                email: '',
                role: 'Admin',
                status: 'Active',
            },
            {
                id: 2,
                name: 'Aniket satpute',
                email: '',
                role: 'user',
                status: 'Active',
            }
        ];

        // Initialize the dashboard
        function initDashboard() {
            renderUserTable();
            updateStatCards();
        }

        // Render the user table
        function renderUserTable(filteredData = null) {
            const data = filteredData || users;
            userTableBody.innerHTML = '';
            
            data.forEach(user => {
                const row = document.createElement('tr');
                
                // Get status class
                let statusClass = '';
                switch(user.status) {
                    case 'Active':
                        statusClass = 'status-active';
                        break;
                    case 'Inactive':
                        statusClass = 'status-inactive';
                        break;
                    case 'Pending':
                        statusClass = 'status-pending';
                        break;
                }
                
                row.innerHTML = `
                    <td>
                        <div class="user-info">
                            <div class="user-details">
                                <div class="user-name">${user.name}</div>
                                <div class="user-email">${user.email}</div>
                            </div>
                        </div>
                    </td>
                    <td>${user.role}</td>
                    <td><span class="status ${statusClass}">${user.status}</span></td>
                    <td>${user.lastLogin}</td>
                    <td>
                        <div class="actions">
                            <button class="btn-icon edit-user" data-id="${user.id}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-icon delete-user" data-id="${user.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                userTableBody.appendChild(row);
            });
            
            // Add event listeners to the newly created buttons
            document.querySelectorAll('.edit-user').forEach(button => {
                button.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openEditUserModal(id);
                });
            });
            
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', function() {
                    const id = parseInt(this.getAttribute('data-id'));
                    openDeleteModal(id);
                });
            });
        }

        // Update stat cards
        function updateStatCards() {
            totalUsersElement.textContent = users.length;
            activeUsersElement.textContent = users.filter(user => user.status === 'Active').length;
            inactiveUsersElement.textContent = users.filter(user => user.status === 'Inactive').length;
            pendingUsersElement.textContent = users.filter(user => user.status === 'Pending').length;
        }

        // Open add user modal
        function openAddUserModal() {
            modalTitle.textContent = 'Add New User';
            userForm.reset();
            userId.value = '';
            document.getElementById('passwordHint').textContent = '';
            userModal.classList.add('active');
        }

        // Open edit user modal
        function openEditUserModal(id) {
            const user = users.find(u => u.id === id);
            if (user) {
                modalTitle.textContent = 'Edit User';
                userId.value = user.id;
                document.getElementById('userName').value = user.name;
                document.getElementById('userEmail').value = user.email;
                document.getElementById('userRole').value = user.role;
                document.getElementById('userStatus').value = user.status;
                document.getElementById('userPassword').value = '';
                document.getElementById('passwordHint').textContent = 'Leave blank to keep current password';
                userModal.classList.add('active');
            }
        }

        // Open delete confirmation modal
        function openDeleteModal(id) {
            deleteUserId.value = id;
            deleteModal.classList.add('active');
        }

        // Save user (add or update)
        function saveUser() {
            const id = userId.value ? parseInt(userId.value) : 0;
            const name = document.getElementById('userName').value;
            const email = document.getElementById('userEmail').value;
            const role = document.getElementById('userRole').value;
            const status = document.getElementById('userStatus').value;
            const password = document.getElementById('userPassword').value;
            
            if (!name || !email || !role || !status) {
                alert('Please fill in all required fields');
                return;
            }
            
            if (id === 0) {
                // Add new user
                const newId = users.length > 0 ? Math.max(...users.map(u => u.id)) + 1 : 1;
                const now = new Date();
                const formattedDate = now.toISOString().split('T')[0] + ' ' + 
                                     now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                
                users.push({
                    id: newId,
                    name,
                    email,
                    role,
                    status,
                    lastLogin: formattedDate
                });
                alert('User added successfully!');
            } else {
                // Update existing user
                const index = users.findIndex(u => u.id === id);
                if (index !== -1) {
                    users[index] = {
                        ...users[index],
                        name,
                        email,
                        role,
                        status
                    };
                    alert('User updated successfully!');
                }
            }
            
            // Update the UI
            renderUserTable();
            updateStatCards();
            userModal.classList.remove('active');
        }

        // Delete user
        function deleteUser() {
            const id = parseInt(deleteUserId.value);
            users = users.filter(u => u.id !== id);
            alert('User deleted successfully!');
            
            // Update the UI
            renderUserTable();
            updateStatCards();
            deleteModal.classList.remove('active');
        }

        // Filter users based on search query
        function filterUsers(query) {
            if (!query.trim()) {
                renderUserTable();
                return;
            }
            
            const filtered = users.filter(user => 
                user.name.toLowerCase().includes(query.toLowerCase()) ||
                user.email.toLowerCase().includes(query.toLowerCase()) ||
                user.role.toLowerCase().includes(query.toLowerCase()) ||
                user.status.toLowerCase().includes(query.toLowerCase())
            );
            
            renderUserTable(filtered);
        }

        // Event Listeners
        // Toggle sidebar on mobile
       

        // Open Add User Modal
        addUserBtn.addEventListener('click', openAddUserModal);

        // Close User Modal
        closeModal.addEventListener('click', () => {
            userModal.classList.remove('active');
        });

        // Cancel User Modal
        cancelBtn.addEventListener('click', () => {
            userModal.classList.remove('active');
        });

        // Close Delete Modal
        closeDeleteModal.addEventListener('click', () => {
            deleteModal.classList.remove('active');
        });

        // Cancel Delete Modal
        cancelDeleteBtn.addEventListener('click', () => {
            deleteModal.classList.remove('active');
        });

        // Save User
        saveUserBtn.addEventListener('click', saveUser);

        // Confirm Delete
        confirmDeleteBtn.addEventListener('click', deleteUser);

        // Search functionality
        searchInput.addEventListener('input', (e) => {
            filterUsers(e.target.value);
        });

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === userModal) {
                userModal.classList.remove('active');
            }
            if (e.target === deleteModal) {
                deleteModal.classList.remove('active');
            }
        });

        // Navigation links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Initialize the dashboard when the page loads
        document.addEventListener('DOMContentLoaded', initDashboard);
    </script>
</body>
</html>