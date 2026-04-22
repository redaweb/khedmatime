let elecsData = [];

function fetchelecs() {
    fetch("../model/get_services_electricite.php")
        .then(response => response.json())
        .then(data => {
            elecsData = data;
            displayelecs();
        })
        .catch(error => console.error("Erreur:", error));
}

document.addEventListener('DOMContentLoaded', fetchelecs);

function displayelecs() {
    const container = document.getElementById('elec-container');
    const countText = document.getElementById('elec-count');
    
    container.innerHTML = ""; 
    countText.innerText = elecsData.length;

    elecsData.forEach(elec => {
        const isExchange = elec.type_service.includes("echange");

        const cardHTML = `
            <div class="elec-card">
                <div class="card-top">
                    <img src="${elec.photo}" alt="${elec.name}" class="profile-img">
                    <div class="info">
                        <h3>${elec.name}</h3>
                        <p class="job-title">${elec.service_nom}</p>
                        <p class="location">${elec.description}</p>
                        <p class="type-service">Type: ${elec.type_service}</p>
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
                        : `<span class="price-tag">${elec.price}</span>`
                    }
                </div>
            </div>
        `;
        container.innerHTML += cardHTML;
    });
}
