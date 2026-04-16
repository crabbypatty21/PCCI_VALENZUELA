{{-- REPORTS TAB --}}
<div id="section-reports" class="content-section" style="display: none;">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif; font-size: 24px;">Reports</h3>
            <p class="text-muted mb-0" style="font-size: 14px;">Generate and review comprehensive financial analytics.</p>
        </div>
        
        <div class="position-relative d-inline-block" id="reportDropdownContainer">
            <button class="btn btn-success fw-bold rounded-pill px-4 py-2 shadow-sm d-flex align-items-center gap-2" onclick="toggleReportDropdown(event)" style="background: #22c55e; border: none; font-size: 14px;">
                <i class="fa fa-download"></i> Download Reports <i class="fa fa-ellipsis-v ms-1"></i>
            </button>
            <div class="report-dropdown-menu" id="reportDropdownMenu">
                <div class="report-dropdown-item" onclick="downloadReport('pdf')">
                    <i class="fa fa-file-pdf text-danger w-20px"></i> Download as PDF
                </div>
                <div class="report-dropdown-item" onclick="downloadReport('docx')">
                    <i class="fa fa-file-word text-primary w-20px"></i> Download as .DOCX
                </div>
            </div>
        </div>

    </div>

    <div class="reports-grid">
        <div class="report-stat-card">
            <div class="report-label">Monthly Revenue</div>
            <div class="report-value">₱24,500</div>
            <div class="report-indicator text-green"><i class="fa fa-arrow-up"></i> 8.2% <span class="text-muted fw-normal">vs last month</span></div>
        </div>
        <div class="report-stat-card">
            <div class="report-label">Total Active Members</div>
            <div class="report-value" id="report-active-members">0</div>
            <div class="report-indicator text-green"><i class="fa fa-arrow-up"></i> 12 <span class="text-muted fw-normal">new this week</span></div>
        </div>
        <div class="report-stat-card">
            <div class="report-label">Pending Verifications</div>
            <div class="report-value text-warning" id="report-pending-count">0</div>
            <div class="report-indicator text-muted fw-normal">Requires Treasurer action</div>
        </div>
        <div class="report-stat-card">
            <div class="report-label">Failed / Cancelled</div>
            <div class="report-value text-red">0</div>
            <div class="report-indicator text-green"><i class="fa fa-arrow-down"></i> 2.1% <span class="text-muted fw-normal">vs last month</span></div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="report-chart-box">
                <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Membership Revenue</h6>
                <div style="flex-grow: 1; position: relative;">
                    <canvas id="reportBarChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="report-chart-box">
                <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Payment Breakdown</h6>
                <div style="flex-grow: 1; position: relative; display:flex; justify-content:center;">
                    <canvas id="reportPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="report-chart-box h-100">
                <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Collection Status</h6>
                <div class="mini-card-container">
                    <div class="mini-stat-card">
                        <div class="m-val text-green">92%</div>
                        <div class="m-lbl">Collected</div>
                    </div>
                    <div class="mini-stat-card">
                        <div class="m-val text-red">8%</div>
                        <div class="m-lbl">Overdue</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="report-chart-box h-100" style="overflow-y: auto;">
                <h6 class="fw-bold mb-3 text-dark" style="font-size: 15px;">Business Type Distribution</h6>
                <table class="report-flat-table">
                    <tr><td>Retail & Merchandising</td><td class="text-end fw-bold">45%</td></tr>
                    <tr><td>Manufacturing</td><td class="text-end fw-bold">25%</td></tr>
                    <tr><td>Services & Consulting</td><td class="text-end fw-bold">20%</td></tr>
                    <tr><td>IT & Technology</td><td class="text-end fw-bold">10%</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
