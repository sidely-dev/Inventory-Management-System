/**
 * 🌐 GLOBAL INTERFACE NAVIGATION CONTROLLER (public/assets/js/main.js)
 */
document.addEventListener("DOMContentLoaded", () => {
    console.log("🏁 Global layout navigation services online.");

    // Highlight the active page link in your sidebar menu automatically
    const currentLinkPath = window.location.pathname;
    const navigationLinks = document.querySelectorAll("nav ul li a");

    navigationLinks.forEach(link => {
        if (link.getAttribute("href") && currentLinkPath.includes(link.getAttribute("href"))) {
            link.parentElement.classList.add("active-tab");
        }
    });
});

/**
 * Destroys the current login session to sign the administrator out safely
 */
function terminateSecureSession() {
    if (confirm("🔌 Do you want to sign out of the Inventory Management System?")) {
        // Redirect to a service script or clear session cookie variables
        window.location.href = "../index.php?logout=true";
    }
}
