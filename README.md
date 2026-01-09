# PageTurner

Een sociale boeken-community platform gebouwd met Laravel waar gebruikers boeken kunnen ontdekken, hun leesvoortgang bijhouden, reviews schrijven en deelnemen aan book clubs.

## Inhoudsopgave

- [Features](#features)
- [Installatie](#installatie)
- [Standaard Admin Account](#standaard-admin-account)
- [Technische Stack](#technische-stack)
- [Database Structuur](#database-structuur)
- [Bronvermeldingen](#bronvermeldingen)

## Features

### Publieke Features
- **Home pagina** met featured boeken en nieuws
- **Boeken catalogus** met zoek- en filterfunctionaliteit
- **Nieuws sectie** met artikelen en publicatiedatums
- **FAQ pagina** met vragen gegroepeerd per categorie
- **Contact formulier** dat emails verstuurt naar admins
- **Publieke profielen** van gebruikers

### Gebruiker Features
- **Account registratie** met email verificatie
- **Profiel beheer** (username, verjaardag, profielfoto, bio, favoriete genres)
- **Boekenplanken** (currently reading, read, want to read)
- **Reviews & ratings** voor boeken
- **Reading activities** met streak tracking
- **Book clubs** aanmaken, joinen en discussies voeren
- **Commentaren** op nieuwsartikelen

### Admin Features
- **Dashboard** met overzicht
- **Gebruikersbeheer** (aanmaken, bewerken, verwijderen, admin rechten toekennen/afnemen)
- **Nieuws beheer** (CRUD operaties met afbeeldingen)
- **Boeken beheer** (CRUD operaties met covers, genres, moods)
- **FAQ beheer** (categorieën en items)
- **Book clubs beheer**

## Installatie

### Vereisten
- PHP 8.2 of hoger
- Composer
- Node.js & NPM
- MySQL of andere database

### Stappen

1. **Clone de repository**
   ```bash
   git clone <repository-url>
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
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pageturner
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Configureer mail settings in `.env`** (voor contact formulier)
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=your-mail-host
   MAIL_PORT=587
   MAIL_USERNAME=your-username
   MAIL_PASSWORD=your-password
   MAIL_FROM_ADDRESS="noreply@pageturner.com"
   MAIL_FROM_NAME="PageTurner"
   ```

7. **Genereer application key**
   ```bash
   php artisan key:generate
   ```

8. **Maak storage link aan**
   ```bash
   php artisan storage:link
   ```

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

| Veld     | Waarde           |
|----------|------------------|
| Username | admin            |
| Email    | admin@ehb.be     |
| Password | Password!321     |

## Technische Stack

- **Framework:** Laravel 12
- **Frontend:** Blade templates, Tailwind CSS, Alpine.js
- **Database:** MySQL met Eloquent ORM
- **Authentication:** Laravel Breeze
- **File Storage:** Laravel Storage (public disk)

## Database Structuur

### Belangrijke Relaties

**One-to-Many:**
- User → Reviews
- User → NewsItems (als auteur)
- User → ReadingActivities
- Book → Reviews
- FaqCategory → FaqItems
- BookClub → ClubPosts

**Many-to-Many:**
- User ↔ Books (via `book_user` pivot voor boekenplanken)
- User ↔ BookClubs (via `book_club_user` pivot met rollen)
- Book ↔ Genres (via `book_genre` pivot)
- Book ↔ Moods (via `book_mood` pivot)

### Tabellen Overzicht

| Tabel | Beschrijving |
|-------|--------------|
| users | Gebruikers met profiel info en admin flag |
| books | Boeken catalogus met metadata |
| genres | Boek genres |
| moods | Boek moods/sferen |
| reviews | Gebruiker reviews voor boeken |
| book_user | Pivot voor boekenplanken |
| news_items | Nieuwsartikelen |
| news_comments | Commentaren op nieuws |
| faq_categories | FAQ categorieën |
| faq_items | FAQ vragen en antwoorden |
| book_clubs | Book clubs |
| book_club_user | Club lidmaatschap met rollen |
| club_posts | Discussie posts in clubs |
| club_comments | Commentaren op club posts |
| reading_activities | Dagelijkse leesactiviteiten |

## Bronvermeldingen

### Code & Tutorials
- [Laravel 12 Documentation](https://laravel.com/docs/12.x) - Officiële Laravel documentatie
- [Laravel Breeze](https://laravel.com/docs/12.x/starter-kits#laravel-breeze) - Authentication starter kit
- [Tailwind CSS Documentation](https://tailwindcss.com/docs) - CSS framework documentatie
- [Alpine.js Documentation](https://alpinejs.dev/start-here) - JavaScript framework voor interactieve componenten
- [Laravel Eloquent Relationships](https://laravel.com/docs/12.x/eloquent-relationships) - Database relaties
- [Laravel File Storage](https://laravel.com/docs/12.x/filesystem) - Bestandsuploads (profielfoto's, covers, nieuws afbeeldingen)
- [Laravel Mail](https://laravel.com/docs/12.x/mail) - Email functionaliteit voor contactformulier
- [Laravel Middleware](https://laravel.com/docs/12.x/middleware) - Custom admin middleware
- [Laravel Validation](https://laravel.com/docs/12.x/validation) - Form validation regels
- [Laravel Pagination](https://laravel.com/docs/12.x/pagination) - Paginatie voor lijsten

### Afbeeldingen & Assets
- [Heroicons](https://heroicons.com/) - SVG icons gebruikt in de UI
- Boek covers zijn placeholder afbeeldingen voor demonstratiedoeleinden

### AI Tools
- [GitHub Copilot](https://github.com/features/copilot) - AI-gestuurde code suggesties en autocompletion

### Overige Bronnen
- [Laracasts](https://laracasts.com/) - Video tutorials over Laravel
- [Stack Overflow](https://stackoverflow.com/questions/tagged/laravel) - Oplossingen voor specifieke problemen

## Licentie

Dit project is gemaakt als schoolopdracht voor de EhB.
