document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        let isValid = true;

        // Validate Name
        const name = document.getElementById('name').value.trim();
        if (name === '') {
            alert('Name is required');
            isValid = false;
        }

        // Validate Email
        const email = document.getElementById('email').value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            alert('Email is required');
            isValid = false;
        } else if (!emailRegex.test(email)) {
            alert('Please enter a valid email address');
            isValid = false;
        }

        // Validate Password
        const password = document.getElementById('password').value;
        const passwordRegex = /^(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/; // Regex for password validation
        if (password === '') {
            alert('Password is required');
            isValid = false;
        } else if (!passwordRegex.test(password)) {
            alert('Password must be at least 6 characters long, include one uppercase letter, and one special character');
            isValid = false;
        }

        // Validate Confirm Password
        const confirmPassword = document.getElementById('confirm-password').value;
        if (confirmPassword === '') {
            alert('Confirm Password is required');
            isValid = false;
        } else if (confirmPassword !== password) {
            alert('Passwords do not match');
            isValid = false;
        }
        // Validate Country
        const country = document.getElementById('country').value;
        if (country === '') {
            alert('Country is required');
            isValid = false;
        }

        // Validate Gender
        const gender = document.querySelector('input[name="gender"]:checked');
        if (!gender) {
            alert('Gender is required');
            isValid = false;
        }

        // Validate Languages
        const languages = document.querySelectorAll('input[name="languages[]"]:checked');
        if (languages.length === 0) {
            alert('Please select at least one language');
            isValid = false;
        }

        if (isValid) {
            form.submit();
        }
    });
});
