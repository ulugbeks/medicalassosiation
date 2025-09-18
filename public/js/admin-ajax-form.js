/**
 * Universal AJAX Form Handler for Admin Panel
 * Provides automatic form submission, loading states, and user feedback
 */
class AdminAjaxForm {
    constructor(formSelector, options = {}) {
        this.form = document.querySelector(formSelector);
        if (!this.form) {
            console.warn(`Form with selector "${formSelector}" not found`);
            return;
        }
        
        this.options = {
            autoSave: options.autoSave || false,
            autoSaveInterval: options.autoSaveInterval || 30000, // 30 seconds
            enableKeyboardShortcuts: options.enableKeyboardShortcuts !== false,
            successCallback: options.successCallback || null,
            errorCallback: options.errorCallback || null,
            beforeSaveCallback: options.beforeSaveCallback || null,
            ...options
        };
        
        this.hasChanges = false;
        this.autoSaveInterval = null;
        this.isSubmitting = false;
        
        this.init();
    }
    
    init() {
        this.setupElements();
        this.setupEventListeners();
        
        if (this.options.autoSave) {
            this.setupAutoSave();
        }
        
        if (this.options.enableKeyboardShortcuts) {
            this.setupKeyboardShortcuts();
        }
    }
    
    setupElements() {
        // Get or create essential elements
        this.submitBtn = this.form.querySelector('[type="submit"]') || this.form.querySelector('.btn-primary');
        
        if (!this.submitBtn) {
            console.warn('Submit button not found in form');
            return;
        }
        
        // Store original button content
        this.originalBtnContent = this.submitBtn.innerHTML;
        
        // Create loading button if it doesn't exist
        this.loadingBtn = this.form.querySelector('.btn-loading');
        if (!this.loadingBtn) {
            this.loadingBtn = this.submitBtn.cloneNode(true);
            this.loadingBtn.classList.add('btn-loading', 'd-none');
            this.loadingBtn.disabled = true;
            this.loadingBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            this.submitBtn.parentNode.insertBefore(this.loadingBtn, this.submitBtn.nextSibling);
        }
        
        // Create or get alert containers
        this.setupAlerts();
    }
    
    setupAlerts() {
        const cardFooter = this.form.closest('.card')?.querySelector('.card-footer') || 
                          this.form.querySelector('.form-actions') ||
                          this.submitBtn.parentNode;
        
        // Success alert
        this.successAlert = cardFooter.querySelector('.alert-success');
        if (!this.successAlert) {
            this.successAlert = document.createElement('div');
            this.successAlert.className = 'alert alert-success d-none mt-2';
            this.successAlert.innerHTML = '<i class="fas fa-check-circle"></i> <span class="message">Saved successfully!</span>';
            cardFooter.appendChild(this.successAlert);
        }
        
        // Error alert
        this.errorAlert = cardFooter.querySelector('.alert-danger');
        if (!this.errorAlert) {
            this.errorAlert = document.createElement('div');
            this.errorAlert.className = 'alert alert-danger d-none mt-2';
            this.errorAlert.innerHTML = '<i class="fas fa-exclamation-triangle"></i> <span class="message">An error occurred.</span>';
            cardFooter.appendChild(this.errorAlert);
        }
    }
    
    setupEventListeners() {
        // Form submission
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.submitForm(false);
        });
        
        // Track changes
        this.form.addEventListener('input', () => {
            this.hasChanges = true;
        });
        
        this.form.addEventListener('change', () => {
            this.hasChanges = true;
        });
        
        // TinyMCE change tracking
        if (typeof tinymce !== 'undefined') {
            tinymce.on('AddEditor', (e) => {
                e.editor.on('change', () => {
                    this.hasChanges = true;
                });
            });
        }
    }
    
    setupAutoSave() {
        this.autoSaveInterval = setInterval(() => {
            if (this.hasChanges && !this.isSubmitting) {
                this.submitForm(true);
            }
        }, this.options.autoSaveInterval);
        
        // Clean up on page unload
        window.addEventListener('beforeunload', () => {
            if (this.autoSaveInterval) {
                clearInterval(this.autoSaveInterval);
            }
        });
    }
    
    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                this.submitForm(false);
            }
        });
    }
    
    async submitForm(isAutoSave = false) {
        if (this.isSubmitting) return;
        
        this.isSubmitting = true;
        
        try {
            // Call before save callback
            if (this.options.beforeSaveCallback) {
                const shouldContinue = await this.options.beforeSaveCallback(isAutoSave);
                if (shouldContinue === false) {
                    this.isSubmitting = false;
                    return;
                }
            }
            
            // Trigger TinyMCE save
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
            
            const formData = new FormData(this.form);
            
            // Show loading state for manual saves
            if (!isAutoSave) {
                this.showLoadingState();
            }
            
            this.hideAlerts();
            
            const response = await fetch(this.form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'Server error');
            }
            
            // Success handling
            this.hasChanges = false;
            
            if (!isAutoSave) {
                this.showSuccess(data.message || 'Saved successfully!');
                
                // Call success callback
                if (this.options.successCallback) {
                    this.options.successCallback(data, isAutoSave);
                }
            }
            
        } catch (error) {
            console.error('Save error:', error);
            
            if (!isAutoSave) {
                let errorMessage = 'An error occurred while saving.';
                
                if (error.message) {
                    errorMessage = error.message;
                }
                
                this.showError(errorMessage);
                
                // Call error callback
                if (this.options.errorCallback) {
                    this.options.errorCallback(error, isAutoSave);
                }
            }
        } finally {
            if (!isAutoSave) {
                this.hideLoadingState();
            }
            this.isSubmitting = false;
        }
    }
    
    showLoadingState() {
        this.submitBtn.classList.add('d-none');
        this.loadingBtn.classList.remove('d-none');
    }
    
    hideLoadingState() {
        this.submitBtn.classList.remove('d-none');
        this.loadingBtn.classList.add('d-none');
    }
    
    showSuccess(message) {
        this.successAlert.querySelector('.message').textContent = message;
        this.successAlert.classList.remove('d-none');
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            this.successAlert.classList.add('d-none');
        }, 3000);
    }
    
    showError(message) {
        this.errorAlert.querySelector('.message').textContent = message;
        this.errorAlert.classList.remove('d-none');
    }
    
    hideAlerts() {
        this.successAlert.classList.add('d-none');
        this.errorAlert.classList.add('d-none');
    }
    
    // Public methods
    resetForm() {
        this.form.reset();
        this.hasChanges = false;
        this.hideAlerts();
        
        // Clear TinyMCE editors
        if (typeof tinymce !== 'undefined') {
            tinymce.get().forEach(editor => {
                editor.setContent('');
            });
        }
    }
    
    destroy() {
        if (this.autoSaveInterval) {
            clearInterval(this.autoSaveInterval);
        }
    }
}

// Auto-initialize for forms with ajax-form class
document.addEventListener('DOMContentLoaded', function() {
    // Auto-initialize forms with data-ajax="true"
    document.querySelectorAll('form[data-ajax="true"]').forEach(form => {
        const autoSave = form.getAttribute('data-auto-save') === 'true';
        const autoSaveInterval = parseInt(form.getAttribute('data-auto-save-interval')) || 30000;
        
        new AdminAjaxForm(`#${form.id}`, {
            autoSave: autoSave,
            autoSaveInterval: autoSaveInterval
        });
    });
});

// Export for manual use
window.AdminAjaxForm = AdminAjaxForm;