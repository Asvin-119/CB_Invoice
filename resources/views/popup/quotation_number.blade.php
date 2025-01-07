<div class="modal fade" id="quoteNumberSettingsModal" tabindex="-1" aria-labelledby="quoteNumberSettingsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quoteNumberSettingsLabel">Configure Quote Number Preferences</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your quote numbers are set on auto-generate mode to save your time. Are you sure about changing this setting?</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="quoteNumberMode" id="autoGenerateMode" value="auto" checked>
                    <label class="form-check-label" for="autoGenerateMode">
                        Continue auto-generating quote numbers
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="quoteNumberMode" id="manualMode" value="manual">
                    <label class="form-check-label" for="manualMode">
                        Enter quote numbers manually
                    </label>
                </div>
                <div class="mt-3">
                    <label for="quotePrefix" class="form-label">Prefix</label>
                    <input type="text" class="form-control" id="quotePrefix" placeholder="AHG/QUO-" disabled>
                </div>
                <div class="mt-3">
                    <label for="nextNumber" class="form-label">Next Number</label>
                    <input type="number" class="form-control" id="nextNumber" placeholder="0000" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveQuoteSettings">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
