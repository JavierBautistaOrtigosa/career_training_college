document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("toggleFilters");
    const filters = document.getElementById("filtersContainer");

    if (!toggleBtn || !filters) return;

    const contentWrapper =
        document.querySelector(".table-responsive") ||
        document.querySelector(".row.g-3") ||
        document.querySelector(".row");

    // Restore state
    const savedState = localStorage.getItem("filtersOpen") === "true";

    if (!savedState) {
        filters.classList.add("d-none");
    } else {
        filters.style.marginTop = "1.5rem";
        contentWrapper.style.marginTop = "3rem";
    }

    toggleBtn.addEventListener("click", function () {
        const isHidden = filters.classList.toggle("d-none");

        localStorage.setItem("filtersOpen", !isHidden);

        if (!isHidden) {
            filters.style.marginTop = "1.5rem";
            contentWrapper.style.marginTop = "3rem";
        } else {
            filters.style.marginTop = "0";
            contentWrapper.style.marginTop = "0";
        }
    });
});
