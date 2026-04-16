{{-- OVERLAY FOR MOBILE SIDEBAR --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="sidebar">
    <div class="sidebar-profile">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/ABC_Logo_2021.svg/1200px-ABC_Logo_2021.svg.png" id="sidebarImage" alt="Profile">
        <h5 id="sidebarCompany">Loading...</h5>
        <p id="sidebarName">Loading...</p>
        <small id="sidebarEmail">loading...</small>
    </div>

    <ul class="sidebar-menu text-start">
        <li class="active" id="nav-dashboard" onclick="switchTab('dashboard')"><i class="fa fa-chart-pie"></i> Dashboard</li>
        <li id="nav-business" onclick="switchTab('business')"><i class="fa fa-briefcase"></i> My Business</li>
        <li id="nav-products" onclick="switchTab('products')"><i class="fa fa-box-open"></i> My Products</li>
        <li id="nav-membership" onclick="switchTab('membership')"><i class="fa fa-id-badge"></i> Membership</li>
        <div class="sidebar-divider"></div>
        <li id="nav-settings" onclick="switchTab('settings')"><i class="fa fa-gear"></i> Settings</li>
    </ul>
</div>