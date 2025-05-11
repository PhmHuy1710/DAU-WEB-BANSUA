document.addEventListener("DOMContentLoaded", function () {
  const mobileToggle = document.getElementById("mobileToggle");
  const mainNav = document.getElementById("mainNav");

  if (mobileToggle) {
    mobileToggle.addEventListener("click", function () {
      mainNav.classList.toggle("active");
      this.classList.toggle("active");
    });
  }

  const userDropdown = document.getElementById("userDropdown");
  const userDropdownMenu = document.getElementById("userDropdownMenu");

  if (userDropdown && userDropdownMenu) {
    userDropdown.addEventListener("click", function (e) {
      e.stopPropagation();
      userDropdownMenu.classList.toggle("active");
      if (window.innerWidth <= 768) {
        document.body.classList.toggle("dropdown-open");
      }
    });

    document.addEventListener("click", function () {
      userDropdownMenu.classList.remove("active");
      document.body.classList.remove("dropdown-open");
    });

    window.addEventListener("resize", function () {
      if (window.innerWidth > 768) {
        if (document.body.classList.contains("dropdown-open")) {
          document.body.classList.remove("dropdown-open");
        }
      }
    });
  }

  highlightCurrentNavItem();
});

function highlightCurrentNavItem() {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll(".nav-link");

  navLinks.forEach(link => {
    const href = link.getAttribute("href");
    if (currentPath.includes(href) && href !== "/") {
      link.classList.add("active");
    }
  });
}
