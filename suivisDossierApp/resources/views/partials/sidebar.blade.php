 <div id="sidebar" class='active'>
     <div class="sidebar-wrapper active">
         <div class="sidebar-header">
             <img src="{{ asset('admin/assets/images/logo.svg') }}" alt="" srcset="">
         </div>
         <div class="sidebar-menu">
             <ul class="menu">


                 <li class='sidebar-title'>Menu principal</li>
                 <li class="sidebar-item active ">
                     <a href="{{ route('dashboard') }}" class='sidebar-link'>
                         <i data-feather="home" width="20"></i>
                         <span>Tableau de bord</span>
                     </a>
                 </li>
                 <!-- GESTION DES DOSSIERS -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="folder" width="20"></i>
                         <span>Gestion des Dossiers</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="{{ route('dossiers.create') }}">Nouveau dossier</a>
                         </li>

                         <li>
                             <a href="{{ route('dossiers.index') }}">Liste des dossiers</a>
                         </li>

                     </ul>

                 </li>

                 <!-- GESTION DES VERSIONS -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="git-branch" width="20"></i>
                         <span>Gestion des Versions</span>
                     </a>

                     <ul class="submenu ">
                         <li>
                             <a href="{{ route('type_versions.create') }}">Nouveau type de version</a>
                         </li>
                         <li>
                             <a href="{{ route('type_versions.index') }}">Liste des types de versions</a>
                         </li>

                     </ul>

                 </li>

                 <!-- GESTION DES AUTORITES -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="briefcase" width="20"></i>
                         <span>Autorités Contractantes</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="{{ route('autorites.create') }}">Nouvelle autorité</a>
                         </li>

                         <li>
                             <a href="{{ route('autorites.index') }}">Liste des autorités</a>
                         </li>

                     </ul>

                 </li>

                 <!-- GESTION DES NATURES -->
                 <li class="sidebar-item has-sub">

                     <a href="{{ route('natures.index') }}" class='sidebar-link'>
                         <i data-feather="layers" width="20"></i>
                         <span>Nature des Dossiers</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="{{ route('natures.create') }}">Nouvelle nature</a>
                         </li>

                         <li>
                             <a href="{{ route('natures.index') }}">Liste des natures</a>
                         </li>

                     </ul>

                 </li>

                 <!-- GESTION DES INSTRUCTIONS -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="file-text" width="20"></i>
                         <span>Instructions DN</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="{{ route('instructions.create') }}">Nouvelle instruction</a>
                         </li>

                         <li>
                             <a href="{{ route('instructions.index') }}">Liste des instructions</a>
                         </li>

                     </ul>

                 </li>

                 <!-- GESTION DU PERSONNEL -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="users" width="20"></i>
                         <span>Gestion du Personnel</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="{{ route('personnels.create') }}">Nouveau personnel</a>
                         </li>

                         <li>
                             <a href="{{ route('personnels.index') }}">Liste du personnel</a>
                         </li>

                         <li>
                             <a href="{{ route('fonctions.index') }}">Liste des fonctions</a>
                         </li>

                         <li>
                             <a href="{{ route('fonctions.create') }}">Nouvelle fonction</a>
                         </li>

                     </ul>

                 </li>

                 <!-- GESTION DES ENTITES -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="grid" width="20"></i>
                         <span>Gestion des Entités</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="{{ route('entites.create') }}">Nouvelle entité</a>
                         </li>

                         <li>
                             <a href="{{ route('entites.index') }}">Liste des entités</a>
                         </li>

                     </ul>

                 </li>

                 <!-- GESTION DES ANO -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="check-circle" width="20"></i>
                         <span>Gestion des ANO</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="{{ route('anos.create') }}">Nouvel ANO</a>
                         </li>

                         <li>
                             <a href="{{ route('anos.index') }}">Liste des ANO</a>
                         </li>

                     </ul>

                 </li>

                 <!-- SUIVI ET RAPPORTS -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="bar-chart-2" width="20"></i>
                         <span>Rapports & Suivis</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="#">Dossiers en retard</a>
                         </li>

                         <li>
                             <a href="#">Statistiques</a>
                         </li>

                         <li>
                             <a href="#">Temps de traitement</a>
                         </li>

                     </ul>

                 </li>

                 <!-- LOGS -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="activity" width="20"></i>
                         <span>Historique & Logs</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="#">Journal des actions</a>
                         </li>

                         <li>
                             <a href="#">Activités utilisateurs</a>
                         </li>

                     </ul>

                 </li>

                 <!-- PARAMETRES -->
                 <li class="sidebar-item has-sub">

                     <a href="#" class='sidebar-link'>
                         <i data-feather="settings" width="20"></i>
                         <span>Paramètres</span>
                     </a>

                     <ul class="submenu ">

                         <li>
                             <a href="#">Gestion des rôles</a>
                         </li>

                         <li>
                             <a href="#">Configuration système</a>
                         </li>

                     </ul>

                 </li>

             </ul>
         </div>
         <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
     </div>
 </div>