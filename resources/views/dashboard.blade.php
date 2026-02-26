<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Applicants</title>
    
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-red: #be1e38;
            --dark-bg: #222431;
            --card-bg: #2b2d3c; 
            --section-bg: #323545;
            --text-grey: #a0aec0;
            --text-white: #ffffff;
            --border-color: #4a4d61;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-white);
        }

        /* --- TOPBAR --- */
        .topbar {
            background-color: var(--card-bg);
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .logout-btn {
            background: transparent;
            border: 1px solid var(--primary-red);
            color: var(--primary-red);
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .logout-btn:hover { background: var(--primary-red); color: white; }

        /* --- CONTAINER --- */
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 { margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; }

        /* --- APPLICANT CARD --- */
        .applicant-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        /* Card Header */
        .card-header {
            background-color: rgba(190, 30, 56, 0.1); /* Red tint */
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h3 {
            margin: 0;
            color: var(--primary-red);
            font-family: 'Poppins', sans-serif;
        }

        .status-badge {
            background-color: var(--primary-red);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Card Body */
        .card-body {
            padding: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        /* Sections inside Card */
        .info-section {
            background-color: var(--section-bg);
            padding: 20px;
            border-radius: 8px;
        }

        .info-section h4 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #fff;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px;
            font-size: 1rem;
        }

        .data-row {
            margin-bottom: 10px;
            font-size: 0.9rem;
            display: flex;
            flex-direction: column;
        }

        .data-row strong {
            color: var(--text-grey);
            font-size: 0.8rem;
            margin-bottom: 2px;
        }

        .data-row span {
            color: white;
        }

        .loading, .error-msg {
            text-align: center;
            padding: 50px;
            color: var(--text-grey);
            font-size: 1.2rem;
        }

        /* --- MODALS --- */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            width: 100%;
            max-width: 400px;
        }

        .modal-content h3 { margin-top: 0; color: var(--primary-red); font-family: 'Poppins', sans-serif; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: var(--text-grey); font-size: 0.9rem;}
        .form-group input {
            width: 100%; padding: 10px; border-radius: 6px;
            border: 1px solid var(--border-color);
            background: var(--dark-bg); color: white;
        }

        .btn {
            padding: 10px 15px; border-radius: 6px; border: none; cursor: pointer; font-weight: bold; font-family: 'DM Sans', sans-serif;
        }
        .btn-primary { background: var(--primary-red); color: white; width: 100%; transition: 0.3s; }
        .btn-primary:hover { opacity: 0.9; }
        .btn-secondary { background: var(--section-bg); color: white; margin-top: 10px; width: 100%; border: 1px solid var(--border-color); transition: 0.3s; }
        .btn-secondary:hover { background: var(--border-color); }

        .alert { padding: 10px; border-radius: 6px; margin-bottom: 15px; display: none; }
        .alert-error { background: rgba(255,0,0,0.1); color: #ff6b6b; border: 1px solid #ff6b6b; }
        .alert-warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid #ffc107; margin-top: 15px; font-size: 0.85rem;}

        .password-display {
            background: var(--dark-bg); padding: 15px; border-radius: 6px;
            font-family: monospace; font-size: 1.2rem; text-align: center;
            margin: 15px 0; border: 1px dashed var(--text-grey);
        }

    </style>
</head>
<body>

    <nav class="topbar">
        <div class="brand">
            <img src="{{ asset('images/PCCI-Logo.svg') }}" style="height: 30px;" alt="Logo">
            PCCI Admin
        </div>
        <button onclick="logout()" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </nav>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h1 style="margin: 0; border: none; padding: 0;">Membership Applicants</h1>
            <button class="btn btn-primary" style="width: auto;" onclick="openRegisterModal()">+ Register Treasurer</button>
        </div>

        <div id="applicants-list">
            <div class="loading">Loading applicants...</div>
        </div>
    </div>

    <div id="registerModal" class="modal-overlay">
        <div class="modal-content">
            <h3>Register New Treasurer</h3>
            <div id="registerError" class="alert alert-error"></div>
            <form id="registerForm" onsubmit="handleRegister(event)">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" id="regName" required placeholder="e.g. John Doe">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="regEmail" required placeholder="treasurer@example.com">
                </div>
                <button type="submit" id="regSubmitBtn" class="btn btn-primary">Register Account</button>
                <button type="button" class="btn btn-secondary" onclick="closeRegisterModal()">Cancel</button>
            </form>
        </div>
    </div>

    <div id="successModal" class="modal-overlay">
        <div class="modal-content">
            <h3>Treasurer Created!</h3>
            <p style="color: var(--text-grey); font-size: 0.9rem;">The account for <strong id="successEmail" style="color: white;"></strong> has been successfully registered.</p>
            
            <div class="alert-warning" style="display: block;">
                <strong>⚠️ IMPORTANT:</strong> Copy this password now. For security reasons, it will only be displayed once and cannot be recovered later.
            </div>

            <div class="password-display" id="generatedPassword"></div>
            
            <button class="btn btn-primary" onclick="copyPassword()" id="copyBtn">Copy Password</button>
            <button class="btn btn-secondary" onclick="closeSuccessModal()">I have copied the password (Close)</button>
        </div>
    </div>

    <script>
        const token = localStorage.getItem('token');

        // Redirect if no token
        if (!token) {
            window.location.href = '/login';
        } else {
            fetchApplicants();
        }

        async function fetchApplicants() {
            const container = document.getElementById('applicants-list');

            try {
                // Fetching data from the API endpoint provided in your sample
                const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants', {
                    headers: { 'Authorization': `Bearer ${token}` }
                });

                if (response.status === 401) {
                    logout(); // Token expired
                    return;
                }

                const data = await response.json();

                if (response.ok && data.data) {
                    renderApplicants(data.data);
                } else {
                    container.innerHTML = '<div class="error-msg">Failed to load applicants.</div>';
                }
            } catch (err) {
                console.error(err);
                container.innerHTML = '<div class="error-msg">Network error. Please try again later.</div>';
            }
        }

        function renderApplicants(applicants) {
            const container = document.getElementById('applicants-list');
            container.innerHTML = '';

            if (applicants.length === 0) {
                container.innerHTML = '<div class="error-msg">No applicants found.</div>';
                return;
            }

            // Mapping all fields from sample.html to HTML structure
            applicants.forEach(app => {
                const safe = (val) => val || 'N/A'; // Helper for null values
                
                // Deep access helpers
                const profile = app.basic_profile || {};
                const loc = profile.business_location || {};
                const rep = app.official_representative || {};
                const alt = app.alternate_representative || {};
                const org = app.organization_membership || {};
                const track = app.internal_tracking || {};

                const html = `
                    <div class="applicant-card">
                        <div class="card-header">
                            <div>
                                <h3>${safe(profile.registered_business_name)}</h3>
                                <small style="color:var(--text-grey)">ID: ${app.id} | Type: ${safe(app.membership_type)}</small>
                            </div>
                            <span class="status-badge">${safe(app.status)}</span>
                        </div>

                        <div class="card-body">
                            
                            <div class="info-section">
                                <h4>Business Profile</h4>
                                <div class="data-row"><strong>Trade Name:</strong> <span>${safe(profile.trade_name)}</span></div>
                                <div class="data-row"><strong>Email:</strong> <span>${safe(profile.email)}</span></div>
                                <div class="data-row"><strong>Telephone:</strong> <span>${safe(profile.telephone_no)}</span></div>
                                <div class="data-row"><strong>Website:</strong> <span>${safe(profile.website)}</span></div>
                                <div class="data-row"><strong>Date Submitted:</strong> <span>${safe(app.date_submitted)}</span></div>
                            </div>

                            <div class="info-section">
                                <h4>Location</h4>
                                <div class="data-row"><strong>Address:</strong> <span>${safe(loc.business_address)}</span></div>
                                <div class="data-row"><strong>City:</strong> <span>${safe(loc.city_municipality)}</span></div>
                                <div class="data-row"><strong>Province:</strong> <span>${safe(loc.province)}</span></div>
                                <div class="data-row"><strong>Region:</strong> <span>${safe(loc.region)}</span></div>
                                <div class="data-row"><strong>ZIP:</strong> <span>${safe(loc.zip_code)}</span></div>
                            </div>

                            <div class="info-section">
                                <h4>Representatives</h4>
                                <div class="data-row">
                                    <strong>Official Rep:</strong> 
                                    <span>${safe(rep.first_name)} ${safe(rep.surname)} (${safe(rep.designation)})</span>
                                    <small>${safe(rep.contact_no)} | DOB: ${safe(rep.dob)}</small>
                                </div>
                                <hr style="border-color:var(--border-color); opacity:0.3; margin:10px 0;">
                                <div class="data-row">
                                    <strong>Alternate Rep:</strong> 
                                    <span>${safe(alt.first_name)} ${safe(alt.surname)} (${safe(alt.designation)})</span>
                                    <small>${safe(alt.contact_no)} | DOB: ${safe(alt.dob)}</small>
                                </div>
                            </div>

                            <div class="info-section">
                                <h4>Organization Info</h4>
                                <div class="data-row"><strong>Type:</strong> <span>${safe(org.type_of_company)}</span></div>
                                <div class="data-row"><strong>Reg No:</strong> <span>${safe(org.registration_number)}</span></div>
                                <div class="data-row"><strong>Date Reg:</strong> <span>${safe(org.date_of_registration)}</span></div>
                                <div class="data-row"><strong>Employees:</strong> <span>${safe(org.number_of_employees)}</span></div>
                                <div class="data-row"><strong>Established:</strong> <span>${safe(org.year_established)}</span></div>
                            </div>

                        </div>
                        
                        <div style="background:rgba(0,0,0,0.2); padding:15px 25px; font-size:0.8rem; color:var(--text-grey); border-top:1px solid var(--border-color);">
                            Internal Recommendation: ${safe(track.recommending_approval)} | 
                            Created: ${safe(app.timestamps?.created_at)}
                        </div>
                    </div>
                `;

                container.insertAdjacentHTML('beforeend', html);
            });
        }

        function logout() {
            localStorage.removeItem('token');
            window.location.href = '/login';
        }

        // --- REGISTRATION MODAL LOGIC --- //
        function openRegisterModal() {
            document.getElementById('registerModal').style.display = 'flex';
            document.getElementById('registerError').style.display = 'none';
        }

        function closeRegisterModal() {
            document.getElementById('registerModal').style.display = 'none';
            document.getElementById('registerForm').reset();
        }

        async function handleRegister(e) {
            e.preventDefault();
            
            const btn = document.getElementById('regSubmitBtn');
            const errorDiv = document.getElementById('registerError');
            const name = document.getElementById('regName').value;
            const email = document.getElementById('regEmail').value;
            
            // UI Loading state
            btn.disabled = true;
            btn.innerText = 'Registering...';
            errorDiv.style.display = 'none';

            try {
                const response = await fetch('https://pcci-laravel-api.onrender.com/api/register', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        // Include the token so the API knows it's an admin doing this
                        'Authorization': `Bearer ${token}` 
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        role: 'treasurer'
                    })
                });

                const data = await response.json();

                // 202 is what your backend returns on success
                if (response.status === 202 || response.status === 201 || response.ok) {
                    closeRegisterModal();
                    showSuccessModal(data.user.email, data.password);
                } else {
                    // Handle Validation Errors (e.g. Email already exists)
                    errorDiv.innerText = data.message || 'Registration failed.';
                    if(data.errors) {
                       // Format Laravel validation errors
                       errorDiv.innerText += ' ' + Object.values(data.errors).flat().join(' ');
                    }
                    errorDiv.style.display = 'block';
                }
            } catch (err) {
                console.error(err);
                errorDiv.innerText = 'Network error. Please try again.';
                errorDiv.style.display = 'block';
            } finally {
                // Reset button state
                btn.disabled = false;
                btn.innerText = 'Register Account';
            }
        }

        // --- SUCCESS MODAL LOGIC (SHOW ONCE) --- //

        function showSuccessModal(email, password) {
            document.getElementById('successEmail').innerText = email;
            document.getElementById('generatedPassword').innerText = password;
            document.getElementById('successModal').style.display = 'flex';
            document.getElementById('copyBtn').innerText = 'Copy Password';
        }

        function closeSuccessModal() {
            document.getElementById('successModal').style.display = 'none';
            // SECURITY: Wipe the password from the DOM immediately upon closing
            document.getElementById('generatedPassword').innerText = ''; 
        }

        function copyPassword() {
            const pwd = document.getElementById('generatedPassword').innerText;
            navigator.clipboard.writeText(pwd).then(() => {
                document.getElementById('copyBtn').innerText = 'Copied to Clipboard!';
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

    </script>

</body>
</html>