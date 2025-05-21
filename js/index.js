document.addEventListener('DOMContentLoaded', function() {
    const panes = document.querySelectorAll('.tab-pane');
    panes.forEach(pane => {
        if (!pane.classList.contains('active')) {
            pane.style.display = 'none';
        }
    });
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            panes.forEach(pane => pane.style.display = 'none');
            tab.classList.add('active');
            const targetId = tab.getAttribute('data-tab');
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.style.display = 'block';
            }
        });
    });
});