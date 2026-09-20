let winkelwagen = JSON.parse(localStorage.getItem("winkelwagen")) || [];

// Product toevoegen
function productToevoegen(product) {
  let bestaandProduct = winkelwagen.find((item) => item.id === product.id);

  if (bestaandProduct) {
    if (bestaandProduct.aantal < bestaandProduct.voorraad) {
      bestaandProduct.aantal++;
    }
  } else {
    product.aantal = 1;

    winkelwagen.push(product);
  }

  winkelwagenOpslaan();

  alert("Product toegevoegd aan de winkelwagen!");
}

// Winkelwagen opslaan
function winkelwagenOpslaan() {
  localStorage.setItem("winkelwagen", JSON.stringify(winkelwagen));
}

// Product verwijderen
function productVerwijderen(id) {
  winkelwagen = winkelwagen.filter((product) => product.id !== id);

  winkelwagenOpslaan();

  winkelwagenTonen();
}

// Aantal veranderen
function aantalVeranderen(id, aantal) {
  let product = winkelwagen.find((item) => item.id === id);

  if (!product) {
    return;
  }

  aantal = parseInt(aantal);

  if (aantal < 1) {
    aantal = 1;
  }

  if (aantal > product.voorraad) {
    aantal = product.voorraad;
  }

  product.aantal = aantal;

  winkelwagenOpslaan();

  winkelwagenTonen();
}

// Winkelwagen tonen
function winkelwagenTonen() {
  const winkelwagenElement = document.getElementById("winkelwagen");

  if (!winkelwagenElement) {
    return;
  }

  winkelwagenElement.innerHTML = "";

  if (winkelwagen.length === 0) {
    winkelwagenElement.innerHTML = "<p>Je winkelwagen is leeg.</p>";

    document.getElementById("totaal").textContent = "Totaal: €0.00";

    return;
  }

  winkelwagen.forEach((product) => {
    const div = document.createElement("div");

    div.innerHTML = `
            <h3>${product.naam}</h3>

            <p>
                Prijs: €${product.prijs.toFixed(2)}
            </p>

            <p>
                Voorraad: ${product.voorraad}
            </p>

            <label>
                Aantal:
                <input
                    type="number"
                    min="1"
                    max="${product.voorraad}"
                    value="${product.aantal}"
                    onchange="aantalVeranderen(
                        ${product.id},
                        this.value
                    )"
                >
            </label>

            <button
                type="button"
                onclick="productVerwijderen(${product.id})"
            >
                Verwijderen
            </button>

            <hr>
        `;

    winkelwagenElement.appendChild(div);
  });

  totaalBerekenen();
}

// Totaal berekenen
function totaalBerekenen() {
  let totaal = 0;

  winkelwagen.forEach((product) => {
    totaal += product.prijs * product.aantal;
  });

  document.getElementById("totaal").textContent = "Totaal: €" + totaal.toFixed(2);
}

// Bestelknoppen activeren
document.addEventListener("DOMContentLoaded", function () {
  const knoppen = document.querySelectorAll(".bestel-knop");

  knoppen.forEach((knop) => {
    knop.addEventListener("click", function () {
      const product = {
        id: parseInt(this.dataset.id),

        naam: this.dataset.naam,

        prijs: parseFloat(this.dataset.prijs),

        voorraad: parseInt(this.dataset.voorraad),
      };

      productToevoegen(product);
    });
  });

  winkelwagenTonen();
});
