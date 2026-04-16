<script>
    const token = localStorage.getItem('token');
    
    // Global data
    let allMembersData = []; 
    let filteredMembersData = []; 
    let currentMemberPage = 1;
    const membersPerPage = 10; 

    let allApplicantsData = [];
    let filteredApplicantsData = [];
    let currentApplicantPage = 1;
    const applicantsPerPage = 10;

    let currentApplicantId = null;
    let currentSelectedType = 1;

    let membershipTypes = [
        { "id": 1, "name": "Micro", "price": "500.00", "duration_in_months": 12 },
        { "id": 2, "name": "Small Enterprises", "price": "5000.00", "duration_in_months": 12 }
    ];

    // --- OTP MODAL & NEW PASSWORD MODAL LOGIC ---
    function openOtpModal() {
        document.getElementById('otpModal').style.display = 'flex';
    }
    
    function hideOtpModal() {
        document.getElementById('otpModal').style.display = 'none';
        document.querySelectorAll('.otp-box').forEach(box => box.value = '');
    }
    
    function closeOtpOverlay(e) {
        if (e.target.id === 'otpModal') hideOtpModal();
    }
    
    function moveToNext(input, event) {
        if (input.value.length === 1) {
            let next = input.nextElementSibling;
            if (next && next.tagName.toLowerCase() === 'input') {
                next.focus();
            } else if (!next) {
                // It's the last box! Auto-transition to new password screen
                setTimeout(() => {
                    hideOtpModal();
                    openResetPasswordModal();
                }, 300);
            }
        }
    }
    
    document.querySelectorAll('.otp-box').forEach(box => {
        box.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value) {
                let prev = this.previousElementSibling;
                if (prev && prev.tagName.toLowerCase() === 'input') {
                    prev.focus();
                }
            }
        });
    });

    // --- RESET PASSWORD MODAL FUNCTIONS ---
    function openResetPasswordModal() {
        document.getElementById('resetPasswordModal').style.display = 'flex';
    }
    function hideResetPasswordModal() {
        document.getElementById('resetPasswordModal').style.display = 'none';
        document.getElementById('newPasswordInput').value = '';
        document.getElementById('rePasswordInput').value = '';
        validatePassword(); // Reset checklist
    }
    function closeResetPasswordOverlay(e) {
        if (e.target.id === 'resetPasswordModal') hideResetPasswordModal();
    }
    function togglePasswordView(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === "password" ? "text" : "password";
    }
    function validatePassword() {
        const pw = document.getElementById('newPasswordInput').value;
        const reqLower = document.getElementById('req-lower');
        const reqLen = document.getElementById('req-len');
        const reqUpper = document.getElementById('req-upper');
        const reqNum = document.getElementById('req-num');
        const submitBtn = document.getElementById('resetPwSubmitBtn');

        let validCount = 0;

        if(/[a-z]/.test(pw)) { reqLower.classList.add('valid'); validCount++; } else { reqLower.classList.remove('valid'); }
        if(pw.length >= 8) { reqLen.classList.add('valid'); validCount++; } else { reqLen.classList.remove('valid'); }
        if(/[A-Z]/.test(pw)) { reqUpper.classList.add('valid'); validCount++; } else { reqUpper.classList.remove('valid'); }
        if(/[0-9]/.test(pw)) { reqNum.classList.add('valid'); validCount++; } else { reqNum.classList.remove('valid'); }

        // Light up button if all 4 conditions met
        if(validCount === 4) {
            submitBtn.classList.add('active');
        } else {
            submitBtn.classList.remove('active');
        }
    }
    function submitNewPassword() {
        const pw1 = document.getElementById('newPasswordInput').value;
        const pw2 = document.getElementById('rePasswordInput').value;
        const btn = document.getElementById('resetPwSubmitBtn');

        if(!btn.classList.contains('active')) {
            alert("Please ensure your password meets all security requirements.");
            return;
        }
        if(pw1 !== pw2) {
            alert("Passwords do not match!");
            return;
        }

        alert("Password Successfully Reset!");
        hideResetPasswordModal();
    }

    // --- CROP PROFILE PICTURE MODAL LOGIC ---
    function openCropModal() {
        document.getElementById('cropModal').style.display = 'flex';
    }
    function hideCropModal() {
        document.getElementById('cropModal').style.display = 'none';
    }
    function closeCropOverlay(e) {
        if (e.target.id === 'cropModal') hideCropModal();
    }
    function setNewProfilePicture() {
        alert("Profile picture successfully updated!");
        hideCropModal();
    }

    // --- DROPDOWN MENUS LOGIC ---
    function toggleReportDropdown(e) {
        e.stopPropagation();
        const menu = document.getElementById('reportDropdownMenu');
        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
    function toggleTransDropdown(e) {
        e.stopPropagation();
        const menu = document.getElementById('transDropdownMenu');
        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
    function toggleTransFilter(e) {
        e.stopPropagation();
        const menu = document.getElementById('transFilterMenu');
        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
    }
    
    function downloadReport(type) {
        alert(`Initiating ${type.toUpperCase()} Report Download...`);
        document.getElementById('reportDropdownMenu').style.display = 'none';
    }
    
    function exportTransactions() {
        alert("Preparing transaction data for export...");
        document.getElementById('transDropdownMenu').style.display = 'none';
    }

    // --- TRANSACTIONS SEARCH & FILTER LOGIC ---
    let currentTransFilter = 'all'; 

    function filterTransactions(filterType) {
        currentTransFilter = filterType; 
        document.getElementById('transFilterMenu').style.display = 'none'; 
        applyTransactionFilters(); 
    }

    const transSearchInput = document.getElementById('transactionSearch');
    if (transSearchInput) {
        transSearchInput.addEventListener('input', applyTransactionFilters);
    }

    function applyTransactionFilters() {
        const searchTerm = document.getElementById('transactionSearch').value.toLowerCase();
        const tbody = document.getElementById('transactions-table-body');
        if(!tbody) return;
        const rows = tbody.getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            
            if (row.innerText.includes('Loading')) continue;

            const statusBadge = row.querySelector('.status-badge');
            const statusText = statusBadge ? statusBadge.innerText.toLowerCase() : '';
            const rowText = row.innerText.toLowerCase();

            const matchesFilter = (currentTransFilter === 'all' || statusText.includes(currentTransFilter));
            const matchesSearch = rowText.includes(searchTerm);

            if (matchesFilter && matchesSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }

    document.addEventListener('click', (e) => {
        const reportMenu = document.getElementById('reportDropdownMenu');
        if (reportMenu && reportMenu.style.display === 'flex' && !e.target.closest('#reportDropdownContainer')) {
            reportMenu.style.display = 'none';
        }
        
        const transMenu = document.getElementById('transDropdownMenu');
        if (transMenu && transMenu.style.display === 'flex' && !e.target.closest('#transMenuContainer')) {
            transMenu.style.display = 'none';
        }

        const filterMenu = document.getElementById('transFilterMenu');
        if (filterMenu && filterMenu.style.display === 'flex' && !e.target.closest('#transFilterContainer')) {
            filterMenu.style.display = 'none';
        }

        const p = document.getElementById('notificationPanel'); 
        if (p && p.style.display === 'flex' && !p.contains(e.target) && !e.target.closest('.fa-bell')) {
            p.style.display = 'none';
        }
    });

    // --- DARK MODE LOGIC ---
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const icon = document.getElementById('darkModeIcon');
        const text = document.getElementById('darkModeText');
        const switchBtn = document.getElementById('darkModeSwitch');
        
        if (document.body.classList.contains('dark-mode')) {
            if(icon) icon.classList.replace('fa-moon', 'fa-sun');
            if(text) text.innerText = 'Light Mode';
            if(switchBtn) switchBtn.checked = true;
            localStorage.setItem('theme', 'dark');
        } else {
            if(icon) icon.classList.replace('fa-sun', 'fa-moon');
            if(text) text.innerText = 'Dark Mode';
            if(switchBtn) switchBtn.checked = false;
            localStorage.setItem('theme', 'light');
        }
    }

    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        setTimeout(() => {
            const icon = document.getElementById('darkModeIcon');
            const text = document.getElementById('darkModeText');
            const switchBtn = document.getElementById('darkModeSwitch');
            if(icon) icon.classList.replace('fa-moon', 'fa-sun');
            if(text) text.innerText = 'Light Mode';
            if(switchBtn) switchBtn.checked = true;
        }, 50);
    }

    // --- SETTINGS VIEW SWITCHER ---
    function openSetting(id) {
        document.getElementById('settings-main').style.display = 'none';
        document.getElementById(id).style.display = 'block';
    }
    function closeSetting(id) {
        document.getElementById(id).style.display = 'none';
        document.getElementById('settings-main').style.display = 'block';
    }

    // --- NOTIFICATION SYSTEM ---
    function updateExpiringNotifications() {
        const today = new Date();
        let expiringCount = 0;
        let notifHTML = '';

        allMembersData.forEach(member => {
            const endDateString = member.membership_end_date || (member.created_at ? new Date(new Date(member.created_at).setFullYear(new Date(member.created_at).getFullYear() + 1)).toISOString() : null);
            
            if (endDateString) {
                const expDate = new Date(endDateString);
                const diffTime = expDate - today; 
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays <= 30) {
                    expiringCount++;
                    const name = member.applicant?.basic_profile?.registered_business_name || 'Unknown Business';
                    let statusText = '', iconClass = '';
                    
                    if (diffDays < 0) {
                        statusText = `<span class="text-danger fw-bold">Expired ${Math.abs(diffDays)} days ago</span>`;
                        iconClass = 'fa-times-circle text-danger';
                    } else if (diffDays === 0) {
                        statusText = `<span class="text-danger fw-bold">Expires TODAY</span>`;
                        iconClass = 'fa-exclamation-circle text-danger';
                    } else {
                        statusText = `<span class="text-warning fw-bold">Expires in ${diffDays} days</span>`;
                        iconClass = 'fa-exclamation-triangle text-warning';
                    }

                    notifHTML += `
                        <div class="notif-item" style="background: #f9fafb;">
                            <div class="notif-icon" style="background: white; border: 1px solid #ddd;"><i class="fa ${iconClass} fs-5"></i></div>
                            <div class="notif-text-content">
                                <p class="fw-bold mb-1 text-dark" style="font-size: 13px;">${name}</p>
                                <small>${statusText} (${expDate.toISOString().split('T')[0]})</small>
                            </div>
                        </div>
                    `;
                }
            }
        });

        const notifBody = document.querySelector('.notif-body');
        const notifBadge = document.querySelector('.notif-badge');
        const redDot = document.querySelector('.fa-bell').nextElementSibling;

        if (expiringCount > 0) {
            notifBody.innerHTML = notifHTML;
            notifBadge.innerText = `${expiringCount} New`;
            if (redDot) redDot.style.display = 'block'; 
        } else {
            notifBody.innerHTML = `
                <div class="notif-item" style="background: #f9fafb;">
                    <div class="notif-icon" style="background: white; border: 1px solid #ddd;"><i class="fa fa-check-circle text-success fs-5"></i></div>
                    <div class="notif-text-content"><p class="text-dark">No memberships are expiring soon.</p><small>You're all caught up!</small></div>
                </div>
            `;
            notifBadge.innerText = `0 New`;
            if (redDot) redDot.style.display = 'none'; 
        }
    }

    function checkAuth(res) {
        if (res.status === 401) {
            localStorage.removeItem('token');
            window.location.href = '/login';
            return false;
        }
        return true;
    }

    // Modals
    function openSimpleProof(url) {
        if (!url || url === '#' || url === 'null') { alert("No proof found."); return; }
        const img = document.getElementById('simpleModalImage');
        document.getElementById('simpleModalSpinner').style.display = 'block';
        img.style.display = 'none';
        img.src = url.startsWith('http') ? url : `https://pcci-laravel-api.onrender.com/${url.replace(/^\/+/, '')}`;
        document.getElementById('simpleProofModal').style.display = 'flex';
    }
    function onSimpleImageLoad() { document.getElementById('simpleModalImage').style.display = 'block'; document.getElementById('simpleModalSpinner').style.display = 'none'; }
    function hideSimpleProofModal() { document.getElementById('simpleProofModal').style.display = 'none'; }
    function closeSimpleProofModal(e) { if (e.target.id === 'simpleProofModal') hideSimpleProofModal(); }

    function openProof(url, applicantId) {
        if (!url || url === '#' || url === 'null') { alert("No proof found."); return; }
        currentApplicantId = applicantId; 
        const img = document.getElementById('modalImage');
        document.getElementById('modalSpinner').style.display = 'block';
        img.style.display = 'none';
        img.src = url.startsWith('http') ? url : `https://pcci-laravel-api.onrender.com/${url.replace(/^\/+/, '')}`;
        selectType(1); 
        document.getElementById('proofModal').style.display = 'flex';
    }
    function onImageLoad() { document.getElementById('modalImage').style.display = 'block'; document.getElementById('modalSpinner').style.display = 'none'; }
    function hideProofModal() { document.getElementById('proofModal').style.display = 'none'; }
    function closeProofModal(e) { if (e.target.id === 'proofModal') hideProofModal(); }

    function selectType(id) {
        currentSelectedType = id; 
        document.getElementById('toggleBtn1').className = (id == 1) ? 'type-toggle-btn active-1 flex-grow-1' : 'type-toggle-btn flex-grow-1';
        document.getElementById('toggleBtn2').className = (id == 2) ? 'type-toggle-btn active-2 flex-grow-1' : 'type-toggle-btn flex-grow-1';
    }

    async function confirmProcessing() {
        const data = membershipTypes.find(m => m.id == currentSelectedType);
        if (!data || !currentApplicantId) return;

        try {
            // Use local proxy route which forwards to remote API with admin token
            const response = await fetch(`/treasurer/process-payment/${currentApplicantId}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ membership_type_id: currentSelectedType })
            });

            if (response.ok || response.status === 200 || response.status === 201) {
                hideProofModal();

                const amtLbl = document.getElementById(`amount-label-${currentApplicantId}`);
                const typeLbl = document.getElementById(`type-label-${currentApplicantId}`);
                const bge = document.getElementById(`status-badge-${currentApplicantId}`);
                const actionBox = document.getElementById(`action-container-${currentApplicantId}`);

                if(amtLbl) { amtLbl.innerText = `₱ Processed`; amtLbl.className = "fw-bold text-dark"; }
                if(typeLbl) { typeLbl.innerText = "PAID"; typeLbl.className = "text-success fw-bold"; }
                if(bge) { bge.innerHTML = `<i class="fa fa-check-double me-1"></i> PAID`; bge.className = "badge bg-success text-white px-2 py-1 rounded-pill fw-bold shadow-sm"; }
                if(actionBox) { actionBox.innerHTML = `<button class="action-btn btn-gray" disabled style="width: 130px;"><i class="fa fa-check"></i> Processed</button>`; }

                fetchMembers();
                fetchTransactions();
                fetchRecentPayments();
                alert("Success: Payment Processed!");
            } else {
                const result = await response.json().catch(() => ({}));
                if (response.status === 401 || response.status === 403) {
                    alert("Access denied. Your account may not have permission to process payments. Please contact the administrator to grant treasurer access to the applicants endpoint.");
                } else if (response.status === 422 && result.errors) {
                    let errorMessages = "Validation Failed:\n\n";
                    for (let field in result.errors) {
                        errorMessages += `- ${field}: ${result.errors[field].join(', ')}\n`;
                    }
                    alert(errorMessages);
                } else {
                    alert(`Error: ${result.message || 'Something went wrong. Please try again.'}`);
                }
            }
        } catch (err) { alert("Network error: Could not reach the server."); }
    }

    function viewMemberDetails(memberId) {
        const member = allMembersData.find(m => m.id === memberId);
        if (!member) return;
        const profile = member.applicant?.basic_profile || {};
        
        document.getElementById('member-detail-content').innerHTML = `
            <div class="row g-3 text-start">
                <div class="col-12 border-bottom pb-2 mb-2"><label class="text-muted small fw-bold">BUSINESS NAME</label><h5 class="fw-bold text-dark">${profile.registered_business_name || 'N/A'}</h5></div>
                <div class="col-md-6"><label class="text-muted small fw-bold">TRADE NAME</label><p class="fw-bold text-dark">${profile.trade_name || 'N/A'}</p></div>
                <div class="col-md-6"><label class="text-muted small fw-bold">EMAIL</label><p class="fw-bold text-dark">${profile.email || 'N/A'}</p></div>
            </div>
        `;
        document.getElementById('memberDetailsModal').style.display = 'flex';
    }
    function hideMemberModal() { document.getElementById('memberDetailsModal').style.display = 'none'; }
    function closeMemberModal(e) { if (e.target.id === 'memberDetailsModal') hideMemberModal(); }

    // --- ADD PAYMENT MODAL LOGIC ---
    function openAddPaymentModal() { document.getElementById('addPaymentModal').style.display = 'flex'; }
    function hideAddPaymentModal() { document.getElementById('addPaymentModal').style.display = 'none'; }
    function closeAddPaymentOverlay(e) { if (e.target.id === 'addPaymentModal') hideAddPaymentModal(); }
    function clearPaymentForm() { alert("Form cleared!"); }
    function confirmPaymentAdd() { alert("Payment details confirmed!"); hideAddPaymentModal(); }

    document.addEventListener('DOMContentLoaded', () => {
        if (!token) { window.location.href = '/login'; return; }
        
        // Settings Name population
        const storedName = localStorage.getItem('userName') || 'Jesus Versula';
        document.getElementById('sidebarName').innerText = storedName;
        const nameInput = document.getElementById('settingsLastName');
        if (nameInput) {
             const parts = storedName.split(' ');
             if(parts.length > 1) {
                 document.getElementById('settingsFirstName').value = parts[0];
                 document.getElementById('settingsLastName').value = parts.slice(1).join(' ');
             }
        }
        
        fetchApplicants();
        fetchMembers();
        fetchRecentPayments();
        fetchTransactions();
        initCharts(); 

        document.getElementById('memberSearch').addEventListener('input', applyMemberFilters);
        document.getElementById('memberSort').addEventListener('change', applyMemberFilters);
        
        document.getElementById('applicantSearch').addEventListener('input', applyApplicantFilters);
        document.getElementById('applicantSort').addEventListener('change', applyApplicantFilters);

        // 🌟 THIS IS WHERE IT BELONGS: Check memory and switch tab immediately on load
        const savedTab = localStorage.getItem('activeTab') || 'dashboard';
        switchTab(savedTab);
    });

    // --- MEMBER FILTER/SORT ---
    function applyMemberFilters() {
        const term = document.getElementById('memberSearch').value.toLowerCase();
        const sortVal = document.getElementById('memberSort').value;

        filteredMembersData = allMembersData.filter(m => {
            const name = (m.applicant?.basic_profile?.registered_business_name || '').toLowerCase();
            return name.includes(term);
        });

        filteredMembersData.sort((a, b) => {
            const nameA = (a.applicant?.basic_profile?.registered_business_name || '').toLowerCase();
            const nameB = (b.applicant?.basic_profile?.registered_business_name || '').toLowerCase();
            const dateA = new Date(a.created_at || 0);
            const dateB = new Date(b.created_at || 0);

            if (sortVal === 'name_asc') return nameA.localeCompare(nameB);
            if (sortVal === 'name_desc') return nameB.localeCompare(nameA);
            if (sortVal === 'oldest') return dateA - dateB;
            return dateB - dateA;
        });

        currentMemberPage = 1; 
        displayMembersPage();
    }

    // --- APPLICANT FILTER/SORT ---
    function applyApplicantFilters() {
        const term = document.getElementById('applicantSearch').value.toLowerCase();
        const sortVal = document.getElementById('applicantSort').value;

        filteredApplicantsData = allApplicantsData.filter(a => {
            const name = (a.basic_profile?.registered_business_name || '').toLowerCase();
            return name.includes(term);
        });

        filteredApplicantsData.sort((a, b) => {
            const nameA = (a.basic_profile?.registered_business_name || '').toLowerCase();
            const nameB = (b.basic_profile?.registered_business_name || '').toLowerCase();
            const dateA = new Date(a.created_at || 0);
            const dateB = new Date(b.created_at || 0);

            if (sortVal === 'name_asc') return nameA.localeCompare(nameB);
            if (sortVal === 'name_desc') return nameB.localeCompare(nameA);
            if (sortVal === 'oldest') return dateA - dateB;
            return dateB - dateA;
        });

        currentApplicantPage = 1; 
        displayApplicantsPage();
    }


    // API Fetches
    async function fetchApplicants() {
        try {
            const [res1, res2] = await Promise.all([
                fetch(`${window.API_BASE_URL}/v1/applicants?status=approved`, { headers: { 'Authorization': `Bearer ${token}` } }),
                fetch(`${window.API_BASE_URL}/v1/applicants?status=paid`, { headers: { 'Authorization': `Bearer ${token}` } })
            ]);

            let combinedData = [];

            if (res1.ok) {
                const data1 = await res1.json();
                if (data1.data) combinedData = combinedData.concat(data1.data);
            }
            if (res2.ok) {
                const data2 = await res2.json();
                if (data2.data) combinedData = combinedData.concat(data2.data);
            }

            allApplicantsData = combinedData;

            const pendingCount = allApplicantsData.filter(a => String(a.status).toLowerCase() !== 'paid').length;
            document.getElementById('report-pending-count').innerText = pendingCount;
            document.getElementById('report-pending-count-badge').innerText = `${pendingCount} Pending`;

            applyApplicantFilters();
        } catch (err) {
            console.error('Error fetching applicants:', err);
        }
    }

    function displayApplicantsPage() {
        const totalPages = Math.ceil(filteredApplicantsData.length / applicantsPerPage) || 1;
        if (currentApplicantPage > totalPages) currentApplicantPage = totalPages;
        if (currentApplicantPage < 1) currentApplicantPage = 1;
        
        const pageData = filteredApplicantsData.slice((currentApplicantPage - 1) * applicantsPerPage, currentApplicantPage * applicantsPerPage);
        
        const tbody = document.getElementById('applicants-table-body');
        tbody.innerHTML = '';
        
        if(pageData.length === 0) {
            tbody.innerHTML = `<tr><td colspan="8" class="text-center py-5 text-muted fw-bold">No applicants found.</td></tr>`;
        }

        pageData.forEach(app => {
            const profile = app.basic_profile || {};
            const isPaid = String(app.status).toLowerCase() === 'paid';
            
            let typeLabelHTML = isPaid ? `<span id="type-label-${app.id}" class="text-success fw-bold">PAID</span>` : `<span id="type-label-${app.id}" class="text-danger fw-bold">PENDING</span>`;
            let statusBadge = isPaid ? `<span id="status-badge-${app.id}" class="badge bg-success text-white px-2 py-1 rounded-pill fw-bold shadow-sm" style="font-size:10px;"><i class="fa fa-check-double me-1"></i> PAID</span>` : `<span id="status-badge-${app.id}" class="badge bg-warning text-dark px-2 py-1 rounded-pill fw-bold" style="font-size:10px;">APPROVED</span>`;
            let amountText = isPaid ? '₱ Processed' : '---';
            
            let actionButton = isPaid 
                ? `<button class="action-btn btn-gray" disabled style="width: 130px;"><i class="fa fa-check"></i> Processed</button>`
                : `<button onclick="openProof('${app.proof_of_payment_url}', ${app.id})" class="action-btn btn-green" style="width: 130px;"><i class="fa fa-image me-1"></i> Process Payment</button>`;

            tbody.insertAdjacentHTML('beforeend', `
                <tr id="applicant-row-${app.id}">
                    <td class="fw-bold text-dark">${profile.registered_business_name || 'N/A'}</td>
                    <td class="text-dark">${profile.trade_name || 'N/A'}</td>
                    <td class="text-dark">${profile.email || 'N/A'}</td>
                    <td class="text-dark">${app.date_submitted || 'N/A'}</td>
                    <td>${typeLabelHTML}</td>
                    <td><span id="amount-label-${app.id}" class="fw-bold text-dark">${amountText}</span></td>
                    <td>${statusBadge}</td>
                    <td id="action-container-${app.id}">${actionButton}</td>
                </tr>
            `);
        });
        document.getElementById('applicant-pagination-text').innerText = `Page ${currentApplicantPage} of ${totalPages}`;
    }

    function prevApplicantPage() { if (currentApplicantPage > 1) { currentApplicantPage--; displayApplicantsPage(); } }
    function nextApplicantPage() { if (currentApplicantPage < Math.ceil(filteredApplicantsData.length / applicantsPerPage)) { currentApplicantPage++; displayApplicantsPage(); } }


    // 🌟 HERE IS THE MEMBER FETCH YOU ASKED FOR
    async function fetchMembers() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/members', { headers: { 'Authorization': `Bearer ${token}` } });
            if (!checkAuth(response)) return;
            const data = await response.json();
            if (response.ok && data.data) {
                allMembersData = data.data; 
                
                const totalMembersBadge = document.getElementById('total-members-badge');
                if (totalMembersBadge) totalMembersBadge.innerText = `${allMembersData.length} Active`;
                
                const reportActive = document.getElementById('report-active-members');
                if (reportActive) reportActive.innerText = allMembersData.length;
                
                applyMemberFilters(); 
                updateExpiringNotifications();
            }
        } catch (err) {
            console.error("Failed to fetch members:", err);
            const tbody = document.getElementById('members-table-body');
            if(tbody) tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-danger fw-bold">Network error. Failed to load data.</td></tr>`;
        }
    }

    function displayMembersPage() {
        const totalPages = Math.ceil(filteredMembersData.length / membersPerPage) || 1;
        if (currentMemberPage > totalPages) currentMemberPage = totalPages;
        if (currentMemberPage < 1) currentMemberPage = 1;
        
        const pageData = filteredMembersData.slice((currentMemberPage - 1) * membersPerPage, currentMemberPage * membersPerPage);
        
        const tbody = document.getElementById('members-table-body');
        tbody.innerHTML = '';
        
        if(pageData.length === 0) {
            tbody.innerHTML = `<tr><td colspan="9" class="text-center py-5 text-muted fw-bold">No members found matching your search.</td></tr>`;
        }

        pageData.forEach(member => {
            const name = member.applicant?.basic_profile?.registered_business_name || 'N/A';
            const orNumber = `OR-${10000 + member.id}`; 
            
            const regDate = member.created_at ? member.created_at.split('T')[0] : 'N/A';
            let expDate = member.membership_end_date ? member.membership_end_date.split('T')[0] : 'N/A';
            if(expDate === 'N/A' && member.created_at) {
                 const dateObj = new Date(member.created_at);
                 dateObj.setFullYear(dateObj.getFullYear() + 1);
                 expDate = dateObj.toISOString().split('T')[0];
            }

            tbody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td class="fw-bold text-dark">${name}</td>
                    <td>Annual</td>
                    <td class="fw-bold text-dark">₱5,000</td>
                    <td class="text-dark">${orNumber}</td>
                    <td class="text-dark">${regDate}</td>
                    <td class="text-dark">${expDate}</td>
                    <td><span class="status-badge status-completed">Active</span></td>
                    <td><button class="btn btn-sm btn-link p-0 fw-bold" onclick="openSimpleProof('${member.proof_of_payment_url}')">View File</button></td>
                    <td><button class="action-btn btn-gray" onclick="viewMemberDetails(${member.id})">Details</button></td>
                </tr>
            `);
        });
        document.getElementById('member-pagination-text').innerText = `Page ${currentMemberPage} of ${totalPages}`;
    }

    function prevMemberPage() { if (currentMemberPage > 1) { currentMemberPage--; displayMembersPage(); } }
    function nextMemberPage() { if (currentMemberPage < Math.ceil(filteredMembersData.length / membersPerPage)) { currentMemberPage++; displayMembersPage(); } }

    async function fetchRecentPayments() {
        try {
            const response = await fetch('https://pcci-laravel-api.onrender.com/api/v1/applicants?status=approved', { headers: { 'Authorization': `Bearer ${token}` } });
            if (!checkAuth(response)) return;
            const data = await response.json();
            if (response.ok && data.data) {
                const tbody = document.getElementById('recent-payments-table-body');
                tbody.innerHTML = ''; 
                data.data.forEach(app => {
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td class="fw-bold text-dark">${app.basic_profile?.registered_business_name || 'N/A'}</td>
                            <td>Annual</td>
                            <td class="fw-bold text-dark">₱5,000</td>
                            <td class="text-dark">Pending</td>
                            <td class="text-dark">${app.date_approved || 'N/A'}</td>
                            <td><button class="btn btn-sm btn-link p-0 fw-bold" onclick="openSimpleProof('${app.proof_of_payment_url}')">View File</button></td>
                            <td><button class="action-btn btn-green" onclick="openProof('${app.proof_of_payment_url}', ${app.id})">Process</button></td>
                        </tr>
                    `);
                });
            }
        } catch (err) {}
    }

    // 👉 REALISTIC DUMMY DATA INJECTION FOR TRANSACTIONS
    async function fetchTransactions() {
        try {
            const todayStr = new Date().toISOString().split('T')[0];
            const yesterdayObj = new Date();
            yesterdayObj.setDate(yesterdayObj.getDate() - 1);
            const yesterdayStr = yesterdayObj.toISOString().split('T')[0];

            const data = {
                data: [
                    { applicant: { basic_profile: { registered_business_name: "Tech Innovators Corp" } }, amount: "5000.00", status: "paid", created_at: todayStr, or_number: "OR-10234" },
                    { applicant: { basic_profile: { registered_business_name: "Valenzuela Merchandising" } }, amount: "500.00", status: "completed", created_at: todayStr, or_number: "OR-10233" },
                    { applicant: { basic_profile: { registered_business_name: "Santos Family Bakery" } }, amount: "500.00", status: "pending", created_at: yesterdayStr, or_number: "---" },
                    { applicant: { basic_profile: { registered_business_name: "Metro Manila Logistics" } }, amount: "5000.00", status: "failed", created_at: yesterdayStr, or_number: "---" },
                    { applicant: { basic_profile: { registered_business_name: "Global Export Partners" } }, amount: "5000.00", status: "paid", created_at: "2023-10-15", or_number: "OR-10220" },
                    { applicant: { basic_profile: { registered_business_name: "City Cafe & Resto" } }, amount: "500.00", status: "completed", created_at: "2023-10-14", or_number: "OR-10219" }
                ]
            };

            const tbodyTrans = document.getElementById('transactions-table-body');
            if(tbodyTrans) tbodyTrans.innerHTML = '';
            
            let total = 0, pending = 0, complete = 0, failed = 0;
            let todayTotal = 0, yesterdayTotal = 0;

            if (data.data) {
                data.data.forEach(txn => {
                    const amt = parseFloat(txn.amount) || 0;
                    const status = String(txn.status || 'completed').toLowerCase();
                    const txnDate = txn.created_at ? txn.created_at.split('T')[0] : '';
                    
                    total += amt;
                    if (status === 'completed' || status === 'paid') {
                        complete += amt;
                        if (txnDate === todayStr) {
                            todayTotal += amt;
                        } else if (txnDate === yesterdayStr) {
                            yesterdayTotal += amt;
                        }
                    }
                    else if (status === 'failed') failed += amt;
                    else pending += amt;

                    let statClass = status === 'pending' ? 'status-pending' : (status === 'failed' ? 'status-failed' : 'status-completed');
                    let membershipText = amt > 1000 ? 'Small Enterprise' : 'Micro';

                    if(tbodyTrans) {
                        tbodyTrans.insertAdjacentHTML('beforeend', `
                            <tr>
                                <td class="fw-bold text-dark ps-4">${txn.applicant?.basic_profile?.registered_business_name || 'Unknown'}</td>
                                <td class="text-dark">Gcash</td>
                                <td class="text-dark">${txnDate || 'N/A'}</td>
                                <td class="text-dark">${membershipText}</td>
                                <td class="text-dark">${txn.or_number || '---'}</td>
                                <td class="text-center"><span class="status-badge ${statClass}">${status.toUpperCase()}</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-light border shadow-sm action-icon-btn" style="color: #3b82f6;"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-light border shadow-sm action-icon-btn" style="color: #ef4444; margin-left: 4px;"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        `);
                    }
                });
            }
            
            const fmt = val => `₱${val.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            
            document.getElementById('trans-total-amt').innerText = fmt(total);
            document.getElementById('trans-pending-amt').innerText = fmt(pending);
            document.getElementById('trans-complete-amt').innerText = fmt(complete);
            document.getElementById('trans-failed-amt').innerText = fmt(failed);

            const todayEl = document.getElementById('today-payments-amt');
            const yesterdayEl = document.getElementById('yesterday-payments-amt');
            if (todayEl) todayEl.innerText = fmt(todayTotal);
            if (yesterdayEl) yesterdayEl.innerText = fmt(yesterdayTotal);

        } catch (err) {}
    }

    // --- CHARTS (DASHBOARD & REPORTS) ---
    function initCharts() {
        const ctxBar = document.getElementById('barChart');
        if(ctxBar) new Chart(ctxBar, { type: 'bar', data: { labels: ['21', '22', '23', '24'], datasets: [{ data: [120, 150, 180, 205], backgroundColor: '#3b82f6' }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } } });

        const reportBar = document.getElementById('reportBarChart');
        if(reportBar) {
            new Chart(reportBar.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [
                        { label: 'Micro', data: [120, 150, 180, 90, 110, 140], backgroundColor: '#3b82f6', barPercentage: 0.6, categoryPercentage: 0.8 },
                        { label: 'Small', data: [200, 220, 250, 180, 210, 260], backgroundColor: '#ef4444', barPercentage: 0.6, categoryPercentage: 0.8 },
                        { label: 'Medium', data: [90, 110, 130, 80, 95, 120], backgroundColor: '#eab308', barPercentage: 0.6, categoryPercentage: 0.8 },
                        { label: 'Large', data: [50, 60, 70, 40, 55, 65], backgroundColor: '#22c55e', barPercentage: 0.6, categoryPercentage: 0.8 }
                    ]
                },
                options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8, font: {size: 11} } } }, scales: { y: { grid: { color: '#eee', borderDash: [5, 5] }, ticks: { color: '#aaa', font: {size: 11} }, border: {display: false} }, x: { grid: { display: false }, ticks: { color: '#aaa', font: {size: 11} }, border: {display: false} } } }
            });
        }

        const reportPie = document.getElementById('reportPieChart');
        if(reportPie) {
            new Chart(reportPie.getContext('2d'), { type: 'pie', data: { labels: ['Annual', 'Monthly'], datasets: [{ data: [75, 25], backgroundColor: ['#6366f1', '#f97316'], borderWidth: 0 }] }, options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, font: {size: 11} } } } } });
        }
    }

    // Mobile Sidebar Toggle
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            sidebar.classList.toggle('active');
        }
    }

    // Close sidebar when clicking on a menu item (mobile)
    document.querySelectorAll('.sidebar-menu li').forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                document.querySelector('.sidebar').classList.remove('active');
            }
        });
    });

    // UI Tab Switcher
    function switchTab(tabName) {
        localStorage.setItem('activeTab', tabName); // 🌟 NEW: Saves the current tab
        
        document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
        document.querySelectorAll('.sidebar-menu li').forEach(li => li.classList.remove('active'));
        document.getElementById('section-' + tabName).style.display = 'block';
        document.getElementById('nav-' + tabName).classList.add('active');
        
        if(tabName !== 'settings') {
            const mainSet = document.getElementById('settings-main');
            if(mainSet) mainSet.style.display = 'block';
            const accSet = document.getElementById('settings-account');
            if(accSet) accSet.style.display = 'none';
            const secSet = document.getElementById('settings-security');
            if(secSet) secSet.style.display = 'none';
            const prefSet = document.getElementById('settings-preferences');
            if(prefSet) prefSet.style.display = 'none';
        }
    }
    
    function toggleNotificationPanel(e) { e.stopPropagation(); const p = document.getElementById('notificationPanel'); p.style.display = p.style.display === 'flex' ? 'none' : 'flex'; }
    function clearNotifications(e) { e.stopPropagation(); document.getElementById('notificationPanel').style.display = 'none'; }
    function logout() { localStorage.removeItem('token'); window.location.href = '/login'; }
</script>
