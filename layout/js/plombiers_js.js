let artisansData = [];

function fetchArtisans() {
    fetch("../model/get_services_plombier.php")
        .then(response => response.json())
        .then(data => {
            artisansData = data;
            displayArtisans();
        })
        .catch(error => console.error("Erreur:", error));
}

document.addEventListener('DOMContentLoaded', fetchArtisans);

function displayArtisans() {
    const container = document.getElementById('artisan-container');
    const countText = document.getElementById('artisan-count');
    
    container.innerHTML = ""; 
    countText.innerText = artisansData.length;

    artisansData.forEach(artisan => {
        const isExchange = artisan.type_service.includes("echange");

        const cardHTML = `
            <div class="artisan-card">
                <div class="card-top">
                    <img src="${artisan.photo}" alt="${artisan.name}" class="profile-img">
                    <div class="info">
                        <h3>${artisan.name}</h3>
                        <p class="job-title">${artisan.service_nom}</p>
                        <p class="location">${artisan.description}</p>
                        <p class="type-service">Type: ${artisan.type_service}</p>
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
                        : `<span class="price-tag">${artisan.price}</span>`
                    }
                </div>
            </div>
        `;
        container.innerHTML += cardHTML;
    });
}
