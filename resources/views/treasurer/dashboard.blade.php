<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treasurer Dashboard - Approved Applicants</title>

    @include('partials.api-config')
    
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
            --success-green: #28a745;
        }

@section('title', 'Dashboard - PCCI')

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

        /* --- APPLICANT CARD --- */
        .applicant-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .card-header {
            background-color: rgba(40, 167, 69, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
        }

        .card-header h3 {
            margin: 0;
            color: var(--success-green);
            font-family: 'Poppins', sans-serif;
        }

        .status-badge {
            background-color: var(--success-green);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        .card-body {
            padding: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .info-section {
            background-color: var(--section-bg);
            padding: 20px;
            border-radius: 8px;
        }

        .info-section h4 {
            margin-top: 0; margin-bottom: 15px; color: #fff;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 8px; font-size: 1rem;
        }

        .data-row { margin-bottom: 10px; font-size: 0.9rem; display: flex; flex-direction: column; }
        .data-row strong { color: var(--text-grey); font-size: 0.8rem; margin-bottom: 2px; }
        .data-row span { color: white; }

        .loading, .error-msg { text-align: center; padding: 50px; color: var(--text-grey); font-size: 1.2rem; }
    </style>
</head>
<body>

    <nav class="topbar">
        <div class="brand">
            <img src="{{ asset('images/PCCI-Logo.svg') }}" style="height: 30px;" alt="Logo" onerror="this.style.display='none'">
            PCCI Treasurer
        </div>
        <button onclick="logout()" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </nav>

    <div class="container">
        <div style="margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px;">
            <h1 style="margin: 0; border: none; padding: 0;">Approved Applicants (Pending Payment)</h1>
            <p style="color: var(--text-grey); margin-top: 10px;">These businesses have been approved by the admin and require payment processing.</p>
        </div>

        <div id="applicants-list">
            <div class="loading">Loading approved applicants...</div>
        </div>
    </div>

    <div class="stats-container">
        {{-- Members Card --}}
        <div class="stat-card">
            <div class="title">Members</div>
            <div class="value">
                <i class="bi bi-person-fill"></i> <span>4</span>
            </div>
        </div>

        if (!token) {
            window.location.href = '/login';
        } else {
            fetchApplicants();
        }

        async function fetchApplicants() {
            const container = document.getElementById('applicants-list');

            try {
                // UPDATED: Using the exact endpoint for approved applicants
                const response = await fetch(`${window.API_BASE_URL}/v1/applicants?status=approved`, {
                    headers: { 'Authorization': `Bearer ${token}` }
                });

                if (response.status === 401) {
                    logout();
                    return;
                }

                const data = await response.json();

                if (response.ok && data.data) {
                    // No more frontend filtering needed! The API did the work.
                    renderApplicants(data.data);
                } else {
                    container.innerHTML = '<div class="error-msg">Failed to load applicants.</div>';
                }
            } catch (err) {
                console.error(err);
                container.innerHTML = '<div class="error-msg">Network error. Please try again later.</div>';
            }
        }

        async function processPayment(applicantId, membershipTypeId) {
            // Optional: Add a simple confirmation dialog
            if (!confirm('Are you sure you want to process the payment for this applicant?')) {
                return;
            }

            try {
                const response = await fetch(`${window.API_BASE_URL}/v1/payments`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify({
                        applicant_id: applicantId,
                        membership_type_id: membershipTypeId
                    })
                });

                const data = await response.json();

                if (response.ok && data.data) {
                    // Success alert showing the OR Number and Amount from your API response
                    alert(`Payment processed successfully!\n\nOR Number: ${data.data.or_number}\nAmount: ₱${data.data.amount}\nReceived By: ${data.data.received_by.name}`);
                    
                    // Refresh the list to remove the newly paid applicant
                    fetchApplicants();
                } else {
                    // Handle validation errors or server errors
                    alert(`Failed to process payment: ${data.message || 'Please check your inputs and try again.'}`);
                }
            } catch (err) {
                console.error(err);
                alert('A network error occurred. Please make sure the API server is running.');
            }
        }

        function renderApplicants(applicants) {
            const container = document.getElementById('applicants-list');
            container.innerHTML = '';

            if (applicants.length === 0) {
                container.innerHTML = '<div class="error-msg">No approved applicants pending payment at this time.</div>';
                return;
            }

            applicants.forEach(app => {
                const safe = (val) => val || 'N/A'; 
                const profile = app.basic_profile || {};
                
                // Ensure your API returns 'membership_type_id' in the applicant object. 
                // If it doesn't, you may need to map it or update your GET /applicants endpoint.
                const memTypeId = app.membership_type_id || 1; 

                const html = `
                    <div class="applicant-card">
                        <div class="card-header">
                            <div>
                                <h3>${safe(profile.registered_business_name)}</h3>
                                <small style="color:var(--text-grey)">ID: ${app.id} | Type: <strong>${safe(app.membership_type)}</strong></small>
                            </div>
                            <span class="status-badge">Approved</span>
                        </div>

                        <div class="card-body">
                            <div class="info-section">
                                <h4>Business Contact</h4>
                                <div class="data-row"><strong>Trade Name:</strong> <span>${safe(profile.trade_name)}</span></div>
                                <div class="data-row"><strong>Email:</strong> <span>${safe(profile.email)}</span></div>
                                <div class="data-row"><strong>Date Approved:</strong> <span>${safe(app.date_approved)}</span></div>
                            </div>
                        </div>
                        
                        <div style="background:rgba(0,0,0,0.2); padding:15px 25px; display: flex; justify-content: flex-end; border-top:1px solid var(--border-color);">
                            <button onclick="processPayment(${app.id}, ${memTypeId})" class="btn" style="background: #28a745; color: white; padding: 8px 15px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer; transition: 0.3s;">
                                Process Payment
                            </button>
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
