let mecaniquesData = [];

function fetchmecaniques() {
    fetch("../model/get_services_mecanique.php")
        .then(response => response.json())
        .then(data => {
            mecaniquesData = data;
            displaymecaniques();
        })
        .catch(error => console.error("Erreur:", error));
}

document.addEventListener('DOMContentLoaded', fetchmecaniques);

function displaymecaniques() {
    const container = document.getElementById('mecanique-container');
    const countText = document.getElementById('mecanique-count');
    
    container.innerHTML = ""; 
    countText.innerText = mecaniquesData.length;

    mecaniquesData.forEach(mecanique => {
        const isExchange = mecanique.type_service.includes("echange");

        const cardHTML = `
            <div class="mecanique-card">
                <div class="card-top">
                    <img src="${mecanique.photo}" alt="${mecanique.name}" class="profile-img">
                    <div class="info">
                        <h3>${mecanique.name}</h3>
                        <p class="job-title">${mecanique.service_nom}</p>
                        <p class="location">${mecanique.description}</p>
                        <p class="type-service">Type: ${mecanique.type_service}</p>
                    </div>
                    <div class="rating-tag">
                        ⭐ ${Math.round(Math.random() * 15 + 35)/10} 
                        <span style="color:#aaa; font-weight:normal; font-size:12px">
                            (${Math.floor(Math.random() * 111 + 10)})
                        </span>
                    </div>
                </div>
                <div class="card-footer">
                    ${isExchange 
                        ? `<span class="exchange-badge"><i class="fas fa-sync-alt"></i> Accepte l'échange</span>` 
                        : `<span class="price-tag">${mecanique.price}</span>`
                    }
                </div>
            </div>
        `;
        container.innerHTML += cardHTML;
    });
}
