{{-- DASHBOARD OVERVIEW TAB --}}
<div id="section-dashboard" class="content-section" style="display: block;">
    <div class="mb-4 pb-2">
        <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Welcome, <span id="dashWelcomeName">Jesus</span>!</h3>
        <p class="text-muted mb-0" style="font-size: 14px;">Here is your financial overview for today.</p>
    </div>

    {{-- SUMMARY CARDS --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="summary-card dash-card bg-red">
                <div class="label">Total Revenue</div>
                <div class="value">PHP 205,500</div>
                <i class="fa fa-wallet bg-icon"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card dash-card bg-green">
                <div class="label">Paid Members</div>
                <div class="value">Php. 205,500</div>
                <i class="fa fa-users bg-icon"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card dash-card bg-orange">
                <div class="label">Active Account</div>
                <div class="value">20</div>
                <i class="fa fa-user-check bg-icon"></i>
            </div>
        </div>
    </div>

    {{-- SMALL INFO CARD --}}
    <div class="floating-card small-info-card mb-4">
        <div class="icon-box"><i class="fa fa-calendar-check"></i></div>
        <div>
            <p>Today's Payments: <span id="today-payments-amt" class="text-success fs-6">₱0</span></p>
            <p>Yesterday payment: <span id="yesterday-payments-amt" class="text-muted fw-bold">₱0</span></p>
        </div>
    </div>

    {{-- MIDDLE SECTION: CHARTS --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="floating-card">
                <div class="card-title-row">
                    <h5>Membership Revenue</h5>
                    <select class="form-select form-select-sm" style="width: auto; font-size: 12px; cursor: pointer;">
                        <option>This Month</option>
                        <option>This Year</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="floating-card">
                <div class="card-title-row">
                    <h5>Payment Breakdown</h5>
                    <button class="btn btn-sm btn-outline-secondary" style="font-size: 12px; font-weight: bold;">View Report</button>
                </div>
                <div class="chart-container d-flex justify-content-center">
                    <canvas id="pieChart" style="max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- BOTTOM SECTION: RECENT PAYMENTS TABLE --}}
    <div class="floating-card table-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center">
                <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Recent Payments</h5>
            </div>
        </div>
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Business Name</th>
                        <th>Membership Type</th>
                        <th>Amount</th>
                        <th>OR Number</th>
                        <th>Date</th>
                        <th>Proof of Payment</th>
                    </tr>
                </thead>
                <tbody id="recent-payments-table-body">
                    <tr><td colspan="6" class="text-center py-4">Loading records...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
