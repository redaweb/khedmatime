let menuiseriesData = [];

function fetchmenuiseries() {
    fetch("../model/get_services_menuiserie.php")
        .then(response => response.json())
        .then(data => {
            menuiseriesData = data;
            displaymenuiseries();
        })
        .catch(error => console.error("Erreur:", error));
}

document.addEventListener('DOMContentLoaded', fetchmenuiseries);

function displaymenuiseries() {
    const container = document.getElementById('menuiserie-container');
    const countText = document.getElementById('menuiserie-count');
    
    container.innerHTML = ""; 
    countText.innerText = menuiseriesData.length;

    menuiseriesData.forEach(menuiserie => {
        const isExchange = menuiserie.type_service.includes("echange");

        const cardHTML = `
            <div class="menuiserie-card">
                <div class="card-top">
                    <img src="${menuiserie.photo}" alt="${menuiserie.name}" class="profile-img">
                    <div class="info">
                        <h3>${menuiserie.name}</h3>
                        <p class="job-title">${menuiserie.service_nom}</p>
                        <p class="location">${menuiserie.description}</p>
                        <p class="type-service">Type: ${menuiserie.type_service}</p>
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
                        : `<span class="price-tag">${menuiserie.price}</span>`
                    }
                </div>
            </div>
        `;
        container.innerHTML += cardHTML;
    });
}
