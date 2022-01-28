<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 1,
            'name' => 'Administration, commerce et gestion',
            'name_en' => 'Administration, business and management',
            'name_nl' => 'Administratie, handel en beheer',
            'profil' => 'stats.svg',
            'alt' => 'icone de statistiques',
            'alt_en' => 'statistics icon',
            'alt_nl' => 'statistiekpictogram'
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Les thérapies alternatives',
            'name_en' => 'Alternative therapies',
            'name_nl' => 'Alternatieve therapieën',
            'profil' => 'reiki.svg',
            'alt' => 'icone représentant le métier thérapeutique',
            'alt_en' => 'icon representing the therapeutic profession',
            'alt_nl' => 'icoon van het therapeutisch beroep'
        ]);
        Category::create([
            'id' => 3,
            'name' => 'Animaux, terre et environnement',
            'name_en' => 'Animals, land and environment',
            'name_nl' => 'Dieren, land en milieu',
            'profil' => 'growth.svg',
            'alt' => 'icone représentant l\'environnement',
            'alt_en' => 'environment icon',
            'alt_nl' => 'milieu-icoon'
        ]);
        Category::create([
            'id' => 4,
            'name' => 'Informatique et TIC',
            'name_en' => 'Computer science and ICT',
            'name_nl' => 'Computers en ICT',
            'profil' => 'technology.svg',
            'alt' => 'icone représentant la technologie',
            'alt_en' => 'technology icon',
            'alt_nl' => 'technologie-icoon'
        ]);
        Category::create([
            'id' => 5,
            'name' => 'Construction et bâtiment',
            'name_en' => 'Construction and building',
            'name_nl' => 'Bouw en constructie',
            'profil' => 'brickwall.svg',
            'alt' => 'icone représentant le métier du bâtiment',
            'alt_en' => 'building trade icon',
            'alt_nl' => 'pictogram bouwhandel'
        ]);
        Category::create([
            'id' => 6,
            'name' => 'Design, arts et artisanat',
            'name_en' => 'Design, arts and crafts',
            'name_nl' => 'Design, kunst en ambachten',
            'profil' => 'creativity.svg',
            'alt' => 'icone représentant le design',
            'alt_en' => 'design icon',
            'alt_nl' => 'designicoon'
        ]);
        Category::create([
            'id' => 7,
            'name' => 'Education et formation',
            'name_en' => 'Education and training',
            'name_nl' => 'Onderwijs en opleiding',
            'profil' => 'career.svg',
            'alt' => 'icone représentant l\'éducation',
            'alt_en' => 'education icon',
            'alt_nl' => 'onderwijsicoon'
        ]);
        Category::create([
            'id' => 8,
            'name' => 'Ingénierie',
            'name_en' => 'Engineering',
            'name_nl' => 'Ingenieur',
            'profil' => 'prototype.svg',
            'alt' => 'icone représentant le métier de l\'ingénierie',
            'alt_en' => 'icon representing the engineering profession',
            'alt_nl' => 'icoon van het ingenieursberoep'
        ]);
        Category::create([
            'id' => 9,
            'name' => 'Installations et services immobiliers',
            'name_en' => 'Real Estate Facilities and Services',
            'name_nl' => 'Vastgoedfaciliteiten en -diensten',
            'profil' => 'manager.svg',
            'alt' => 'icone représentant le métier de l\'immobilier',
            'alt_en' => 'icon representing the real estate profession',
            'alt_nl' => 'icoon van het onroerend goed beroep'
        ]);
        Category::create([
            'id' => 10,
            'name' => 'Services financiers',
            'name_en' => 'Financial Services',
            'name_nl' => 'Financiële diensten',
            'profil' => 'analysis.svg',
            'alt' => 'icone représentant le métier de la finance',
            'alt_en' => 'icon representing the finance profession',
            'alt_nl' => 'icoon van het financiële beroep'
        ]);
        Category::create([
            'id' => 11,
            'name' => 'Services de garage',
            'name_en' => 'Garage services',
            'name_nl' => 'Garage diensten',
            'profil' => 'garage.svg',
            'alt' => 'icone représentant le métier de garagiste',
            'alt_en' => 'icon representing the profession of garage',
            'alt_nl' => 'icoon dat het beroep van garagist voorstelt'
        ]);
        Category::create([
            'id' => 12,
            'name' => 'Coiffure et beauté',
            'name_en' => 'Hair and Beauty',
            'name_nl' => 'Kapsalon en schoonheidssalon',
            'profil' => 'cosmetics.svg',
            'alt' => 'icone représentant le métier de la coiffure',
            'alt_en' => 'icon representing the profession of hairdressing',
            'alt_nl' => 'icoon van het kappersvak'
        ]);
        Category::create([
            'id' => 13,
            'name' => 'Soins de santé',
            'name_en' => 'Health Care',
            'name_nl' => 'Gezondheidszorg',
            'profil' => 'heartbeat.svg',
            'alt' => 'icone représentant le métier des soins de santé',
            'alt_en' => 'icon representing the health care profession',
            'alt_nl' => 'icoon van het beroep in de gezondheidszorg'
        ]);
        Category::create([
            'id' => 14,
            'name' => 'Patrimoine, culture et bibliothèques',
            'name_en' => 'Heritage, culture and libraries',
            'name_nl' => 'Erfgoed, cultuur en bibliotheken',
            'profil' => 'book.svg',
            'alt' => 'icone représentant une bibliothèque',
            'alt_en' => 'icon representing a library',
            'alt_nl' => 'icoon dat een bibliotheek voorstelt'
        ]);
        Category::create([
            'id' => 15,
            'name' => 'Hôtellerie, restauration et tourisme',
            'name_en' => 'Hotel, restaurant and tourism',
            'name_nl' => 'Hotels, restaurants en toerisme',
            'profil' => 'travel.svg',
            'alt' => 'icone représentant le métier de l\'hôtellerie',
            'alt_en' => 'hotel trade icon',
            'alt_nl' => 'icoon van de hotelbranche'
        ]);
        Category::create([
            'id' => 16,
            'name' => 'Langues',
            'name_en' => 'Languages',
            'name_nl' => 'Talen',
            'profil' => 'translating.svg',
            'alt' => 'icone représentant le métier d\'apprentissage de langues',
            'alt_en' => 'icon representing the trade of language learning',
            'alt_nl' => 'icoon voor het beroep van taalleerder'
        ]);
        Category::create([
            'id' => 17,
            'name' => 'Services juridiques et judiciaires',
            'name_en' => 'Legal and judicial services',
            'name_nl' => 'Juridische en justitiële diensten',
            'profil' => 'auction.svg',
            'alt' => 'icone représentant le métier judiciaire',
            'alt_en' => 'judicial trade icon',
            'alt_nl' => 'icoon van het gerechtelijk beroep'
        ]);
        Category::create([
            'id' => 18,
            'name' => 'Fabrication et production',
            'name_en' => 'Manufacturing and production',
            'name_nl' => 'Fabricage en productie',
            'profil' => 'production.svg',
            'alt' => 'icone représentant le métier de la fabrication industrielle',
            'alt_en' => 'industrial manufacturing trade icon',
            'alt_nl' => 'icoon voor de industriële verwerkende industrie'
        ]);
        Category::create([
            'id' => 20,
            'name' => 'Imprimerie et édition, marketing et publicité',
            'name_en' => 'Printing and publishing, marketing and advertising',
            'name_nl' => 'Drukkerij en uitgeverij, marketing en reclame',
            'profil' => 'bullhorn.svg',
            'alt' => 'icone représentant le métier de la publicité et marketing',
            'alt_en' => 'icon representing the advertising and marketing profession',
            'alt_nl' => 'icoon van het reclame- en marketingberoep'
        ]);
        Category::create([
            'id' => 21,
            'name' => 'Commerces de détails et services à la clientèle',
            'name_en' => 'Retail and customer service',
            'name_nl' => 'Detailhandel en klantendiensten',
            'profil' => 'customer-service.svg',
            'alt' => 'icone représentant le service clientèle',
            'alt_en' => 'customer service icon',
            'alt_nl' => 'icoon klantenservice'
        ]);
        Category::create([
            'id' => 22,
            'name' => 'Sciences, mathématiques et statistiques',
            'name_en' => 'Science, Mathematics and Statistics',
            'name_nl' => 'Wetenschap, wiskunde en statistiek',
            'profil' => 'analytics.svg',
            'alt' => 'icone représentant des statistiques',
            'alt_en' => 'icon representing statistics',
            'alt_nl' => 'statistiekpictogram'
        ]);
        Category::create([
            'id' => 23,
            'name' => 'Services de sécurité, d\'uniforme et de protection',
            'name_en' => 'Security, Uniform and Protective Services',
            'name_nl' => 'Beveiligings-, uniform- en beschermingsdiensten',
            'profil' => 'security-camera.svg',
            'alt' => 'icone représentant le métier de la sécurité',
            'alt_en' => 'icon representing the security profession',
            'alt_nl' => 'icoon van het beveiligingsberoep'
        ]);
        Category::create([
            'id' => 19,
            'name' => 'Sport et loisirs',
            'name_en' => 'Sport and Recreation',
            'name_nl' => 'Sport en recreatie',
            'profil' => 'sport.svg',
            'alt' => 'icone représentant le métier de sport',
            'alt_en' => 'icon representing the sport profession',
            'alt_nl' => 'icoon van het sportberoep'
        ]);
        Category::create([
            'id' => 24,
            'name' => 'Transport, distribution et logistique',
            'name_en' => 'Transportation, distribution and logistics',
            'name_nl' => 'Vervoer, distributie en logistiek',
            'profil' => 'truck.svg',
            'alt' => 'icone représentant le métier de distribution',
            'alt_en' => 'icon representing the distribution profession',
            'alt_nl' => 'icoon van het distributieberoep'
        ]);
    }
}
