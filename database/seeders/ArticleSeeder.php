<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // Supprime les anciens articles pour éviter les doublons
        Article::truncate();

        // Articles pour la page d'accueil (3 articles)
        Article::create([
            'title' => 'Bien préparer votre consultation médicale',
            'auteur' => 'Dr. Martin Dubois',
            'excerpt' => 'Checklist pratique : vos symptômes, traitements en cours et objectifs de la visite pour optimiser votre consultation.',
            'content' => 'Une consultation médicale bien préparée permet un diagnostic plus précis et un meilleur suivi. Voici les étapes importantes à suivre pour optimiser votre rendez-vous médical.

<h3>Avant la consultation</h3>
<ul>
<li>Listez vos symptômes avec leur date d\'apparition</li>
<li>Rassemblez vos dernières analyses et ordonnances</li>
<li>Préparez vos questions prioritaires</li>
<li>Apportez votre carnet de santé</li>
</ul>

<h3>Pendant la consultation</h3>
<p>N\'hésitez pas à poser des questions et à demander des clarifications. Votre médecin est là pour vous expliquer votre état de santé de manière compréhensible.</p>',
            'image' => '1.png',
            'image_couverture' => 'banierre.png',
            'meta_description' => 'Guide pratique pour bien préparer votre consultation médicale et optimiser votre suivi de santé.',
            'published' => true,
            'afficher_accueil' => true,
            'ordre_affichage' => 1,
            'date_publication' => Carbon::now()->subDays(5)
        ]);

        Article::create([
            'title' => 'Comprendre vos analyses sanguines',
            'auteur' => 'Dr. Sophie Laurent',
            'excerpt' => 'Guide d\'interprétation des principaux paramètres : hémogramme, bilan lipidique, glycémie et marqueurs inflammatoires.',
            'content' => 'Les analyses sanguines sont un outil essentiel pour surveiller votre santé. Découvrez comment interpréter les résultats les plus courants.

<h3>L\'hémogramme complet</h3>
<p>Cet examen analyse vos globules rouges, globules blancs et plaquettes. Il permet de détecter anémies, infections ou troubles de la coagulation.</p>

<h3>Le bilan lipidique</h3>
<ul>
<li><strong>Cholestérol total :</strong> doit être inférieur à 2g/L</li>
<li><strong>HDL (bon cholestérol) :</strong> supérieur à 0,4g/L</li>
<li><strong>LDL (mauvais cholestérol) :</strong> inférieur à 1,6g/L</li>
</ul>',
            'image' => '2.jpg',
            'image_couverture' => 'banierre.png',
            'meta_description' => 'Apprenez à interpréter vos analyses sanguines : hémogramme, cholestérol, glycémie.',
            'published' => true,
            'afficher_accueil' => true,
            'ordre_affichage' => 2,
            'date_publication' => Carbon::now()->subDays(3)
        ]);

        Article::create([
            'title' => 'Prévenir les maladies cardiovasculaires',
            'auteur' => 'Dr. Jean-Pierre Moreau',
            'excerpt' => 'Les bonnes pratiques pour réduire les risques : alimentation équilibrée, activité physique régulière et gestion du stress.',
            'content' => 'Les maladies cardiovasculaires sont la première cause de mortalité dans le monde. Voici comment adopter un mode de vie protecteur.

<h3>Alimentation et cœur</h3>
<ul>
<li>Privilégiez les fruits et légumes (5 portions/jour)</li>
<li>Consommez des poissons gras 2 fois par semaine</li>
<li>Limitez les graisses saturées et le sel</li>
</ul>

<h3>L\'activité physique</h3>
<p>30 minutes d\'activité modérée par jour réduisent significativement les risques cardiovasculaires.</p>',
            'image' => '3.jpg',
            'image_couverture' => 'banierre.png',
            'meta_description' => 'Guide de prévention des maladies cardiovasculaires : alimentation, sport, gestion du stress.',
            'published' => true,
            'afficher_accueil' => true,
            'ordre_affichage' => 3,
            'date_publication' => Carbon::now()->subDays(1)
        ]);

        // Articles pour la page "Articles" uniquement (3 articles supplémentaires)
        Article::create([
            'title' => 'Vaccination : calendrier et recommandations',
            'auteur' => 'Dr. Marie Leroy',
            'excerpt' => 'Calendrier vaccinal français, rappels nécessaires et vaccinations recommandées selon l\'âge et les situations.',
            'content' => 'La vaccination est l\'un des moyens les plus efficaces de prévenir les maladies infectieuses. Découvrez les recommandations actuelles.

<h3>Vaccinations obligatoires</h3>
<p>Depuis 2018, 11 vaccins sont obligatoires pour les enfants nés après le 1er janvier 2018.</p>

<h3>Rappels à l\'âge adulte</h3>
<ul>
<li><strong>DTP :</strong> rappel tous les 20 ans jusqu\'à 65 ans, puis tous les 10 ans</li>
<li><strong>Grippe :</strong> annuelle après 65 ans</li>
</ul>',
            'image' => '4 -blog.jpg',
            'image_couverture' => 'banierre.png',
            'meta_description' => 'Guide complet sur la vaccination : calendrier, rappels, vaccins de voyage.',
            'published' => true,
            'afficher_accueil' => false,
            'ordre_affichage' => 0,
            'date_publication' => Carbon::now()->subWeeks(2)
        ]);

        Article::create([
            'title' => 'Troubles du sommeil : causes et solutions',
            'auteur' => 'Dr. Pierre Durand',
            'excerpt' => 'Insomnies, apnées, réveils fréquents : identifier les troubles du sommeil et adopter les bonnes habitudes pour mieux dormir.',
            'content' => 'Un sommeil de qualité est essentiel pour la santé. Découvrez comment identifier et traiter les troubles du sommeil les plus courants.

<h3>Les différents troubles</h3>
<ul>
<li><strong>Insomnie :</strong> difficulté d\'endormissement ou réveils précoces</li>
<li><strong>Apnée du sommeil :</strong> arrêts respiratoires durant le sommeil</li>
</ul>

<h3>Hygiène du sommeil</h3>
<p>Respectez des horaires réguliers, évitez les écrans avant le coucher, maintenez une température fraîche dans la chambre.</p>',
            'image' => '5- blog.jpg',
            'image_couverture' => 'banierre.png',
            'meta_description' => 'Troubles du sommeil : causes, symptômes et solutions pour retrouver un sommeil réparateur.',
            'published' => true,
            'afficher_accueil' => false,
            'ordre_affichage' => 0,
            'date_publication' => Carbon::now()->subWeeks(1)
        ]);

        Article::create([
            'title' => 'Alimentation et santé : les bases d\'une nutrition équilibrée',
            'auteur' => 'Dr. Claire Bertrand',
            'excerpt' => 'Principes fondamentaux d\'une alimentation saine : groupes alimentaires, portions recommandées et erreurs à éviter.',
            'content' => 'Une alimentation équilibrée est la base d\'une bonne santé. Voici les principes fondamentaux à connaître pour bien nourrir votre corps.

<h3>Les 7 groupes alimentaires</h3>
<ul>
<li>Céréales et féculents (énergie)</li>
<li>Fruits et légumes (vitamines, fibres)</li>
<li>Viandes, poissons, œufs (protéines)</li>
<li>Produits laitiers (calcium)</li>
</ul>

<h3>Rythme des repas</h3>
<p>Trois repas principaux et une collation si nécessaire. Ne sautez pas le petit-déjeuner.</p>',
            'image' => '6- blog.jpg',
            'image_couverture' => 'banierre.png',
            'meta_description' => 'Guide nutrition : principes d\'une alimentation équilibrée pour préserver votre santé.',
            'published' => true,
            'afficher_accueil' => false,
            'ordre_affichage' => 0,
            'date_publication' => Carbon::now()->subDays(10)
        ]);

        $this->command->info('6 articles créés avec succès : 3 pour l\'accueil + 3 pour la page articles');
    }
}