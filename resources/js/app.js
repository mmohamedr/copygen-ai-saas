import './bootstrap';
import * as bootstrap from 'bootstrap';
import "@hotwired/turbo";

// Initialize Lucide Icons dynamically on Turbo page swaps
document.addEventListener("turbo:load", function () {
    if (window.lucide) {
        window.lucide.createIcons();
    }
});
// Re-initialize icons explicitly when requested via UI logic
window.refreshIcons = function() {
    if (window.lucide) {
        window.lucide.createIcons();
    }
};

// Global toast initialization
window.showToast = function(message) {
    const toastHtml = `
    <div class="toast align-items-center text-white bg-dark border-0 mb-3 shadow-lg fade-in" role="alert" aria-live="assertive" aria-atomic="true" style="border-radius: 12px; min-width: 250px;">
        <div class="d-flex px-2 py-1">
            <div class="toast-body d-flex align-items-center fw-medium">
                <i data-lucide="check-circle-2" class="text-success me-2" style="width: 20px;"></i> ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>`;

    let toastContainer = document.getElementById('toast-container');
    if (!toastContainer) {
        toastContainer = document.createElement('div');
        toastContainer.id = 'toast-container';
        toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-4';
        document.body.appendChild(toastContainer);
    }

    toastContainer.insertAdjacentHTML('beforeend', toastHtml);
    window.refreshIcons(); // Parse icons in the new toast
    
    const toastEl = toastContainer.lastElementChild;
    const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', () => {
        toastEl.remove();
    });
};

// Global clipboard handler
window.copyToClipboard = function(text) {
    navigator.clipboard.writeText(text).then(() => {
        window.showToast('Successfully copied to clipboard');
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
};
