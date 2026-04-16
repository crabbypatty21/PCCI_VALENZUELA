{{-- ========================================== --}}
{{-- MY PRODUCTS TAB                            --}}
{{-- ========================================== --}}
<div id="section-products" class="content-section" style="display: none;">
    <div class="titleBox"><i class="fa fa-box-open"></i> My Products and Services</div>

    <div class="custom-card">
        <div class="tableTop">
            <input placeholder="Search products by name..." oninput="filterProducts(this.value)">
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

{{-- Add/Edit Product Modal --}}
<div id="addProductModal" class="modal-overlay">
    <div class="modal-content-box" style="max-width: 900px; max-height: 90vh; overflow-y: auto; padding: 0;">
        <div style="padding: 20px 25px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; background: #f9fafb;">
            <h5 class="fw-bold mb-0 text-dark"><i class="fa fa-box-open text-danger me-2"></i><span id="productModalTitle">Add New Product</span></h5>
            <button class="btn-close" onclick="closeProductModal()"></button>
        </div>

        <div style="padding: 25px;">
            <div id="productAlert" class="alert alert-danger" style="display:none; font-size:13px; padding: 10px;"></div>

            <input type="hidden" id="prodId">

            <div class="mb-3">
                <label class="text-muted fw-bold mb-1" style="font-size: 12px;">PRODUCT NAME <span class="text-danger">*</span></label>
                <input type="text" id="prodName" class="form-control" placeholder="e.g. Product or Service Name" style="font-size: 14px; background-color: #ffffff; color: #333; border: 1px solid #e5e7eb;">
            </div>

            <div class="mb-3">
                <label class="text-muted fw-bold mb-1" style="font-size: 12px;">SERVICE URL</label>
                <input type="text" id="prodUrl" class="form-control" placeholder="e.g. https://example.com/service" style="font-size: 14px; background-color: #ffffff; color: #333; border: 1px solid #e5e7eb;">
            </div>

            <div class="mb-3">
                <label class="text-muted fw-bold mb-1" style="font-size: 12px;">DESCRIPTION</label>
                <textarea id="prodDesc" class="form-control" rows="4" placeholder="Describe this product or service" style="font-size: 14px; background-color: #ffffff; color: #333; border: 1px solid #e5e7eb; resize: vertical;"></textarea>
            </div>

            <div class="mb-3" id="prodStatusWrap" style="display: none;">
                <label class="text-muted fw-bold mb-1" style="font-size: 12px;">STATUS</label>
                <select id="prodStatus" class="form-control" style="font-size: 14px; background-color: #ffffff; color: #333; border: 1px solid #e5e7eb;">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <button class="btn btn-light fw-bold px-4" style="border: 1px solid #e5e7eb;" onclick="closeProductModal()">Cancel</button>
                <button class="btn btn-danger fw-bold px-4" id="btnSaveProduct" onclick="saveProduct()">Save Product</button>
            </div>
        </div>
    </div>
</div>