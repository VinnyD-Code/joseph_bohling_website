document.addEventListener("DOMContentLoaded", function() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.visibility = 'visible';
                if(entry.target.id === 'about') {
                    entry.target.style.animationName = 'slideInFromLeft';
                } else if(entry.target.id === 'services') {
                    entry.target.style.animationName = 'slideInFromRight';
                }
            }
        });
    }, observerOptions);

    observer.observe(document.querySelector('#about'));
    observer.observe(document.querySelector('#services'));
});

function togglePhoneNumber() {
    var phoneNumber = document.getElementById("phone-number");
    var phoneIcon = document.getElementById("phone-icon");

    if (phoneNumber.style.opacity === "1") {
        phoneNumber.style.opacity = "0";
        phoneNumber.style.transform = "scale(0.95)";
        phoneIcon.style.opacity = "1";
        phoneIcon.style.display = "inline"; // Display the icon immediately
    } else {
        phoneNumber.style.opacity = "1";
        phoneNumber.style.transform = "scale(1)";
        phoneIcon.style.display = "none"; // Hide the icon immediately
    }
}

function toggleMenu() {
    var navLinks = document.querySelector('nav .nav-links');
    navLinks.classList.toggle('show');
}




