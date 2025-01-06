function fetchUserData() {
    fetch('user.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(userData => {
            const userInfoDiv = document.getElementById('userInfo');
            userInfoDiv.innerHTML = `
                <h2>${userData.name}</h2>
                <p><strong>Username:</strong> ${userData.username}</p>
                <p><strong>Email:</strong> ${userData.email}</p>
                <p><strong>Address:</strong> ${userData.address.street},
                ${userData.address.city}, ${userData.address.zipcode}</p>
            `;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function toggleTheme() {
    document.body.classList.toggle('dark-mode');
}