<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multi Company API Frontend</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Multi Company API Test</h1>

    <section>
        <h2>Register</h2>
        <input type="text" id="reg_name" placeholder="Name">
        <input type="email" id="reg_email" placeholder="Email">
        <input type="password" id="reg_password" placeholder="Password">
        <input type="password" id="reg_password_conf" placeholder="Confirm Password">
        <button onclick="registerUser()">Register</button>
    </section>

    <section>
        <h2>Login</h2>
        <input type="email" id="login_email" placeholder="Email">
        <input type="password" id="login_password" placeholder="Password">
        <button onclick="loginUser()">Login</button>
    </section>

    <section>
        <h2>Companies</h2>
        <input type="text" id="company_name" placeholder="Company Name">
        <button onclick="createCompany()">Create Company</button>
        <button onclick="listCompanies()">List Companies</button>
        <div id="company_list"></div>
    </section>

    <script src="script.js"></script>
</body>
</html>
