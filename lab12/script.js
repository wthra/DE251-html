function toggleTheme() {
    document.body.classList.toggle('dark-mode');
}

function fetchDirectoryData() {
    const directory = document.getElementById('directorySelect').value;
    const directoryPath = directory === 'json' ? 'json/index.html' : 'xml/index.html';
    window.location.href = directoryPath;
}

function goBack() {
    window.location.href = '../index.html';
}