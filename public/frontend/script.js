
let token = '';

document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const res = await fetch('http://127.0.0.1:8000/api/register', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            name: document.getElementById('regName').value,
            email: document.getElementById('regEmail').value,
            password: document.getElementById('regPassword').value,
            password_confirmation: document.getElementById('regPasswordConfirm').value
        })
    });
    const data = await res.json();
    alert(JSON.stringify(data));
});

document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const res = await fetch('http://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            email: document.getElementById('loginEmail').value,
            password: document.getElementById('loginPassword').value
        })
    });
    const data = await res.json();
    if (data.token) {
        token = data.token;
        alert('Login successful!');
        loadCompanies();
    } else {
        alert('Login failed');
    }
});

document.getElementById('companyForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const res = await fetch('http://127.0.0.1:8000/api/companies', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        },
        body: JSON.stringify({
            name: document.getElementById('companyName').value,
            address: document.getElementById('companyAddress').value,
            industry: document.getElementById('companyIndustry').value
        })
    });
    const data = await res.json();
    alert(JSON.stringify(data));
    loadCompanies();
});

async function loadCompanies() {
    const res = await fetch('http://127.0.0.1:8000/api/companies', {
        headers: { 'Authorization': 'Bearer ' + token }
    });
    const companies = await res.json();
    document.getElementById('companyList').innerHTML = '<pre>' + JSON.stringify(companies, null, 2) + '</pre>';
}
