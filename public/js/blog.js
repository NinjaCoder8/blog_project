const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        entry.target.classList.toggle("blog-show", entry.isIntersecting);
    });
});
const blogElements = document.querySelectorAll(".blog");
blogElements.forEach((blog) => observer.observe(blog));
