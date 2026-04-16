{{-- TRANSACTIONS TAB --}}
<div id="section-transactions" class="content-section" style="display: none;">
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1" style="font-family: 'Poppins', sans-serif;">Transactions</h3>
        <p class="text-muted mb-0" style="font-size: 14px;">Manage and track all payment activities.</p>
    </div>

    <div class="reports-grid mb-4">
        <div class="report-stat-card">
            <div class="report-label">Total Payments</div>
            <div class="report-value" id="trans-total-amt">Php. 0</div>
            <div class="report-indicator text-green"><i class="fa fa-arrow-up"></i> + 20.3 % <span class="text-muted fw-normal">from last month</span></div>
        </div>
        <div class="report-stat-card">
            <div class="report-label">Pending Payments</div>
            <div class="report-value" id="trans-pending-amt">Php. 0</div>
        </div>
        <div class="report-stat-card">
            <div class="report-label">Complete Payments</div>
            <div class="report-value" id="trans-complete-amt">Php. 0</div>
        </div>
        <div class="report-stat-card">
            <div class="report-label">Failed Payment</div>
            <div class="report-value" id="trans-failed-amt">Php. 0</div>
        </div>
    </div>

    <div class="floating-card table-card" style="padding: 0; overflow: hidden; border-bottom: 6px solid #b61b2a;">
        
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <div>
                <h5 style="font-size: 18px; font-weight: bold; margin: 0; color: #111;">Transaction Records</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                
                <div class="position-relative" id="transFilterContainer" style="width: 280px;">
                    <i class="fa fa-search text-muted" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 13px;"></i>
                    
                    <input type="text" id="transactionSearch" placeholder="Search transactions..." style="width: 100%; height: 38px; padding-left: 35px; padding-right: 40px; border-radius: 8px; border: 1px solid #eee; font-size: 13px; outline: none; background: #f8f9fb;">
                    
                    <button class="btn btn-sm p-0 d-flex justify-content-center align-items-center text-muted" onclick="toggleTransFilter(event)" style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); width: 28px; height: 28px; border-radius: 6px;">
                        <i class="fa fa-sliders-h"></i>
                    </button>

                    <div class="report-dropdown-menu" id="transFilterMenu" style="width: 180px; right: 0; top: 100%; margin-top: 5px;">
                        <div class="report-dropdown-item text-dark" onclick="filterTransactions('all')">All Transactions</div>
                        <hr class="trans-filter-divider">
                        <div class="report-dropdown-item text-success" onclick="filterTransactions('completed')"><i class="fa fa-check-circle w-20px"></i> Completed</div>
                        <div class="report-dropdown-item text-warning" onclick="filterTransactions('pending')"><i class="fa fa-clock w-20px"></i> Pending</div>
                        <div class="report-dropdown-item text-danger" onclick="filterTransactions('failed')"><i class="fa fa-times-circle w-20px"></i> Failed</div>
                    </div>
                </div>
                
                <button class="btn btn-danger fw-bold shadow-sm d-flex align-items-center gap-2" style="height: 38px; border-radius: 8px; background: #dc2626; border: none; font-size: 13px; padding: 0 16px;" onclick="openAddPaymentModal()">
                    <i class="fa fa-plus"></i> Add Payment
                </button>
                
                <div class="position-relative" id="transMenuContainer">
                    <button class="btn btn-light border shadow-sm d-flex justify-content-center align-items-center" onclick="toggleTransDropdown(event)" style="height: 38px; width: 38px; border-radius: 8px;">
                        <i class="fa fa-ellipsis-v text-muted"></i>
                    </button>
                    <div class="report-dropdown-menu" id="transDropdownMenu" style="width: 160px;">
                        <div class="report-dropdown-item" onclick="exportTransactions()">
                            <i class="fa fa-file-export text-success w-20px"></i> Export
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="custom-table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Member Name</th>
                        <th>Payment Type</th>
                        <th>Date</th>
                        <th>Membership Type</th>
                        <th>OR Number</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="transactions-table-body">
                    <tr><td colspan="7" class="text-center py-5 text-muted"><i class="fa fa-spinner fa-spin fs-3 mb-2"></i><br>Loading transactions...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
