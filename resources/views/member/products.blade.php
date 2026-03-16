{{-- ========================================== --}}
{{-- MY PRODUCTS TAB                            --}}
{{-- ========================================== --}}
<div id="section-products" class="content-section" style="display: none;">
    <div class="titleBox"><i class="fa fa-box-open"></i> My Products and Services</div>

    <div class="custom-card">
        <div class="tableTop">
            <input placeholder="Search Products...">
            <button class="addBtn" onclick="openAddProductModal()"><i class="fa fa-plus me-1"></i> Add New</button>
        </div>

        <div class="table-responsive">
            <table class="custom-table mt-3">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 8px;">Product Name</th>
                        <th>Description</th>
                        <th>Service URL</th>
                        <th>Status</th>
                        <th style="border-top-right-radius: 8px;">Action</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    <tr><td colspan="5" class="text-center py-4 text-muted">Loading products...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Product Modal --}}
<div id="addProductModal" class="modal-overlay">
    <div class="modal-content-box">
        <h5 class="fw-bold text-danger mb-4 pb-3 border-bottom"><i class="fa fa-box-open me-2"></i>Add New Product</h5>
        <label class="text-muted small fw-bold mb-1">Product Name</label>
        <input type="text" class="form-control mb-3" placeholder="e.g. Welding Services" style="font-size: 14px;">
        <label class="text-muted small fw-bold mb-1">Description</label>
        <textarea class="form-control mb-4" rows="3" placeholder="Brief description..." style="font-size: 14px;"></textarea>
        <div class="d-flex justify-content-end gap-2">
            <button class="btn btn-light fw-bold px-4 rounded-pill" onclick="document.getElementById('addProductModal').style.display='none'">Cancel</button>
            <button class="btn btn-danger fw-bold px-4 rounded-pill">Save Product</button>
        </div>
    </div>
</div>