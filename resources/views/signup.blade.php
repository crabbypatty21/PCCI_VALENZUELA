@extends('layouts.app')

@section('content')
<style>
    /* --- FONTS --- */
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;500;700&family=Poppins:wght@600;700;800&display=swap');

    body {
        background-color: #1a1c23; 
        color: #ffffff;
        font-family: 'DM Sans', sans-serif; 
    }

    h1, h2, h3, h4, h5, h6, .hero-title, .step-title {
        font-family: 'Poppins', sans-serif;
    }

    /* --- LAYOUT --- */
    .registration-container {
        min-height: 100vh;
        background: radial-gradient(circle at top right, #252836, #1a1c23);
        display: flex;
        align-items: center;
        padding-top: 80px;
        padding-bottom: 40px;
    }

    .glass-card {
        background: #252836;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 10px 10px 30px rgba(76, 203, 254, 0.2), 0 0 20px rgba(78, 89, 140, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
        min-height: 600px; 
    }

    /* --- FORM ELEMENTS --- */
    .form-label-custom {
        color: #ffffff;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
        font-family: 'DM Sans', sans-serif;
    }

    .text-danger {
        color: #e32636;
    }

    .form-control-dark, .form-select-dark {
        background-color: #1f222e !important;
        border: 1px solid #3a3f50 !important;
        color: white !important;
        border-radius: 8px;
        padding: 12px;
        font-family: 'DM Sans', sans-serif;
        width: 100%;
    }

    .form-control-dark:focus, .form-select-dark:focus {
        border-color: #4e598c !important;
        box-shadow: 0 0 0 0.25rem rgba(78, 89, 140, 0.25);
        outline: none;
    }

    .form-control-dark::placeholder {
        color: #8b92a5 !important;
        opacity: 1;
        font-weight: 400;
    }

    .form-control-dark[type="file"] {
        padding: 8px;
    }
    .form-control-dark[type="file"]::file-selector-button {
        background-color: #3a3f50;
        color: white;
        border: none;
        border-radius: 4px;
        margin-right: 10px;
        padding: 5px 10px;
        transition: 0.3s;
    }
    .form-control-dark[type="file"]::file-selector-button:hover {
        background-color: #4e598c;
    }

    .form-select-dark {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    /* --- PRICING CARDS --- */
    .pricing-card {
        background: transparent;
        border: 1px solid #6c757d;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        height: 100%;
        transition: 0.3s;
    }
    .pricing-card:hover {
        border-color: #ffffff;
    }
    .pricing-title {
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    .pricing-amount {
        font-family: 'Poppins', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        margin: 10px 0;
    }
    .pricing-divider {
        border-top: 1px solid #6c757d;
        margin: 15px 0;
    }
    .pricing-features {
        text-align: left;
        font-size: 0.85rem;
        list-style: none;
        padding-left: 0;
        color: #d1d5db;
    }
    .pricing-features li {
        margin-bottom: 5px;
        position: relative;
        padding-left: 15px;
    }
    .pricing-features li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: white;
    }

    /* --- PROGRESS BAR --- */
    .step-progress {
        height: 8px;
        border: 1px solid #adb5bd;
        background-color: #1f222c;
        border-radius: 4px;
        margin: 20px 0;
        overflow: hidden;
    }

    .step-progress-fill {
        width: 25%;
        height: 100%;
        background-color: #adb5bd;
        border-radius: 4px;
        transition: width 0.5s ease;
    }

    /* --- BUTTONS (UPDATED HOVER EFFECTS) --- */
    .btn-next {
        background-color: #b01f24;
        color: white;
        border: none;
        padding: 12px 40px;
        border-radius: 8px;
        font-size: 1rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        
        /* Smooth animation for color, transform and shadow */
        transition: all 0.3s ease; 
    }

    .btn-next:hover { 
        background-color: #e32636; 
        color: white; 
        transform: translateY(-2px); /* Lifts the button up */
        box-shadow: 0 8px 15px rgba(227, 38, 54, 0.3); /* Adds a red glow */
    }

    .btn-prev {
        background-color: #ffffff;
        color: #1a1c23;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-size: 1rem;
        font-family: 'DM Sans', sans-serif;
        font-weight: 700;
        margin-right: auto;
        
        /* Smooth animation */
        transition: all 0.3s ease;
    }

    .btn-prev:hover { 
        background-color: #f0f0f0; 
        transform: translateY(-2px); /* Lifts the button up */
        box-shadow: 0 5px 15px rgba(255, 255, 255, 0.15); /* Adds a white glow */
    }

    .btn-add-rep {
        background-color: #b01f24;
        color: white;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        transition: 0.3s;
    }
    .btn-add-rep:hover { background-color: #e32636; color: white; }

    .d-none { display: none !important; }
</style>

<div class="registration-container">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 pe-lg-5 mb-5 mb-lg-0">
                <p class="fw-bold mb-2" style="letter-spacing: 1px; font-family: 'Poppins', sans-serif;">Member Registration</p>
                <h1 class="hero-title mb-2" style="font-size: 3.5rem; font-weight: 800; line-height: 1.1;">Become a <span style="color: #e32636;">Member</span></h1>
                <p class="lead fw-bold" style="max-width: 1000px; color: #d6d6d6; padding-top: 0px;">
                    Join our vibrant community of business leaders and entrepreneurs. 
                    Complete your registration to unlock networking opportunities and business growth.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="glass-card">
                    
                    <form action="#" method="POST" id="registrationForm" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <i id="header-icon" class="bi bi-person fs-3 me-3"></i> 
                                <h3 id="header-title" class="mb-0 fw-bold step-title">Personal Information</h3>
                            </div>
                            <span id="step-counter" class="text-white">Step 1 of 4</span>
                        </div>
                        <p id="header-desc" class="text-white mb-3">Personal Tell us about yourself.</p>

                        <div class="step-progress">
                            <div class="step-progress-fill" id="progress-bar"></div>
                        </div>

                        <div id="step-1">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-dark" placeholder="Enter your first name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-dark" placeholder="Enter your last name" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-dark" placeholder="Enter your email address" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Contact Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-dark" placeholder="Enter your contact number" required>
                            </div>
                            <div class="data-notice mb-4" style="background-color: #1f222e; border: 2px solid #6a8aff; border-radius: 8px; padding: 15px;">
                                <div class="d-flex">
                                    <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                                    <div>
                                        <strong style="color: #6a8aff;">Data Usage Notice</strong><br>
                                        <span style="font-size: 0.85rem; color: #6a8aff;">The information you provide will be reviewed by our administrators and, upon approval, will be listed in our public member directory.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-next" onclick="validateAndNext(1, 2)">Next</button>
                            </div>
                        </div>

                        <div id="step-2" class="d-none">
                            <div class="mb-4">
                                <label class="form-label-custom">Business Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-dark" placeholder="Enter your business name" required>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Business Type <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-dark" required>
                                        <option selected disabled value="">Select business type</option>
                                        <option value="1">Corporation</option>
                                        <option value="2">Sole Proprietorship</option>
                                        <option value="3">Partnership</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Ownership Type <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-dark" required>
                                        <option selected disabled value="">Select ownership type</option>
                                        <option value="1">Private</option>
                                        <option value="2">Public</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Business Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-dark" placeholder="Enter your complete business address" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Business Website <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-dark" placeholder="https://yourwebsite.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Business Tagline/Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-dark" placeholder="Enter your business description" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-prev" onclick="goToStep(1)">Previous</button>
                                <button type="button" class="btn btn-next" onclick="validateAndNext(2, 3)">Next</button>
                            </div>
                        </div>

                        <div id="step-3" class="d-none">
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Full Name</label>
                                    <input type="text" class="form-control form-control-dark" placeholder="Representative’s name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Position</label>
                                    <input type="text" class="form-control form-control-dark" placeholder="Job title/position">
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Phone Number</label>
                                    <input type="text" class="form-control form-control-dark" placeholder="Contact number">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Email Address</label>
                                    <input type="email" class="form-control form-control-dark" placeholder="Email address">
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="button" class="btn-add-rep">+ Add Representative</button>
                            </div>
                            <div class="data-notice mb-4" style="background-color: rgba(63, 81, 181, 0.1); border: 1px solid #5c6bc0; border-radius: 8px; padding: 15px;">
                                <div class="d-flex">
                                    <i class="bi bi-info-circle me-2" style="color: #5c6bc0; margin-top: 2px;"></i>
                                    <div>
                                        <strong style="color: #7986cb;">Optional Step</strong><br>
                                        <span style="font-size: 0.85rem; color: #8c9eff;">
                                            You can skip this step if you don't have additional representatives to add.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-prev" onclick="goToStep(2)">Previous</button>
                                <button type="button" class="btn btn-next" onclick="goToStep(4)">Next</button>
                            </div>
                        </div>

                        <div id="step-4" class="d-none">
                            <div class="data-notice mb-4" style="background-color: rgba(63, 81, 181, 0.1); border: 1px solid #5c6bc0; border-radius: 8px; padding: 15px;">
                                <div class="d-flex">
                                    <i class="bi bi-info-circle me-2" style="color: #5c6bc0; margin-top: 2px;"></i>
                                    <div>
                                        <strong style="color: #7986cb;">Document Upload Notice</strong><br>
                                        <span style="font-size: 0.85rem; color: #8c9eff;">
                                            If you experience any issues uploading documents, you can still proceed with your registration. Documents can be submitted later via email.
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Business Logo <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-dark" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Mayor's Permit</label>
                                    <input type="file" class="form-control form-control-dark">
                                </div>
                            </div>
                            
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">DTI/SEC Registration <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-dark" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Secretary's Certificate <span class="small text-muted">(if representative)</span></label>
                                    <input type="file" class="form-control form-control-dark">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">Proof of Payment <span class="text-danger">*</span></label>
                                <input type="file" class="form-control form-control-dark" required>
                            </div>

                            <p class="form-label-custom mb-3">Membership Pricing:</p>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="pricing-card">
                                        <div class="pricing-title">Lifetime Subscription</div>
                                        <div class="pricing-divider"></div>
                                        <div class="pricing-amount">₱10,000</div>
                                        <div class="pricing-divider"></div>
                                        <ul class="pricing-features">
                                            <li>Advertisement on the landing page</li>
                                            <li>Inclusion in the business directory</li>
                                            <li>Company profile</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pricing-card">
                                        <div class="pricing-title">Yearly Subscription</div>
                                        <div class="pricing-divider"></div>
                                        <div class="pricing-amount">₱500</div>
                                        <div class="pricing-divider"></div>
                                        <ul class="pricing-features">
                                            <li>Inclusion in the business directory</li>
                                            <li>Company profile for 1 year</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-prev" onclick="goToStep(3)">Previous</button>
                                <button type="submit" class="btn btn-next">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function validateAndNext(currentStepId, nextStepId) {
        const currentStepContainer = document.getElementById('step-' + currentStepId);
        const requiredFields = currentStepContainer.querySelectorAll('[required]');
        
        let allValid = true;
        
        for (let field of requiredFields) {
            if (!field.checkValidity()) {
                field.reportValidity();
                allValid = false;
                break; 
            }
        }

        if (allValid) {
            goToStep(nextStepId);
        }
    }

    function goToStep(step) {
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const step3 = document.getElementById('step-3');
        const step4 = document.getElementById('step-4');
        const progressBar = document.getElementById('progress-bar');
        const stepCounter = document.getElementById('step-counter');
        const headerTitle = document.getElementById('header-title');
        const headerDesc = document.getElementById('header-desc');
        const headerIcon = document.getElementById('header-icon');

        step1.classList.add('d-none');
        step2.classList.add('d-none');
        step3.classList.add('d-none');
        step4.classList.add('d-none');

        if (step === 1) {
            step1.classList.remove('d-none');
            progressBar.style.width = '25%';
            stepCounter.innerText = 'Step 1 of 4';
            headerTitle.innerText = 'Personal Information';
            headerDesc.innerText = 'Personal Tell us about yourself.';
            headerIcon.className = 'bi bi-person fs-3 me-3';
        } 
        else if (step === 2) {
            step2.classList.remove('d-none');
            progressBar.style.width = '50%';
            stepCounter.innerText = 'Step 2 of 4';
            headerTitle.innerText = 'Business Information';
            headerDesc.innerText = 'Tell us about your business.';
            headerIcon.className = 'bi bi-building fs-3 me-3';
        }
        else if (step === 3) {
            step3.classList.remove('d-none');
            progressBar.style.width = '75%';
            stepCounter.innerText = 'Step 3 of 4';
            headerTitle.innerText = 'Additional Representatives';
            headerDesc.innerText = 'Add other business representatives (optional).';
            headerIcon.className = 'bi bi-person fs-3 me-3'; 
        }
        else if (step === 4) {
            step4.classList.remove('d-none');
            progressBar.style.width = '100%';
            stepCounter.innerText = 'Step 4 of 4';
            headerTitle.innerText = 'Document Upload';
            headerDesc.innerText = 'Upload required business documents.';
            headerIcon.className = 'bi bi-file-earmark-text fs-3 me-3'; 
        }
    }
</script>
@endsection