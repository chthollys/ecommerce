// Smooth Scrolling for Navigation Links
const links = document.querySelectorAll('.nav-links a');
links.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector(link.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Scroll to Top Button
const scrollToTopButton = document.createElement('button');
scrollToTopButton.textContent = '↑';
scrollToTopButton.classList.add('scroll-to-top');
document.body.appendChild(scrollToTopButton);

scrollToTopButton.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

window.addEventListener('scroll', () => {
    if (window.scrollY > 200) {
        scrollToTopButton.style.display = 'block';
    } else {
        scrollToTopButton.style.display = 'none';
    }
});

// Hamburger Menu (for mobile view)
const menuIcon = document.createElement('div');
menuIcon.classList.add('menu-icon');
menuIcon.innerHTML = '<i class="fas fa-bars"></i>';
document.body.querySelector('.navbar').appendChild(menuIcon);

menuIcon.addEventListener('click', () => {
    document.querySelector('.nav-links').classList.toggle('active');
});

const menuIcon = document.querySelector('.menu-icon');
const navLinks = document.querySelector('.nav-links');

menuIcon.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Simulate order status updates
document.addEventListener("DOMContentLoaded", function() {
    const statusCircles = document.querySelectorAll('.status-circle');
    
    // You can update the progress dynamically
    let status = 2; // Let's assume the current status is 'Shipped' (index 2)
    
    for (let i = 0; i <= status; i++) {
        statusCircles[i].classList.add('active');
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const statusCircles = document.querySelectorAll('.status-circle');
    const statusIcons = document.querySelectorAll('.status-icon i');

    let status = 2; // Misalnya status terkini adalah "Shipped" (index 2)

    for (let i = 0; i <= status; i++) {
        statusCircles[i].classList.add('active');
        statusIcons[i].classList.add('active-icon');
    }
});

// Tab Switching
const tabs = document.querySelectorAll('.tab');
const tabContents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));
        
        tab.classList.add('active');
        const targetTab = tab.getAttribute('data-tab');
        document.getElementById(targetTab).classList.add('active');
    });
});

// Add Payment Method
document.getElementById('add-payment-btn').addEventListener('click', () => {
    const newPayment = prompt('Enter new payment method (e.g., PayPal, Dana):');
    if (newPayment) {
        const paymentList = document.querySelector('.payment-list');
        const li = document.createElement('li');
        li.innerHTML = `
            <div class="payment-info">
                <span>${newPayment}</span>
            </div>
            <button class="secondary-btn remove-btn">Remove</button>
        `;
        paymentList.appendChild(li);
    }
});

// Add Address
document.getElementById('add-address-btn').addEventListener('click', () => {
    const newAddress = prompt('Enter new address:');
    if (newAddress) {
        const addressList = document.querySelector('.address-list');
        const li = document.createElement('li');
        li.innerHTML = `
            <span>${newAddress}</span>
            <button class="secondary-btn edit-btn">Edit</button>
            <button class="secondary-btn remove-btn">Remove</button>
        `;
        addressList.appendChild(li);
    }
});

// Logout
document.getElementById('logout-btn').addEventListener('click', () => {
    if (confirm('Are you sure you want to logout?')) {
        window.location.href = 'login.html';  // Redirect to login page
    }
});
