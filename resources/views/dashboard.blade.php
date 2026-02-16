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
        <h1>Membership Applicants</h1>
        <div id="applicants-list">
            <div class="loading">Loading applicants...</div>
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
    </script>

</body>
</html>