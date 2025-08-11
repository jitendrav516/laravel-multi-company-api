<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea, #764ba2);
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
      background: #ff6a00;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #ee5400;
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
    <h2>Register</h2>
    <form id="registerForm">
        @csrf
      <input type="text" name="name" placeholder="Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
    </form>
    <p id="result"></p>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = {
        name: this.name.value,
        email: this.email.value,
        password: this.password.value,
        password_confirmation: this.password_confirmation.value
      };
      const res = await fetch('/api/register', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(formData)
      });
      const data = await res.json();
      if(res.ok) {
        document.getElementById('result').style.color = 'lightgreen';
        document.getElementById('result').innerText = 'Registration successful! Please login.';
      } else {
        document.getElementById('result').style.color = 'salmon';
        document.getElementById('result').innerText = data.message || 'Error occurred';
      }
    });
  </script>
</body>
</html>
