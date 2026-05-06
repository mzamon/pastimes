document.addEventListener('DOMContentLoaded', function () {

    // ── Mobile menu toggle ──────────────────────────────────────
    var toggle = document.querySelector('.mobile-menu-toggle');
    var nav    = document.querySelector('.main-nav');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var isOpen = nav.classList.toggle('open');
            toggle.classList.toggle('active', isOpen);
            toggle.setAttribute('aria-expanded', isOpen.toString());
        });
        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                nav.classList.remove('open');
                toggle.classList.remove('active');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ── Cart quantity auto-submit ───────────────────────────────
    document.querySelectorAll('.cart-qty').forEach(function (input) {
        input.addEventListener('change', function () {
            if (parseInt(this.value) < 1) this.value = 1;
            var form = this.closest('form');
            if (form) form.submit();
        });
    });

    // ── Delete confirmation ─────────────────────────────────────
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            var msg = this.getAttribute('data-confirm') || 'Are you sure?';
            if (!confirm(msg)) e.preventDefault();
        });
    });

    // ── Alert auto-dismiss (5 s) ────────────────────────────────
    document.querySelectorAll('.alert').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.4s';
            alert.style.opacity    = '0';
            setTimeout(function () { alert.style.display = 'none'; }, 400);
        }, 5000);
    });

    // ── Scroll to bottom of message thread ─────────────────────
    var thread = document.querySelector('.message-thread');
    if (thread) thread.scrollTop = thread.scrollHeight;

});
