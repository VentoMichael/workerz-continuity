<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="Workerz - l'indépendant à quelques clics">
    <meta name="description"
          content="Workerz.be est la plateforme qui vous aide à trouver des professionnels fiables et compétentes pour vos projets quel qu'il soit"/>
    <meta name="keywords" content="Vins, fromages, marché, exposants, billets">
    <meta name="language" content="French">
    <meta name="author" content="Vento Michael">
    <meta name="copyright" content="Workerz">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="general">
    <meta name="author" content="Vento Michael"/>
    <title>
        {{ 'Workerz' }}{{ Request::is('/') ? " | Accueil" : "" }}
        {{ Request::is('login') ? ' | Connexion' : "" }}
        {{ Request::is('register') || Request::is('register/*')? ' | S\'enregistrer' : "" }}
        {{ Request::is('forgot-password') || Request::is('reset-password/*') ?' | Mot de passe oublié' : "" }}
        {{ Request::is('email/verify') || Request::is('email/verify/*') ?' | Vérification d\'email' : "" }}
        {{ Request::is('contact') ? ' | Contact' : "" }}
        {{ Request::is('about') ? ' | À propos de nous' : "" }}
        {{ Request::is('policy') ? ' | Politique de confidentialité' : "" }}
        {{ Request::is('conditions') ? ' | Conditions d’utilisations' : "" }}
        {{ Request::is('announcements') || Request::is('announcements/*')  || Request::is('announcement/*')  ? ' | Annonces' : "" }}
        {{ Request::is('workers') || Request::is('workers/*') ? ' | Travailleurs' : "" }}
        {{ Request::is('dashboard') || Request::is('dashboard/*') ? ' | Tableau de bord' : "" }}
    </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
</head>
<body>
<div class="containerBtnAddAnnouncment">
    <a href="{{route('announcements.plans')}}" class="btnAddAnnouncement" title="Ajouter une annonce"
       aria-label="Ajouter une annonce"></a>
</div>
<header>
    <h1 aria-level="1" class="hidden">
        Bienvenu sur la page {{ Request::is('/') ? "accueil" : "" }}
        {{ Request::is('login') ? 'connexion' : "" }}
        {{ Request::is('register') || Request::is('register/*') ? 's\'enregistrer' : "" }}
        {{ Request::is('forgot-password') || Request::is('reset-password/*') ? 'mot de passe oublié' : "" }}
        {{ Request::is('email/verify') || Request::is('email/verify/*') ? 'vérification d\'email' : "" }}
        {{ Request::is('contact') ? 'contact' : "" }}
        {{ Request::is('about') ? 'à propos de nous' : "" }}
        {{ Request::is('policy') ? 'politique de confidentialité' : "" }}
        {{ Request::is('conditions') ? 'conditions d’utilisations' : "" }}
        {{ Request::is('announcements') || Request::is('announcements/*')  || Request::is('announcement/*')  ? 'annonces' : "" }}
        {{ Request::is('workers') || Request::is('workers/*') ? 'travailleurs' : "" }} de Workerz
    </h1>
    <div class="container-menu">
        <nav class="navbar navbarId" id="navbar">
            <h2 aria-level="2" class="hidden">Navigation Principale
            </h2>
            <div class="logo-mobile">
                <a href="{{ url('/') }}">
                    <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 162.5 33.2"
                         style="enable-background:new 0 0 162.5 33.2;" xml:space="preserve" width="162.5"
                         height="33.20000076293945">
<style type="text/css">
    .st0 {
        fill: #FE9F24;
        stroke: #FE9F24;
    }

    .st1 {
        fill: #FFFFFF;
    }

    .st2 {
        fill: #FE9F24;
        stroke: #FE9F24;
        stroke-width: 0.2;
    }

    .st3 {
        fill: #3DB8F4;
        stroke: #4BB5E8;
        stroke-width: 0.5;
        stroke-miterlimit: 10;
    }
</style>
                        <title>logo</title>
                        <path id="Path_4_" class="st0 svg-elem-1" d="M50.7,4.5c-5.2,0-9.6,4.2-9.6,9.5c0,3.5,1.8,6.5,4.5,8.2l0,0l-4.4,9.1c-0.1,0.1,0,0.3,0.1,0.4
	l1.4,0.7c0.1,0.1,0.3,0,0.4-0.1l4.4-9.1l0,0c0.9,0.3,1.9,0.5,3,0.5c5.2,0,9.5-3.5,9.5-9.6C60.1,8.8,55.9,4.5,50.7,4.5z"></path>
                        <circle id="Oval" class="st1 svg-elem-2" cx="50.6" cy="14" r="7.5"></circle>
                        <path id="Path_5_" class="st2 svg-elem-3" d="M48.9,8c0,0,0.1,0.1,0.1,0.2l-0.9,7.1c0,0.1,0,0.3,0.1,0.4l1.9,3.8h0.1l1.8-3.8
	c0.1-0.1,0.1-0.3,0.1-0.4l-1-7.1c0-0.1,0-0.1,0.1-0.2l1-1.4h-0.1c-1.4-0.2-2.5-0.2-3.9,0.1L48.9,8z"></path>
                        <g>
                            <path class="st3 svg-elem-4" d="M21.5,7.1c0.4,1.5,0.9,3,1.4,4.6s1,3.2,1.5,4.8c0.5,1.6,1.1,3.2,1.6,4.8c0.5,1.6,1.1,3,1.5,4.4
		c0.4-1.5,0.8-3.1,1.2-4.9c0.4-1.7,0.8-3.6,1.2-5.5c0.4-1.9,0.8-3.8,1.1-5.8c0.4-2,0.7-3.9,1.1-5.8h5.4c-1,5.2-2,10.2-3.2,14.9
		c-1.2,4.8-2.5,9.3-4,13.7h-5c-2.1-5.6-4.2-11.6-6.2-18.2c-1,3.3-2.1,6.5-3.1,9.5c-1,3-2.1,5.9-3.1,8.7h-5c-1.5-4.4-2.8-8.9-4-13.7
		C2.7,14,1.7,9,0.7,3.8h5.6C6.6,5.7,7,7.6,7.4,9.6c0.4,2,0.8,3.9,1.2,5.8c0.4,1.9,0.8,3.7,1.2,5.5s0.8,3.4,1.2,4.9
		c0.5-1.4,1.1-2.9,1.6-4.4s1.1-3.1,1.6-4.8c0.5-1.6,1-3.2,1.5-4.8c0.5-1.6,0.9-3.1,1.3-4.6H21.5z"></path>
                            <path class="st3 svg-elem-5" d="M79,15.4c-0.4-0.1-1-0.3-1.7-0.4c-0.7-0.2-1.6-0.2-2.5-0.2c-0.6,0-1.1,0.1-1.8,0.2c-0.6,0.1-1.1,0.2-1.3,0.3
		v17.3h-5V11.9c1-0.4,2.2-0.7,3.6-1c1.4-0.3,3-0.5,4.8-0.5c0.3,0,0.7,0,1.2,0.1c0.4,0,0.9,0.1,1.3,0.2c0.4,0.1,0.9,0.2,1.3,0.2
		c0.4,0.1,0.7,0.2,1,0.3L79,15.4z"></path>
                            <path class="st3 svg-elem-6" d="M88.3,19.3c0.6-0.7,1.3-1.4,2-2.1c0.7-0.8,1.4-1.5,2.1-2.3c0.7-0.8,1.3-1.5,2-2.2c0.6-0.7,1.1-1.3,1.6-1.8h5.9
		c-1.4,1.5-2.8,3.1-4.3,4.8s-3.1,3.3-4.6,4.8c0.8,0.7,1.7,1.5,2.6,2.5c0.9,1,1.8,2,2.6,3.1c0.9,1.1,1.6,2.2,2.4,3.3s1.4,2.1,1.9,3.1
		h-5.8c-0.5-0.9-1.1-1.7-1.7-2.7c-0.6-0.9-1.3-1.8-2.1-2.7c-0.7-0.9-1.5-1.7-2.3-2.5c-0.8-0.8-1.5-1.5-2.3-2v9.9h-5V1.2l5-0.8V19.3z
		"></path>
                            <path class="st3 svg-elem-7" d="M103.9,21.8c0-1.9,0.3-3.6,0.8-5c0.6-1.4,1.3-2.6,2.3-3.6c0.9-0.9,2-1.7,3.2-2.1c1.2-0.5,2.5-0.7,3.7-0.7
		c3,0,5.3,0.9,7,2.8c1.7,1.8,2.5,4.6,2.5,8.3c0,0.3,0,0.6,0,0.9c0,0.3,0,0.7-0.1,0.9h-14.3c0.1,1.7,0.8,3.1,1.8,4s2.7,1.4,4.7,1.4
		c1.2,0,2.3-0.1,3.3-0.3c1-0.2,1.8-0.5,2.4-0.7l0.7,4.1c-0.3,0.1-0.7,0.3-1.1,0.4c-0.5,0.2-1,0.3-1.7,0.4s-1.3,0.2-2,0.3
		c-0.7,0.1-1.4,0.1-2.2,0.1c-1.9,0-3.6-0.3-5-0.8c-1.4-0.6-2.6-1.3-3.5-2.4c-0.9-1-1.6-2.2-2-3.6S103.9,23.4,103.9,21.8z
		 M118.4,19.5c0-0.7-0.1-1.3-0.3-2c-0.2-0.6-0.5-1.2-0.8-1.6c-0.4-0.5-0.8-0.8-1.4-1.1s-1.2-0.4-1.9-0.4c-0.8,0-1.4,0.1-2,0.4
		c-0.6,0.3-1.1,0.7-1.5,1.1c-0.4,0.5-0.7,1-0.9,1.6c-0.2,0.6-0.4,1.2-0.5,1.9H118.4z"></path>
                            <path class="st3 svg-elem-8" d="M141,15.4c-0.4-0.1-1-0.3-1.7-0.4c-0.7-0.2-1.6-0.2-2.5-0.2c-0.6,0-1.1,0.1-1.8,0.2c-0.6,0.1-1.1,0.2-1.3,0.3
		v17.3h-5V11.9c1-0.4,2.2-0.7,3.6-1c1.4-0.3,3-0.5,4.8-0.5c0.3,0,0.7,0,1.2,0.1c0.4,0,0.9,0.1,1.3,0.2c0.4,0.1,0.9,0.2,1.3,0.2
		c0.4,0.1,0.7,0.2,1,0.3L141,15.4z"></path>
                            <path class="st3 svg-elem-9" d="M160.5,14.4c-0.6,0.6-1.3,1.4-2.2,2.4c-0.9,1-1.9,2.2-2.9,3.5c-1,1.3-2,2.6-3.1,4s-2,2.7-2.8,4h11.2v4.2h-17.2
		v-3.1c0.6-1.1,1.4-2.3,2.3-3.6c0.9-1.3,1.8-2.6,2.8-3.9c1-1.3,1.9-2.6,2.9-3.7c1-1.2,1.8-2.2,2.5-3.1h-10v-4.2h16.4V14.4z"></path>
                        </g>
</svg>
                </a>
            </div>
            <input type="checkbox" id="nav" class="notVisible nav"/>
            <label for="nav" class="nav-open nav-label-open">Ouvrir le menu<i></i><i></i><i></i></label>
            <div class="nav-container">
                <ul class="nav-container-ul">
                    <li>
                        <ul class="container-list-menu">
                            <li class="logo">
                                <a href="{{ url('/') }}">
                                    <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 162.5 33.2" style="enable-background:new 0 0 162.5 33.2;"
                                         xml:space="preserve" width="162.5" height="33.20000076293945">
<style type="text/css">
    .st0 {
        fill: #FE9F24;
        stroke: #FE9F24;
    }

    .st1 {
        fill: #FFFFFF;
    }

    .st2 {
        fill: #FE9F24;
        stroke: #FE9F24;
        stroke-width: 0.2;
    }

    .st3 {
        fill: #3DB8F4;
        stroke: #4BB5E8;
        stroke-width: 0.5;
        stroke-miterlimit: 10;
    }
</style>
                                        <title>logo</title>
                                        <path id="Path_4_" class="st0 svg-elem-1" d="M50.7,4.5c-5.2,0-9.6,4.2-9.6,9.5c0,3.5,1.8,6.5,4.5,8.2l0,0l-4.4,9.1c-0.1,0.1,0,0.3,0.1,0.4
	l1.4,0.7c0.1,0.1,0.3,0,0.4-0.1l4.4-9.1l0,0c0.9,0.3,1.9,0.5,3,0.5c5.2,0,9.5-3.5,9.5-9.6C60.1,8.8,55.9,4.5,50.7,4.5z"></path>
                                        <circle id="Oval" class="st1 svg-elem-2" cx="50.6" cy="14" r="7.5"></circle>
                                        <path id="Path_5_" class="st2 svg-elem-3" d="M48.9,8c0,0,0.1,0.1,0.1,0.2l-0.9,7.1c0,0.1,0,0.3,0.1,0.4l1.9,3.8h0.1l1.8-3.8
	c0.1-0.1,0.1-0.3,0.1-0.4l-1-7.1c0-0.1,0-0.1,0.1-0.2l1-1.4h-0.1c-1.4-0.2-2.5-0.2-3.9,0.1L48.9,8z"></path>
                                        <g>
                                            <path class="st3 svg-elem-4" d="M21.5,7.1c0.4,1.5,0.9,3,1.4,4.6s1,3.2,1.5,4.8c0.5,1.6,1.1,3.2,1.6,4.8c0.5,1.6,1.1,3,1.5,4.4
		c0.4-1.5,0.8-3.1,1.2-4.9c0.4-1.7,0.8-3.6,1.2-5.5c0.4-1.9,0.8-3.8,1.1-5.8c0.4-2,0.7-3.9,1.1-5.8h5.4c-1,5.2-2,10.2-3.2,14.9
		c-1.2,4.8-2.5,9.3-4,13.7h-5c-2.1-5.6-4.2-11.6-6.2-18.2c-1,3.3-2.1,6.5-3.1,9.5c-1,3-2.1,5.9-3.1,8.7h-5c-1.5-4.4-2.8-8.9-4-13.7
		C2.7,14,1.7,9,0.7,3.8h5.6C6.6,5.7,7,7.6,7.4,9.6c0.4,2,0.8,3.9,1.2,5.8c0.4,1.9,0.8,3.7,1.2,5.5s0.8,3.4,1.2,4.9
		c0.5-1.4,1.1-2.9,1.6-4.4s1.1-3.1,1.6-4.8c0.5-1.6,1-3.2,1.5-4.8c0.5-1.6,0.9-3.1,1.3-4.6H21.5z"></path>
                                            <path class="st3 svg-elem-5" d="M79,15.4c-0.4-0.1-1-0.3-1.7-0.4c-0.7-0.2-1.6-0.2-2.5-0.2c-0.6,0-1.1,0.1-1.8,0.2c-0.6,0.1-1.1,0.2-1.3,0.3
		v17.3h-5V11.9c1-0.4,2.2-0.7,3.6-1c1.4-0.3,3-0.5,4.8-0.5c0.3,0,0.7,0,1.2,0.1c0.4,0,0.9,0.1,1.3,0.2c0.4,0.1,0.9,0.2,1.3,0.2
		c0.4,0.1,0.7,0.2,1,0.3L79,15.4z"></path>
                                            <path class="st3 svg-elem-6" d="M88.3,19.3c0.6-0.7,1.3-1.4,2-2.1c0.7-0.8,1.4-1.5,2.1-2.3c0.7-0.8,1.3-1.5,2-2.2c0.6-0.7,1.1-1.3,1.6-1.8h5.9
		c-1.4,1.5-2.8,3.1-4.3,4.8s-3.1,3.3-4.6,4.8c0.8,0.7,1.7,1.5,2.6,2.5c0.9,1,1.8,2,2.6,3.1c0.9,1.1,1.6,2.2,2.4,3.3s1.4,2.1,1.9,3.1
		h-5.8c-0.5-0.9-1.1-1.7-1.7-2.7c-0.6-0.9-1.3-1.8-2.1-2.7c-0.7-0.9-1.5-1.7-2.3-2.5c-0.8-0.8-1.5-1.5-2.3-2v9.9h-5V1.2l5-0.8V19.3z
		"></path>
                                            <path class="st3 svg-elem-7" d="M103.9,21.8c0-1.9,0.3-3.6,0.8-5c0.6-1.4,1.3-2.6,2.3-3.6c0.9-0.9,2-1.7,3.2-2.1c1.2-0.5,2.5-0.7,3.7-0.7
		c3,0,5.3,0.9,7,2.8c1.7,1.8,2.5,4.6,2.5,8.3c0,0.3,0,0.6,0,0.9c0,0.3,0,0.7-0.1,0.9h-14.3c0.1,1.7,0.8,3.1,1.8,4s2.7,1.4,4.7,1.4
		c1.2,0,2.3-0.1,3.3-0.3c1-0.2,1.8-0.5,2.4-0.7l0.7,4.1c-0.3,0.1-0.7,0.3-1.1,0.4c-0.5,0.2-1,0.3-1.7,0.4s-1.3,0.2-2,0.3
		c-0.7,0.1-1.4,0.1-2.2,0.1c-1.9,0-3.6-0.3-5-0.8c-1.4-0.6-2.6-1.3-3.5-2.4c-0.9-1-1.6-2.2-2-3.6S103.9,23.4,103.9,21.8z
		 M118.4,19.5c0-0.7-0.1-1.3-0.3-2c-0.2-0.6-0.5-1.2-0.8-1.6c-0.4-0.5-0.8-0.8-1.4-1.1s-1.2-0.4-1.9-0.4c-0.8,0-1.4,0.1-2,0.4
		c-0.6,0.3-1.1,0.7-1.5,1.1c-0.4,0.5-0.7,1-0.9,1.6c-0.2,0.6-0.4,1.2-0.5,1.9H118.4z"></path>
                                            <path class="st3 svg-elem-8" d="M141,15.4c-0.4-0.1-1-0.3-1.7-0.4c-0.7-0.2-1.6-0.2-2.5-0.2c-0.6,0-1.1,0.1-1.8,0.2c-0.6,0.1-1.1,0.2-1.3,0.3
		v17.3h-5V11.9c1-0.4,2.2-0.7,3.6-1c1.4-0.3,3-0.5,4.8-0.5c0.3,0,0.7,0,1.2,0.1c0.4,0,0.9,0.1,1.3,0.2c0.4,0.1,0.9,0.2,1.3,0.2
		c0.4,0.1,0.7,0.2,1,0.3L141,15.4z"></path>
                                            <path class="st3 svg-elem-9" d="M160.5,14.4c-0.6,0.6-1.3,1.4-2.2,2.4c-0.9,1-1.9,2.2-2.9,3.5c-1,1.3-2,2.6-3.1,4s-2,2.7-2.8,4h11.2v4.2h-17.2
		v-3.1c0.6-1.1,1.4-2.3,2.3-3.6c0.9-1.3,1.8-2.6,2.8-3.9c1-1.3,1.9-2.6,2.9-3.7c1-1.2,1.8-2.2,2.5-3.1h-10v-4.2h16.4V14.4z"></path>
                                        </g>
</svg>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul class="container-list-menu container-list-menu-principal">
                            <li><a
                                    class="{{ Request::is('/') ? "current_page_item" : "" }}"
                                    {{ Request::is('/') ? "aria-current='page'" : "" }}
                                    href="{{ url('/') }}">Accueil</a>
                            </li>
                            <li>
                                <a class="{{ Request::is('workers') || Request::is('workers/*') ? "current_page_item" : "" }}"
                                   {{ Request::is('workers') || Request::is('workers/*') ? "aria-current='page'" : "" }} href="{{route('workers')}}">Travailleurs</a>
                            </li>
                            <li>
                                <a class="{{ Request::is('announcements') || Request::is('announcements/*') ? "current_page_item" : "" }}"
                                   {{ Request::is('announcements') || Request::is('announcements/*') ? "aria-current='page'" : "" }} href="{{route('announcements')}}">Annonces</a>
                            </li>
                        </ul>
                    </li>
                    @if(!Auth::check())
                        <li>
                            <ul class="container-list-menu">
                                <li class="connected-item-container {{ Request::is('login') ? "current_page_item" : "" }}" {{ Request::is('login') ? "aria-current='page'" : "" }}>
                                    <a class="connected-item"
                                       href="{{ route('login') }}">Se connecter</a>
                                </li>
                                <li class="last-menu-item inscription-item" {{ Request::is('register') ? "aria-current='page'" : "" }}>
                                    <a
                                        href="{{ route('users.plans') }}">S'inscrire</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <ul class="container-list-menu">
                                <li>
                                    <form aria-label="Déconnexion" role="form" id="logout-form"
                                          action="{{route('logout')}}" method="POST"> @csrf
                                        <button type="submit" role="button" class="deconnexionBtn">
                                            Se déconnecter
                                        </button>
                                    </form>
                                </li>
                                <li class="last-menu-item profil-item"
                                    {{ Request::is('dashboard') ? "aria-current='page'" : "" }}>
                                    <a class="@if(auth()->user()->picture != null) picto-img-user @endif profil-user @if(auth()->user()->picture != null) picto-profil-user @endif"
                                       href="{{route('dashboard')}}">
                                        @if(auth()->user()->picture != null)
                                            <img class="picto-user picto-last" width="25" height="32"
                                                 src="{{asset(auth()->user()->picture)}}"
                                                 alt="image de profil de {{auth()->user()->name}}">
                                        @else
                                            <img class="picto-user" width="25" height="32"
                                                 src="{{asset('svg/user-w.svg')}}"
                                                 alt="image de profil par défaut">
                                        @endif
                                        Dashboard</a>
                                    @if(auth()->user())
                                        @if(count($notificationsReaded) > 9 && count($notificationsReaded) > 0)

                                            <a class="counter-read-message" href="{{route('dashboard.notifications')}}">
                                                9+
                                            </a>

                                        @else
                                            @if(count($notificationsReaded))
                                                <a href="{{route('dashboard.notifications')}}"
                                                   class="counter-read-message">
                                                    {{count($notificationsReaded)}}
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </li>
                                <li class="nav-dashboard notVisible">
                                    <ul>
                                        <li {{ Request::is('dashboard/profil') | Request::is('dashboard/profil/*') ? "aria-current='page'" : "" }}>
                                            <a href="{{route('dashboard.profil')}}">Mon profil</a></li>
                                        <li {{ Request::is('dashboard/ads') | Request::is('dashboard/ads/*') ? "aria-current='page'" : "" }}>
                                            <a href="{{route('dashboard.ads')}}">Mes annonces</a></li>
                                        <li {{ Request::is('dashboard/message') | Request::is('dashboard/message/*') ? "aria-current='page'" : "" }}>
                                            <a href="{{route('dashboard.messages')}}">Mes messages</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>
<main class="content">
    <img class="img-cover hideForNewsletter" src="{{asset('svg/background.svg')}}" alt="photo de couverture">
    @yield('content')
</main>
<footer class="footer">
    <h2 aria-level="2" class="hidden">
        Informations du pied de page
    </h2>
    <div class="container-footer">
        <section class="container-secondary-nav">
            <h3 aria-level="3" class="util-links">
                Liens utiles
            </h3>
            <nav>
                <h4 aria-level="4" class="hidden">Navigation secondaire</h4>
                <ul>
                    <li>
                        <a {{ Request::is('contact') || Request::is('contact/*') ? "aria-current='page'" : "" }} href="{{route('contact')}}">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a {{ Request::is('about') || Request::is('about/*') ? "aria-current='page'" : "" }} href="{{route('about')}}">
                            À propos
                        </a></li>
                    <li>
                        <a {{ Request::is('policy')? "aria-current='page'" : "" }} href="{{route('policy')}}">
                            Politique de confidentialité
                        </a></li>
                    <li>
                        <a {{ Request::is('conditions') ? "aria-current='page'" : "" }} href="{{route('conditions')}}">
                            Conditions d’utilisations
                        </a></li>
                </ul>
            </nav>
        </section>
        <section class="newsletter" id="newsletterSection">
            <h3 aria-level="3" class="util-links">
                Abonnez vous à notre newsletter
            </h3>
            <form action="{{route('newsletter.store')}}#newsletterSection" method="POST"
                  class="form-newsletter-container" title="Inscription à notre newsletter"
                  aria-label="Inscription à notre newsletter">
                @csrf
                <div class="form-newsletter">
                    <label for="newsletter" class="notVisible">Votre mail</label>
                    <input type="email" name="newsletter" id="newsletter" class="input-newsletter"
                           placeholder="Albert01@gmail.com" aria-required="true">
                </div>
                <div>
                    <input type="submit" class="submit-newsletter" value="Envoyé">
                </div>
            </form>
            @error('newsletter')
            <p class="danger">
            <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}"
                                                                      alt="pictogramme d'une croix rouge">
                <p>{{$errors->first('newsletter')}}</p>
                <span class="crossHide" id="crossHide">&times;</span>
            </div>
            </p>
            @enderror
        </section>
    </div>
    <div class="copyright fadeInLeft animated">
        <small>{{date('Y')}} Workerz. Tous droits réservés.</small>
    </div>
    @if (Session::has('successNew'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/good.svg')}}"
                                                                  alt="pictogramme d'un v correct">
            <p>{!!session('successNew')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
    @if (Session::has('failureNew'))
        <div id="successMsg" role="alert" class="successMsg"><img src="{{asset('svg/cross.svg')}}"
                                                                  alt="pictogramme d'une croix rouge">
            <p>{!!session('failureNew')!!}</p>
            <span class="crossHide" id="crossHide">&times;</span>
        </div>
    @endif
</footer>
<script src="{{asset('js/successMsg.js')}}" defer></script>
@yield('scripts')
</body>
</html>