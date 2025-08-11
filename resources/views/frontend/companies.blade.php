<!DOCTYPE html>
<html>
<head>
  <title>Companies</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      margin: 0;
      padding: 20px;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    .container {
      max-width: 600px;
      margin: 20px auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 30px;
    }
    select, input {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    button {
      margin-top: 15px;
      width: 100%;
      padding: 12px;
      background: #4a90e2;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #357ABD;
    }
    ul {
      list-style: none;
      padding: 0;
      margin-top: 20px;
      max-height: 250px;
      overflow-y: auto;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    li {
      padding: 12px;
      border-bottom: 1px solid #eee;
      color: #555;
    }
    #result {
      margin-top: 15px;
      text-align: center;
      font-weight: 600;
      color: #333;
    }
    label {
      font-weight: 600;
      margin-top: 12px;
      display: block;
      color: #444;
    }
    .flex-row {
      display: flex;
      gap: 10px;
      align-items: center;
    }
    .flex-row > select {
      flex: 1;
    }
    .flex-row > button {
      flex-shrink: 0;
      width: auto;
      padding: 10px 16px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Your Companies</h2>

    <div class="flex-row">
      <select id="activeCompanySelect" aria-label="Select active company"></select>
      <button id="switchBtn">Switch Company</button>
    </div>

    <h3>Add Company</h3>
    <form id="addCompanyForm">
      <label for="name">Company Name</label>
      <input type="text" id="name" name="name" placeholder="Company Name" required>

      <label for="address">Address</label>
      <input type="text" id="address" name="address" placeholder="Address" required>

      <label for="industry">Industry</label>
      <input type="text" id="industry" name="industry" placeholder="Industry" required>

      <button type="submit">Add Company</button>
    </form>

    <h3>Company List</h3>
    <ul id="companyList"></ul>

    <p id="result"></p>
  </div>

  <script>
    const token = localStorage.getItem('token');
    if (!token) {
      alert('Please login first');
      window.location.href = '/login-page';
    }

    async function fetchCompanies() {
      const res = await fetch('/api/companies', {
        headers: { 'Authorization': 'Bearer ' + token }
      });
      const companies = await res.json();
      const list = document.getElementById('companyList');
      const select = document.getElementById('activeCompanySelect');
      list.innerHTML = '';
      select.innerHTML = '';
      companies.forEach(company => {
        let li = document.createElement('li');
        li.textContent = `${company.name} — ${company.address} (${company.industry})`;
        list.appendChild(li);

        let option = document.createElement('option');
        option.value = company.id;
        option.textContent = company.name;
        select.appendChild(option);
      });
    }

    document.getElementById('addCompanyForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = {
        name: this.name.value,
        address: this.address.value,
        industry: this.industry.value
      };
      const res = await fetch('/api/companies', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify(formData)
      });
      const data = await res.json();
      const resultP = document.getElementById('result');
      if (res.ok) {
        resultP.style.color = 'green';
        resultP.textContent = 'Company added successfully!';
        fetchCompanies();
      } else {
        resultP.style.color = 'red';
        resultP.textContent = data.message || 'Error adding company';
      }
    });

    document.getElementById('switchBtn').addEventListener('click', async () => {
      const companyId = document.getElementById('activeCompanySelect').value;
      const res = await fetch('/api/active-company', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify({ company_id: companyId })
      });
      const data = await res.json();
      if (res.ok) {
        alert('Active company switched!');
      } else {
        alert(data.message || 'Error switching company');
      }
    });

    fetchCompanies();
  </script>
</body>
</html>
