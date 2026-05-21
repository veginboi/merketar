function pwdVisibility() {
  // Select all password input containers
  document.querySelectorAll('.pwd-input').forEach(container => {
    const toggleBtn = container.querySelector('.pwd-tgl');
    const input = container.querySelector('input[type="password"], input[type="text"]');
    const iconImg = toggleBtn?.querySelector('img');

    if (!toggleBtn || !input || !iconImg) return; // Skip if elements missing

    toggleBtn.addEventListener('click', function() {
      // Toggle input type
      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';

      // Toggle icon src
      const baseUrl = 'http://localhost/merketar.com-006/php-app/assets/icons/';
      iconImg.src = isPassword 
        ? baseUrl + 'outlined.svg'   
        : baseUrl + 'eye-slash-fill.svg';
    });
  });
}

pwdVisibility()