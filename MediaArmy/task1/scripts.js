(function () {
    const popover = document.getElementById("info-popover");
    const openBtn = document.getElementById("open-dialog");
    const closeBtn = document.getElementById("close-dialog");

    if (!popover || !openBtn || !closeBtn) {
        return;
    }

    openBtn.addEventListener("click", function () {
        if (typeof popover.showPopover === "function") {
            popover.showPopover();
        }
    });

    closeBtn.addEventListener("click", function () {
        if (typeof popover.hidePopover === "function") {
            popover.hidePopover();
        }
    });
})();
