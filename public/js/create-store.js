// DOM Ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize character count
    const descTextarea = document.getElementById('storeDescription');
    updateCharCount();
    
    // Character counter for description
    descTextarea.addEventListener('input', updateCharCount);
    
    // File upload area click
    document.getElementById('fileUploadArea').addEventListener('click', function() {
        document.getElementById('storeBanner').click();
    });
    
    // File change handler
    document.getElementById('storeBanner').addEventListener('change', function(e) {
        if (e.target.files.length) {
            previewImage(e.target.files[0]);
        }
    });
    
    // Form submission - remove the automatic submission handler
    // Let the form submit normally, but we'll handle image resizing before submit
    
    function updateCharCount() {
        const count = descTextarea.value.length;
        document.getElementById('charCount').textContent = count;
    }
});

// Image preview function
function previewImage(file) {
    const preview = document.getElementById('bannerPreview');
    const previewContainer = document.getElementById('previewContainer');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            previewContainer.classList.remove('d-none');
            previewContainer.classList.add('d-block');
        };
        reader.readAsDataURL(file);
    }
}

// Remove image
function removeImage() {
    document.getElementById('storeBanner').value = '';
    document.getElementById('bannerPreview').src = '';
    document.getElementById('previewContainer').classList.remove('d-block');
    document.getElementById('previewContainer').classList.add('d-none');
    document.getElementById('resizedImage').value = '';
}

// Resize image before form submit
function resizeImageBeforeSubmit(event) {
    event.preventDefault(); // Prevent immediate form submission
    
    const fileInput = document.getElementById('storeBanner');
    const resizedInput = document.getElementById('resizedImage');
    const submitBtn = document.getElementById('submitBtn');
    
    // Show loading state
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Creating Store...';
    
    // If no file selected, submit form normally
    if (!fileInput.files.length) {
        document.getElementById('storeCreateForm').submit();
        return;
    }
    
    const file = fileInput.files[0];
    
    // Basic file type validation
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    if (!validTypes.includes(file.type)) {
        alert('Please upload a JPG, PNG, or WebP image');
        resetSubmitBtn(submitBtn, originalText);
        return;
    }
    
    // Basic file size validation (5MB)
    if (file.size > 5 * 1024 * 1024) {
        alert('File size must be less than 5MB');
        resetSubmitBtn(submitBtn, originalText);
        return;
    }
    
    // Resize the image
    resizeImage(file, 1200, 400, 0.8, function(resizedDataUrl) {
        // Store resized image in hidden input
        resizedInput.value = resizedDataUrl;
        
        // Clear the original file input to avoid sending large file
        fileInput.value = '';
        
        // Submit the form
        document.getElementById('storeCreateForm').submit();
    });
}

// Image resizing function
function resizeImage(file, maxWidth, maxHeight, quality, callback) {
    const reader = new FileReader();
    reader.onload = function(event) {
        const img = new Image();
        img.onload = function() {
            // Calculate new dimensions while maintaining aspect ratio
            let width = img.width;
            let height = img.height;
            
            if (width > maxWidth) {
                height = (height * maxWidth) / width;
                width = maxWidth;
            }
            
            if (height > maxHeight) {
                width = (width * maxHeight) / height;
                height = maxHeight;
            }
            
            // Create canvas and resize
            const canvas = document.createElement('canvas');
            canvas.width = width;
            canvas.height = height;
            
            const ctx = canvas.getContext('2d');
            
            // Set white background for transparent PNGs
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, width, height);
            
            // Draw image
            ctx.drawImage(img, 0, 0, width, height);
            
            // Convert to data URL with specified quality
            const dataUrl = canvas.toDataURL('image/jpeg', quality);
            callback(dataUrl);
        };
        img.src = event.target.result;
    };
    reader.readAsDataURL(file);
}

// Reset submit button
function resetSubmitBtn(btn, originalText) {
    btn.disabled = false;
    btn.innerHTML = originalText;
}