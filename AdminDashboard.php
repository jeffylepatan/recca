<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li {
            display: inline;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .main {
            padding: 20px;
        }

        .section {
            background: white;
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .hidden {
            display: none;
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Admin Dashboard</h1>
        <ul class="nav-links">
            <li><a href="#accounts" class="nav-link">Accounts</a></li>
            <li><a href="#products" class="nav-link">Products</a></li>
            <li><a href="#inventory" class="nav-link">Inventory</a></li>
        </ul>
    </nav>
    <main>
        <section id="accounts" class="section">
            <h2>Accounts</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody id="accountsTableBody">
                    
                </tbody>
            </table>
        </section>
        <section id="products" class="section hidden">
            <h2>Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    
                </tbody>
            </table>
        </section>
        <section id="inventory" class="section hidden">
            <h2>Inventory</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="inventoryTableBody">
                    
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const accountsTableBody = document.getElementById('accountsTableBody');
        const productsTableBody = document.getElementById('productsTableBody');
        const inventoryTableBody = document.getElementById('inventoryTableBody');

        const accounts = [
            { id: 1234567, name: 'admin', email: 'Admin123@gmail.com', password: 'Admin12345' },
            { id: 2210296, name: 'Jane Smith', email: 'jane.smith@example.com', password: '' },
            { id: 1234567, name: 'admin', email: 'Admin123@gmail.com', password: 'Admin12345' },
            { id: 1234567, name: 'admin', email: 'Admin123@gmail.com', password: 'Admin12345' },
        ];

        const products = [
            { id: 1, name: 'Product A', price: '$10' },
            { id: 2, name: 'Product B', price: '$20' },
        ];

        const inventory = [
            { id: 1, productName: 'Product A', quantity: 100 },
            { id: 2, productName: 'Product B', quantity: 50 },
        ];

        function populateTable(data, tableBody) {
            tableBody.innerHTML = '';
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.id}</td>
                    <td>${item.name || item.productName}</td>
                    <td>${item.email || item.price || item.quantity}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        populateTable(accounts, accountsTableBody);
        populateTable(products, productsTableBody);
        populateTable(inventory, inventoryTableBody);

        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.section');

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetSection = document.querySelector(link.getAttribute('href'));

                sections.forEach(section => {
                    section.classList.add('hidden');
                });

                targetSection.classList.remove('hidden');
            });
        });
    });
</script>
