function toggleTheme() {
    document.body.classList.toggle('dark-mode');
}

function fetchUserData() {
    fetch('user.xml')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(userData => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(userData, "application/xml");
            const name = xmlDoc.getElementsByTagName("name")[0].childNodes[0].nodeValue;
            const username = xmlDoc.getElementsByTagName("username")[0].childNodes[0].nodeValue;
            const email = xmlDoc.getElementsByTagName("email")[0].childNodes[0].nodeValue;
            const address = xmlDoc.getElementsByTagName("address")[0];
            const street = address.getElementsByTagName("street")[0].childNodes[0].nodeValue;
            const city = address.getElementsByTagName("city")[0].childNodes[0].nodeValue;
            const zipcode = address.getElementsByTagName("zipcode")[0].childNodes[0].nodeValue;
            const userInfoDiv = document.getElementById('userInfo');
            userInfoDiv.innerHTML = `
                <h2>${name}</h2>
                <p><strong>Username:</strong> ${username}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Address:</strong> ${street}, ${city}, ${zipcode}</p>
            `;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function goBack() {
    window.location.href = '../index.html';
}