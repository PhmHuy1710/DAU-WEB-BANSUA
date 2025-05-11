document.addEventListener("DOMContentLoaded", function () {
  const phanTuMo = document.querySelectorAll(".fade-in");
  const phanTuPhong = document.querySelectorAll(".scale-in");

  const tuyChinh = {
    root: null,
    rootMargin: "0px",
    threshold: 0.1,
  };

  const xuLyMo = new IntersectionObserver(function (entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = "running";
        observer.unobserve(entry.target);
      }
    });
  }, tuyChinh);

  phanTuMo.forEach(el => {
    el.style.animationPlayState = "paused";
    xuLyMo.observe(el);
  });

  const xuLyPhong = new IntersectionObserver(function (entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = "running";
        observer.unobserve(entry.target);
      }
    });
  }, tuyChinh);

  phanTuPhong.forEach(el => {
    el.style.animationPlayState = "paused";
    xuLyPhong.observe(el);
  });

  if (typeof window.showToast !== "function") {
    window.showToast = function (thongBao, loai = "success") {
      const toast = document.createElement("div");
      toast.className = "toast-notification";

      if (loai === "success") {
        toast.innerHTML = `<i class="fas fa-check-circle"></i> ${thongBao}`;
        toast.style.backgroundColor = "#28a745";
      } else if (loai === "error") {
        toast.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${thongBao}`;
        toast.style.backgroundColor = "#dc3545";
      } else if (loai === "info") {
        toast.innerHTML = `<i class="fas fa-info-circle"></i> ${thongBao}`;
        toast.style.backgroundColor = "#17a2b8";
      }

      document.body.appendChild(toast);

      setTimeout(() => {
        toast.classList.add("show");
      }, 100);

      setTimeout(() => {
        toast.classList.remove("show");

        setTimeout(() => {
          document.body.removeChild(toast);
        }, 300);
      }, 3000);
    };
  }

  const allFormSearch = document.querySelectorAll(".hero-search, .search-form");

  allFormSearch.forEach(form => {
    form.addEventListener("submit", function (e) {
      const nhapTK = this.querySelector(".search-input");
      if (nhapTK && nhapTK.value.trim() === "") {
        e.preventDefault();
        if (typeof window.showToast === "function") {
          window.showToast("Vui lòng nhập từ khóa tìm kiếm", "info");
        }
      }
    });
  });
});
