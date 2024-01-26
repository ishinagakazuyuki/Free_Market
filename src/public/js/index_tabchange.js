function showTab(tabId) {
    const targetTab = document.querySelector(`.index_main-list-item[data-tab="${tabId}"]`);
    document.querySelectorAll('.tab-content').forEach(function(tab) {
        tab.style.display = 'none';
    });

    document.querySelectorAll('.index_main-list-item').forEach(function(tab) {
        tab.classList.remove('active');
    });

    document.getElementById(tabId).style.display = 'flex';
    if (targetTab) {
        targetTab.classList.add('active');
    }
}