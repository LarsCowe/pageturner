# PageTurner

Een sociale boeken-community platform gebouwd met Laravel waar gebruikers boeken kunnen ontdekken, hun leesvoortgang bijhouden, reviews schrijven en deelnemen aan book clubs.

## Inhoudsopgave

-   [Features](#features)
-   [Installatie](#installatie)
-   [Standaard Admin Account](#standaard-admin-account)
-   [Technische Stack](#technische-stack)
-   [Database Structuur](#database-structuur)
-   [Bronvermeldingen](#bronvermeldingen)

## Features

### Publieke Features

-   **Home pagina** met featured boeken en nieuws
-   **Boeken catalogus** met zoek- en filterfunctionaliteit
-   **Nieuws sectie** met artikelen en publicatiedatums
-   **FAQ pagina** met vragen gegroepeerd per categorie
-   **Contact formulier** dat emails verstuurt naar admins
-   **Publieke profielen** van gebruikers

### Gebruiker Features

-   **Account registratie** met email verificatie
-   **Profiel beheer** (username, verjaardag, profielfoto, bio, favoriete genres)
-   **Boekenplanken** (currently reading, read, want to read)
-   **Reviews & ratings** voor boeken
-   **Reading activities** met streak tracking
-   **Book clubs** aanmaken, joinen en discussies voeren
-   **Commentaren** op nieuwsartikelen

### Admin Features

-   **Dashboard** met overzicht
-   **Gebruikersbeheer** (aanmaken, bewerken, verwijderen, admin rechten toekennen/afnemen)
-   **Nieuws beheer** (CRUD operaties met afbeeldingen)
-   **Boeken beheer** (CRUD operaties met covers, genres, moods)
-   **FAQ beheer** (categorieën en items)
-   **Book clubs beheer**

## Installatie

### Vereisten

-   PHP 8.2 of hoger (of gebruik **Laravel Herd** voor een alles-in-één omgeving)
-   Composer
-   Node.js & NPM
-   SQLite (standaard) of MySQL

> **Tip:** Als je [Laravel Herd](https://herd.laravel.com) gebruikt, zijn PHP, Composer en Node.js vaak al geregeld. Je kunt het project simpelweg in je Herd directory clonen.

### Stappen (Algemeen)

1. **Clone de repository**

    ```bash
    git clone https://github.com/LarsCowe/pageturner.git
    cd pageturner
    ```

2. **Installeer PHP dependencies**

    ```bash
    composer install
    ```

3. **Installeer NPM dependencies**

    ```bash
    npm install
    ```

4. **Kopieer het environment bestand**

    ```bash
    cp .env.example .env
    ```

5. **Configureer de database in `.env`**

    ```
    DB_CONNECTION=sqlite
    # Verwijder of commentarieer de overige DB_ regels voor SQLite
    ```

    > **Let op:** Zorg ervoor dat je een leeg bestand aanmaakt in `database/database.sqlite`.
    >
    > - Windows (PowerShell): `New-Item -ItemType File database/database.sqlite`
    > - Mac/Linux: `touch database/database.sqlite`

6. **Configureer mail settings in `.env`** (voor contact formulier)

    Standaard worden emails in de development omgeving naar de log file geschreven om te testen.
    Gebruik hiervoor de volgende instellingen:

    ```
    MAIL_MAILER=log
    QUEUE_CONNECTION=sync
    ```

    > **Hoe te testen:** Vul het contactformulier in op de website. De inhoud van de email verschijnt vervolgens onderaan in `storage/logs/laravel.log`.

    Wil je toch een echte SMTP server (of Mailpit) gebruiken?
    ```
    MAIL_MAILER=smtp
    MAIL_HOST=127.0.0.1
    MAIL_PORT=1025
    ```

7. **Genereer application key**

    ```bash
    php artisan key:generate
    ```

8. **Maak storage link aan**

    ```bash
    php artisan storage:link
    ```

### Installatie via Laravel Herd (Windows/macOS)

1. **Open Herd** en zorg dat Services gestart zijn.
2. Ga naar je Herd directory in de terminal (bv. `cd ~/Herd`).
3. Clone dit project: `git clone https://github.com/LarsCowe/pageturner.git pageturner`.
4. Open de map: `cd pageturner`.
5. Run de setup commandos:

    ```bash
    composer install
    npm install
    npm run build
    cp .env.example .env
    php artisan key:generate
    php artisan storage:link

    # Windows (PowerShell) - Maak database bestand aan
    New-Item -ItemType File database/database.sqlite
    # Of MacOS/Linux:
    # touch database/database.sqlite
    ```

6. Zet in je `.env` file `DB_CONNECTION=sqlite`.
7. Run migraties & seeders: `php artisan migrate:fresh --seed`.
8. De site is nu bereikbaar via **pageturner.test** (of via de browser link in Herd).

9. **Run migrations en seeders**

    ```bash
    php artisan migrate:fresh --seed
    ```

10. **Build frontend assets**

    ```bash
    npm run build
    ```

11. **Start de development server**
    ```bash
    php artisan serve
    ```

De applicatie is nu beschikbaar op `http://localhost:8000`

## Standaard Admin Account

Na het seeden van de database is er een admin account beschikbaar:

| Veld     | Waarde       |
| -------- | ------------ |
| Username | admin        |
| Email    | admin@ehb.be |
| Password | Password!321 |

## Technische Stack

-   **Framework:** Laravel 12
-   **Frontend:** Blade templates, Tailwind CSS, Alpine.js
-   **Database:** MySQL met Eloquent ORM
-   **Authentication:** Laravel Breeze
-   **File Storage:** Laravel Storage (public disk)

## Database Structuur

### Belangrijke Relaties

**One-to-Many:**

-   User → Reviews
-   User → NewsItems (als auteur)
-   User → ReadingActivities
-   Book → Reviews
-   FaqCategory → FaqItems
-   BookClub → ClubPosts

**Many-to-Many:**

-   User ↔ Books (via `book_user` pivot voor boekenplanken)
-   User ↔ BookClubs (via `book_club_user` pivot met rollen)
-   Book ↔ Genres (via `book_genre` pivot)
-   Book ↔ Moods (via `book_mood` pivot)

### Tabellen Overzicht

| Tabel              | Beschrijving                              |
| ------------------ | ----------------------------------------- |
| users              | Gebruikers met profiel info en admin flag |
| books              | Boeken catalogus met metadata             |
| genres             | Boek genres                               |
| moods              | Boek moods/sferen                         |
| reviews            | Gebruiker reviews voor boeken             |
| book_user          | Pivot voor boekenplanken                  |
| news_items         | Nieuwsartikelen                           |
| news_comments      | Commentaren op nieuws                     |
| faq_categories     | FAQ categorieën                           |
| faq_items          | FAQ vragen en antwoorden                  |
| book_clubs         | Book clubs                                |
| book_club_user     | Club lidmaatschap met rollen              |
| club_posts         | Discussie posts in clubs                  |
| club_comments      | Commentaren op club posts                 |
| reading_activities | Dagelijkse leesactiviteiten               |

## Bronvermeldingen

### Code & Tutorials

-   [Laravel 12 Documentation](https://laravel.com/docs/12.x) - Officiële Laravel documentatie
-   [Laravel Breeze](https://laravel.com/docs/12.x/starter-kits#laravel-breeze) - Authentication starter kit
-   [Tailwind CSS Documentation](https://tailwindcss.com/docs) - CSS framework documentatie
-   [Alpine.js Documentation](https://alpinejs.dev/start-here) - JavaScript framework voor interactieve componenten
-   [Laravel Eloquent Relationships](https://laravel.com/docs/12.x/eloquent-relationships) - Database relaties
-   [Laravel File Storage](https://laravel.com/docs/12.x/filesystem) - Bestandsuploads (profielfoto's, covers, nieuws afbeeldingen)
-   [Laravel Mail](https://laravel.com/docs/12.x/mail) - Email functionaliteit voor contactformulier
-   [Laravel Middleware](https://laravel.com/docs/12.x/middleware) - Custom admin middleware
-   [Laravel Validation](https://laravel.com/docs/12.x/validation) - Form validation regels
-   [Laravel Pagination](https://laravel.com/docs/12.x/pagination) - Paginatie voor lijsten

### Afbeeldingen & Assets

-   [Storyset](https://storyset.com/) - Vectoren en illustraties
-   [Unsplash](https://unsplash.com/) - Stock foto's
-   [Heroicons](https://heroicons.com/) - SVG icons

## Project Requirements

### Functionele Minimum Requirements

**Login Systeem**

-   Bezoekers kunnen inloggen en registreren
-   Useraccount is regular user of admin
-   Admins kunnen admin-rechten beheren en manueel users aanmaken
-   Default admin (admin@ehb.be / Password!321)

**Profielpagina**

-   Publiek profiel voor iedereen zichtbaar
-   Ingelogde user kan eigen data (username, verjaardag, avatar, bio) aanpassen

**Nieuws & FAQ**

-   Admins beheren nieuwsitems en FAQ (CRUD)
-   Bezoekers kunnen lezen/bekijken

**Contact**

-   Publiek contactformulier dat mails stuurt naar admins

### Extra Geïmplementeerde Features

Om de gebruikerservaring te verrijken zijn de volgende extra features toegevoegd bovenop de minimum requirements:

-   **Book Clubs & Social Reading:** Volledig systeem om clubs te maken, leden te beheren (roles), en discussies te voeren via posts en comments.
-   **Uitgebreid Reviews Systeem:** Gebruikers kunnen boeken beoordelen (1-5 sterren) en recensies schrijven, zichtbaar op de boekpagina.
-   **Reading Shelves & Progress:** 'Goodreads-style' boekenplanken (Want to Read, Reading, Read) en voortgangsregistratie.
-   **Gamification / Reading Streaks:** Automatische tracking van opeenvolgende leesdagen om gebruikers te motiveren.
-   **Interactieve Nieuws Sectie:** Gebruikers kunnen reageren op nieuwsberichten (comments).
-   **Mood-based Discovery:** Boeken vinden op basis van sfeer/mood (bv. "Spooky", "Relaxing") naast standaard genres.

### Technische Requirements

-   **PHP/Laravel:** Nieuwste versie, dynamische data, correcte bronvermelding
-   **Views:** Minstens 2 layouts, components, XSS/CSRF protectie
-   **Routes/Controllers:** Controller methods, juiste middleware, resource controllers
-   **Database:** Eloquent models, relaties (1-N, N-N), werkende seeders
-   **Git:** Regelmatige commits, .gitignore correct ingesteld

> Dit project voldoet aan al deze requirements inclusief extra features zoals book clubs, reviews, reading streaks en een comment systeem.

-   [Heroicons](https://heroicons.com/) - SVG icons gebruikt in de UI
-   Boek covers zijn placeholder afbeeldingen voor demonstratiedoeleinden

### AI Tools

-   [GitHub Copilot](https://github.com/features/copilot) - AI-gestuurde code suggesties en autocompletion

### Overige Bronnen

-   [Laracasts](https://laracasts.com/) - Video tutorials over Laravel
-   [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel) - Oplossingen voor specifieke problemen

## Licentie

Dit project is gemaakt als schoolopdracht voor de EhB.
