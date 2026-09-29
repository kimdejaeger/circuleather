docker-compose up -d --build

handige sql commando's:
TRUNCATE tabelnaam;

http://localhost:8080/

dropdown:
SELECT kleur FROM `product` group by kleur order by kleur;

nice to have:
formaat 23 x 23, voeg vakje hoogte en breedte
zie de voorraad hoeveel en hoe weinig

- Documentatie

Ik heb een voorraadsysteem gemaakt voor een leerbedrijf. Zij wilden graag een overzicht van hun voorraad, zodat ze dit niet meer op papier of in een Word-document hoefden bij te houden.

De programmeertalen die ik heb gebruikt zijn HTML, CSS, JavaScript, SQL en PHP.

Voor de bestanden heb ik namen gebruikt die aangeven waarvoor het bestand dient. Bijvoorbeeld, voor de winkelwagen heb ik een bestand gemaakt met de naam winkelwagen.php. Voor de login heb ik login.html gebruikt.

Als ik meer tijd had gehad, zou ik een functie hebben gemaakt waarmee je kunt zien welke producten wel en niet meer op voorraad zijn.

- Hoe moet je het downloaden?

Je klikt op Code en daarna op Download ZIP. Vervolgens moet je het ZIP-bestand uitpakken.

Als je het project lokaal wilt gebruiken, kun je Docker installeren. Daarna open je de map van het project in de Verkenner. Klik bovenaan op de zoekbalk, typ CMD en druk op Enter.

Daarna typ je in de Command Prompt:

docker compose up

Hiermee worden de benodigde containers gestart en kun je de website lokaal gebruiken.

- Hoe werkt de website. 

Je kunt jezelf registreren als bedrijf of als admin.

- Een admin kan:
   De voorraad bekijken
   Producten bestellen
   Producten toevoegen
   Producten verwijderen
   Producten bewerken
   Bestellingen bekijken

- Een bedrijf kan:
   De voorraad bekijken
   Producten bestellen
   De winkelwagen gebruiken

De rechten zijn dus verschillend per gebruiker. Een admin heeft meer mogelijkheden dan een bedrijf.
