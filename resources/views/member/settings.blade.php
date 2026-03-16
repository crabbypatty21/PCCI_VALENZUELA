{{-- ========================================== --}}
{{-- SETTINGS TAB                               --}}
{{-- ========================================== --}}
<div id="section-settings" class="content-section" style="display: none;">
    <div class="titleBox"><i class="fa fa-gear"></i> Settings</div>
    
    <div class="custom-card">
        <h5 class="fw-bold mb-1">Account Options</h5>
        <p class="text-muted mb-4" style="font-size: 14px;">Manage your account, security and preferences</p>

        <div class="setting-box" onclick="alert('Account Settings')">
            <div class="setting-left"><i class="fa fa-user text-secondary"></i><span>Account</span></div>
            <i class="fa fa-chevron-right text-muted"></i>
        </div>
        <div class="setting-box" onclick="alert('Security Settings')">
            <div class="setting-left"><i class="fa fa-lock text-secondary"></i><span>Security</span></div>
            <i class="fa fa-chevron-right text-muted"></i>
        </div>
        <div class="setting-box" onclick="switchTab('membership')">
            <div class="setting-left"><i class="fa fa-credit-card text-secondary"></i><span>Membership and Billing</span></div>
            <i class="fa fa-chevron-right text-muted"></i>
        </div>
        <div class="setting-box" onclick="alert('Preferences')">
            <div class="setting-left"><i class="fa fa-sliders-h text-secondary"></i><span>Preferences</span></div>
            <i class="fa fa-chevron-right text-muted"></i>
        </div>

        <button class="logout-btn" onclick="logout()"><i class="fa fa-sign-out-alt me-2"></i> Log Out</button>
    </div>
</div>