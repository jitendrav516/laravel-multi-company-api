<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #43cea2, #185a9d);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: rgba(255, 255, 255, 0.15);
      padding: 30px;
      border-radius: 12px;
      width: 350px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.18);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input {
      width: 100%;
      padding: 12px 10px;
      margin: 10px 0;
      border: none;
      border-radius: 8px;
      outline: none;
      font-size: 14px;
    }
    button {
      width: 100%;
      padding: 12px;
      margin-top: 10px;
      border: none;
      border-radius: 8px;
      background: #00c6ff;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #0072ff;
    }
    #result {
      margin-top: 15px;
      text-align: center;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form id="loginForm">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p id="result"></p>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = {
        email: this.email.value,
        password: this.password.value
      };
      const res = await fetch('/api/login', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(formData)
      });
      const data = await res.json();
      if(res.ok) {
        localStorage.setItem('token', data.token);
        document.getElementById('result').style.color = 'lightgreen';
        document.getElementById('result').innerText = 'Login successful! Redirecting...';
        setTimeout(() => {
          window.location.href = '/companies-page';
        }, 1000);
      } else {
        document.getElementById('result').style.color = 'salmon';
        document.getElementById('result').innerText = data.message || 'Invalid credentials';
      }
    });
  </script>
</body>
</html>
