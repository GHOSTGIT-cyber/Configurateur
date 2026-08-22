<?php
/**
 * Template HTML du configurateur Lift - LIFTX
 * v2.1
 */
$img = get_stylesheet_directory_uri() . '/configurator/images/';
?>

<!-- Google Fonts Barlow Condensed + DM Sans -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<div class="lift-configurator" id="liftConfigurator">

    <div class="content-container">

        <!-- COLONNE GAUCHE : Images (sticky) -->
        <div class="left-content">

            <div id="img-modele" class="image-slide visible" data-section="modele">
                <img src="<?php echo $img; ?>modele/2025_LIFTX_43.png" alt="LIFTX 4'3">
                <div class="image-caption">LIFTX 4'3"</div>
            </div>

            <div id="img-hull" class="image-slide" data-section="hull">
                <div class="hull-slider">
                    <div class="slider-container">
                        <img class="slider-image active" data-view="ortho"
                             src="<?php echo $img; ?>hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Ortho_2000x2000.png"
                             alt="Vue dessus">
                        <img class="slider-image" data-view="iso"
                             src="<?php echo $img; ?>hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Package_Iso_Shadow_2000x2000.png"
                             alt="Vue isometrique">
                        <img class="slider-image" data-view="tiltback"
                             src="<?php echo $img; ?>hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Package_TiltBack_Shadow_2000x2000.png"
                             alt="Vue arriere">
                        <img class="slider-image" data-view="tiltfront"
                             src="<?php echo $img; ?>hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Package_TiltFront_Shadow_2000x2000.png"
                             alt="Vue avant">
                    </div>
                    <div class="slider-nav">
                        <button class="slider-dot active" data-view="ortho" title="Vue dessus"></button>
                        <button class="slider-dot" data-view="iso" title="Vue isometrique"></button>
                        <button class="slider-dot" data-view="tiltback" title="Vue arriere"></button>
                        <button class="slider-dot" data-view="tiltfront" title="Vue avant"></button>
                    </div>
                    <button class="slider-arrow slider-prev" aria-label="Image precedente">&lt;</button>
                    <button class="slider-arrow slider-next" aria-label="Image suivante">&gt;</button>
                </div>
                <div class="image-caption">Couleurs</div>
            </div>

            <div id="img-batterie" class="image-slide" data-section="batterie">
<!-- MODIF 2026-07-22 : vraie photo LIFTX Battery (etait battery-liftx.jpg = en fait une GEN5) -->
                <img src="<?php echo $img; ?>batterie/liftx-battery-real.png" alt="LIFTX Battery">
                <div class="image-caption">Batteries</div>
            </div>

            <div id="img-foil" class="image-slide" data-section="foil">
                <img src="<?php echo $img; ?>foil/wing-210-camber.png" alt="Front Wing">
                <div class="image-caption">Front Wings</div>
            </div>

            <div id="img-controller" class="image-slide" data-section="controller">
                <div class="hull-slider">
                    <div class="slider-container">
                        <img class="slider-image active" data-view="ctrl-main" src="<?php echo $img; ?>controller/Controller_standard.png" alt="Bluetooth Controller">
                        <img class="slider-image" data-view="ctrl-angle1" src="<?php echo $img; ?>controller/Angle1_2000x2000_V1.png" alt="Controller - Angle 1">
                        <img class="slider-image" data-view="ctrl-angle2" src="<?php echo $img; ?>controller/Angle2_2000x2000_V1.png" alt="Controller - Angle 2">
                        <img class="slider-image" data-view="ctrl-angle5" src="<?php echo $img; ?>controller/Angle5_2000x2000_V1.png" alt="Controller - Angle 5">
                        <img class="slider-image" data-view="ctrl-box1" src="<?php echo $img; ?>controller/_CP09738.png" alt="Controller - Boîte">
                        <img class="slider-image" data-view="ctrl-box2" src="<?php echo $img; ?>controller/_CP09741.png" alt="Controller - Boîte ouverte">
                    </div>
                    <div class="slider-nav">
                        <button class="slider-dot active" data-view="ctrl-main" title="Vue principale"></button>
                        <button class="slider-dot" data-view="ctrl-angle1" title="Angle 1"></button>
                        <button class="slider-dot" data-view="ctrl-angle2" title="Angle 2"></button>
                        <button class="slider-dot" data-view="ctrl-angle5" title="Angle 5"></button>
                        <button class="slider-dot" data-view="ctrl-box1" title="Boîte"></button>
                        <button class="slider-dot" data-view="ctrl-box2" title="Boîte ouverte"></button>
                    </div>
                    <button class="slider-arrow slider-prev" aria-label="Image precedente">&lt;</button>
                    <button class="slider-arrow slider-next" aria-label="Image suivante">&gt;</button>
                </div>
                <div class="image-caption">Controller</div>
            </div>

            <div id="img-propulsion" class="image-slide" data-section="propulsion">
                <img src="<?php echo $img; ?>mats/2025_32_LCSCarbon55GliderLow_Side_3000x3000.png" alt="32&quot; LCS Carbon 55">
                <div class="image-caption">Mât & Propulsion</div>
            </div>

            <div id="img-accessoires" class="image-slide" data-section="accessoires">
                <img src="<?php echo $img; ?>accessoires/housse_standard.png" alt="Housse Standard">
                <div class="image-caption">Accessoires</div>
            </div>

        </div>

        <!-- COLONNE DROITE : Options (scrollable) -->
        <div class="configurator-options">

            <!-- SECTION 1 : MODELE & TAILLE -->
            <div class="contentMarker" data-marker-content="img-modele">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 1 / 7</span>
                </div>
                <h3 class="section-title">Choisir le modèle & taille</h3>
                <p class="section-subtitle">LIFTX — Next generation eFoil</p>
                <ul class="VerticalList modele-options">
                    <li class="VerticalList__Item selected" data-option-category="modele">
                        <input type="radio" id="modele-lift-x-43" name="modele" value="lift-x-43" data-price="0" checked>
                        <label for="modele-lift-x-43">
                            <div class="option-content">
                                <h5>LIFTX 4'3"</h5>
                                <p>Le plus compact et le plus réactif. Conçu pour les riders experts en quête de sensations pures et de carving serré.</p>
                            </div>
                            <span class="price-diff">Sélectionné</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="modele">
                        <input type="radio" id="modele-lift-x-48" name="modele" value="lift-x-48" data-price="200">
                        <label for="modele-lift-x-48">
                            <div class="option-content">
                                <h5>LIFTX 4'8"</h5>
                                <p>La taille polyvalente par excellence. Parfait équilibre entre maniabilité et confort pour progresser rapidement.</p>
                            </div>
                            <span class="price-diff">+200€</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="modele">
                        <input type="radio" id="modele-lift-x-52" name="modele" value="lift-x-52" data-price="400">
                        <label for="modele-lift-x-52">
                            <div class="option-content">
                                <h5>LIFTX 5'2"</h5>
                                <p>Volume et stabilité pour des sessions longues et accessibles. Le choix idéal pour les débutants et riders intermédiaires.</p>
                            </div>
                            <span class="price-diff">+400€</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 2 : COULEUR -->
            <div class="contentMarker" data-marker-content="img-hull">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 2 / 7</span>
                </div>
                <h3 class="section-title">Couleur</h3>
                <p class="section-subtitle" id="hull-subtitle">Couleurs LIFTX</p>
                <ul class="VerticalList hull-options">
                    <li class="VerticalList__Item selected" data-option-category="hull" data-model="lift-x">
                        <input type="radio" id="hull-off-white" name="hull" value="off-white" data-price="0" checked>
                        <label for="hull-off-white">
                            <div class="option-content">
                                <div class="color-preview" style="background: #F5F5F0; border: 1px solid #ddd;"></div>
                                <h5>Off-White</h5>
                            </div>
                            <span class="price-diff">Sélectionné</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="hull" data-model="lift-x">
                        <input type="radio" id="hull-spark-blue" name="hull" value="spark-blue" data-price="0">
                        <label for="hull-spark-blue">
                            <div class="option-content">
                                <div class="color-preview" style="background: #1a6fc4;"></div>
                                <h5>Spark Blue</h5>
                            </div>
                            <span class="price-diff">Même prix</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="hull" data-model="lift-x">
                        <input type="radio" id="hull-dawn-patrol" name="hull" value="dawn-patrol" data-price="0">
                        <label for="hull-dawn-patrol">
                            <div class="option-content">
                                <div class="color-preview" style="background: #E8734A;"></div>
                                <h5>Dawn Patrol</h5>
                            </div>
                            <span class="price-diff">Même prix</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 3 : BATTERIE -->
            <div class="contentMarker" data-marker-content="img-batterie">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 3 / 7</span>
                </div>
                <h3 class="section-title">Batterie</h3>
                <ul class="VerticalList batterie-options">
                    <li class="VerticalList__Item selected" data-option-category="batterie">
                        <input type="radio" id="batterie-sport" name="batterie" value="sport" data-price="0" checked disabled>
                        <label for="batterie-sport">
                            <div class="option-content">
                                <h5>LIFTX Battery — 0.9 kWh</h5>
                                <p>Batterie LIFTX légère et agile. Jusqu'à 45 minutes plein régime, charge à 80% en 30 minutes. IP68, connexion sans fil. Incluse dans votre pack LIFTX.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 4 : FOIL -->
            <div class="contentMarker" data-marker-content="img-foil">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 4 / 7</span>
                </div>
                <h3 class="section-title">Front Wing & Stab</h3>
                <p class="section-subtitle">Ailes LCS (Lift Connect System) — choisissez votre aile avant et arrière</p>

                <button class="aide-btn" onclick="document.getElementById('aideModalFoil').classList.add('open')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                    Aide pour choisir son aile avant
                </button>

                <!-- Catégorie : LCS Havoc -->
                <div class="wing-category" id="liftx-cat-havoc">
                    <div class="wing-category-header" onclick="toggleWingCategory('liftx-cat-havoc')">
                        <span class="wing-category-label">Havoc LCS</span>
                        <span class="wing-category-desc">Vitesse & agilité — Riders confirmés</span>
                        <div class="wing-category-toggle"></div>
                    </div>
                    <div class="wing-category-body">
                        <ul class="VerticalList foil-options">
                            <li class="VerticalList__Item selected" data-option-category="foil">
                                <input type="radio" id="foil-148-havoc" name="foil" value="148-havoc" data-price="0" checked>
                                <label for="foil-148-havoc">
                                    <div class="option-content">
                                        <h5>148 Havoc LCS</h5>
                                        <p>Aile compacte ultra-réactive pour riders experts. Vitesse maximale et carving serré en eaux agitées.</p>
                                        <div class="option-meta">
                                            <span class="option-tag tag-expert">Expert</span>
                                            <span class="option-tag">148 cm²</span>
                                            <span class="option-tag tag-inclus">Inclus LIFTX</span>
                                        </div>
                                    </div>
                                    <span class="price-diff">Inclus</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="wing-category-divider"></div>

                <!-- Catégorie : Camber Pro LCS -->
                <div class="wing-category collapsed" id="liftx-cat-camber">
                    <div class="wing-category-header" onclick="toggleWingCategory('liftx-cat-camber')">
                        <span class="wing-category-label">Camber Pro LCS</span>
                        <span class="wing-category-desc">Polyvalence & portance — Tous niveaux</span>
                        <div class="wing-category-toggle"></div>
                    </div>
                    <div class="wing-category-body">
                        <ul class="VerticalList foil-options">
                            <li class="VerticalList__Item" data-option-category="foil">
                                <input type="radio" id="foil-210-camber" name="foil" value="210-camber" data-price="0">
                                <label for="foil-210-camber">
                                    <div class="option-content">
                                        <h5>210 Camber Pro LCS</h5>
                                        <p>Aile haute performance. Portance élevée et carving précis à grande vitesse. Idéale eFoil confirmé.</p>
                                        <div class="option-meta">
                                            <span class="option-tag tag-avance">Avancé</span>
                                            <span class="option-tag">210 cm²</span>
                                        </div>
                                    </div>
                                    <span class="price-diff">Même prix</span>
                                </label>
                            </li>
                            <li class="VerticalList__Item" data-option-category="foil">
                                <input type="radio" id="foil-270-camber" name="foil" value="270-camber" data-price="50">
                                <label for="foil-270-camber">
                                    <div class="option-content">
                                        <h5>270 Camber Pro LCS</h5>
                                        <p>Grande surface pour une portance maximale. Vitesse de décrochage très faible. Glisse exceptionnelle.</p>
                                        <div class="option-meta">
                                            <span class="option-tag tag-intermediaire">Intermédiaire</span>
                                            <span class="option-tag">270 cm²</span>
                                        </div>
                                    </div>
                                    <span class="price-diff">+50€</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- STAB (aile arrière) -->
                <div class="stab-section">
                    <div class="stab-title">Aile arrière (Stab)</div>

                    <button class="aide-btn" onclick="document.getElementById('aideStabModalFoil').classList.add('open')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                        Aide pour choisir son aile arrière
                    </button>

                    <!-- Glide Series -->
                    <div class="wing-category" id="liftx-cat-stab-glide">
                        <div class="wing-category-header" onclick="toggleWingCategory('liftx-cat-stab-glide')">
                            <span class="wing-category-label">Glide Series</span>
                            <span class="wing-category-desc">Vitesse & glisse</span>
                            <div class="wing-category-toggle"></div>
                        </div>
                        <div class="wing-category-body">
                            <ul class="VerticalList stab-options">
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-25-glide" name="stab" value="25-glide" data-price="0">
                                    <label for="stab-25-glide">
                                        <div class="option-content">
                                            <h5>25 Glide</h5>
                                            <p>La plus petite et la plus rapide. Favoris du shop pour la vitesse pure. Incroyable pour le surf.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-expert">Expert</span>
                                                <span class="option-tag">25 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-32-glide" name="stab" value="32-glide" data-price="0">
                                    <label for="stab-32-glide">
                                        <div class="option-content">
                                            <h5>32 Glide</h5>
                                            <p>Sportif et rapide. Moins de surface et angle inférieur — meilleure glisse et vitesses plus rapides.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-avance">Avancé</span>
                                                <span class="option-tag">32 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                                <li class="VerticalList__Item selected" data-option-category="stab">
                                    <input type="radio" id="stab-36-glide" name="stab" value="36-glide" data-price="0" checked>
                                    <label for="stab-36-glide">
                                        <div class="option-content">
                                            <h5>36 Glide</h5>
                                            <p>L'étalon-or de la gamme Glide. Grande capacité de virage sans se sentir instable.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-intermediaire">Intermédiaire</span>
                                                <span class="option-tag">36 cm²</span>
                                                <span class="option-tag tag-inclus">Inclus LIFTX</span>
                                            </div>
                                        </div>
                                        <span class="price-diff">Inclus</span>
                                    </label>
                                </li>
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-46-glide" name="stab" value="46-glide" data-price="0">
                                    <label for="stab-46-glide">
                                        <div class="option-content">
                                            <h5>46 Glide</h5>
                                            <p>Stabilité maximale. Virages lents pour un ride sûr et plus détendu.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-debutant">Débutant</span>
                                                <span class="option-tag">46 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="wing-category-divider"></div>

                    <!-- Surf V2 -->
                    <div class="wing-category collapsed" id="liftx-cat-stab-surf">
                        <div class="wing-category-header" onclick="toggleWingCategory('liftx-cat-stab-surf')">
                            <span class="wing-category-label">Surf V2</span>
                            <span class="wing-category-desc">Polyvalence surf foil</span>
                            <div class="wing-category-toggle"></div>
                        </div>
                        <div class="wing-category-body">
                            <ul class="VerticalList stab-options">
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-38-surf" name="stab" value="38-surf" data-price="0">
                                    <label for="stab-38-surf">
                                        <div class="option-content">
                                            <h5>38 Surf V2</h5>
                                            <p>Notre aile arrière la plus polyvalente. S'accorde bien avec le 150 Surf et les plus grandes tailles.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-intermediaire">Intermédiaire</span>
                                                <span class="option-tag">38 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-48-surf" name="stab" value="48-surf" data-price="0">
                                    <label for="stab-48-surf">
                                        <div class="option-content">
                                            <h5>48 Surf V2</h5>
                                            <p>La plus grande et la plus stable. S'accorde bien avec les tailles 200 cm² et plus.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-debutant">Débutant</span>
                                                <span class="option-tag">48 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="wing-category-divider"></div>

                    <!-- Carve -->
                    <div class="wing-category collapsed" id="liftx-cat-stab-carve">
                        <div class="wing-category-header" onclick="toggleWingCategory('liftx-cat-stab-carve')">
                            <span class="wing-category-label">Carve Series</span>
                            <span class="wing-category-desc">Virages serrés — Riders avancés</span>
                            <div class="wing-category-toggle"></div>
                        </div>
                        <div class="wing-category-body">
                            <ul class="VerticalList stab-options">
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-26-carve" name="stab" value="26-carve" data-price="0">
                                    <label for="stab-26-carve">
                                        <div class="option-content">
                                            <h5>26 Carve</h5>
                                            <p>La plus sportive de la série Carve. Idéale pour les riders expérimentés cherchant des virages toujours plus serrés.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-expert">Expert</span>
                                                <span class="option-tag">26 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-33-carve" name="stab" value="33-carve" data-price="0">
                                    <label for="stab-33-carve">
                                        <div class="option-content">
                                            <h5>33 Carve</h5>
                                            <p>Beaucoup de stabilité dans le virage, virages serrés fiables avec une grande maniabilité.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-avance">Avancé</span>
                                                <span class="option-tag">33 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="wing-category-divider"></div>

                    <!-- Flow -->
                    <div class="wing-category collapsed" id="liftx-cat-stab-flow">
                        <div class="wing-category-header" onclick="toggleWingCategory('liftx-cat-stab-flow')">
                            <span class="wing-category-label">Flow Series</span>
                            <span class="wing-category-desc">Stabilité avec traînée réduite</span>
                            <div class="wing-category-toggle"></div>
                        </div>
                        <div class="wing-category-body">
                            <ul class="VerticalList stab-options">
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-21-flow" name="stab" value="21-flow" data-price="0">
                                    <label for="stab-21-flow">
                                        <div class="option-content">
                                            <h5>21 Flow</h5>
                                            <p>Conçue pour les riders d'un niveau avancé. Les avantages d'un très petit stab sans sacrifier la stabilité.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-expert">Expert</span>
                                                <span class="option-tag">135 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                                <!-- MODIF 2026-07-22 : 26 Flow ajoutee (aile arriere par defaut du 148 Havoc) -->
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-26-flow" name="stab" value="26-flow" data-price="0">
                                    <label for="stab-26-flow">
                                        <div class="option-content">
                                            <h5>26 Flow</h5>
                                            <p>Le compromis idéal de la série Flow : traînée réduite et stabilité maîtrisée. Aile arrière recommandée avec le 148 Havoc.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-avance">Avancé</span>
                                                <span class="option-tag">165 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                                <li class="VerticalList__Item" data-option-category="stab">
                                    <input type="radio" id="stab-31-flow" name="stab" value="31-flow" data-price="0">
                                    <label for="stab-31-flow">
                                        <div class="option-content">
                                            <h5>31 Flow</h5>
                                            <p>L'efficacité d'un petit stab à la traînée réduite. Fuselage plus long pour une stabilité maximale.</p>
                                            <div class="option-meta">
                                                <span class="option-tag tag-avance">Avancé</span>
                                                <span class="option-tag">200 cm²</span>
                                            </div>
                                        </div>
                                        <span class="price-diff"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /stab-section -->

            </div>

            <!-- SECTION 5 : CONTROLLER -->
            <div class="contentMarker" data-marker-content="img-controller">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 5 / 7</span>
                </div>
                <h3 class="section-title">Bluetooth Controller</h3>
                <ul class="VerticalList controller-options">
                    <li class="VerticalList__Item selected" data-option-category="controller">
                        <input type="radio" id="controller-bluetooth" name="controller" value="bluetooth" data-price="0" checked disabled>
                        <label for="controller-bluetooth">
                            <div class="option-content">
                                <h5>Bluetooth Controller</h5>
                                <p>Télécommande sans fil fiable et intuitive. Inclus dans votre pack LIFTX, livré dans sa boîte.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 6 : MÂT & PROPULSION -->
            <div class="contentMarker" data-marker-content="img-propulsion">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 6 / 7</span>
                </div>
                <h3 class="section-title">Mât & Propulsion</h3>
                <p class="section-subtitle">Mât et propulseur inclus dans votre pack LIFTX</p>
                <ul class="VerticalList propulsion-options">
                    <li class="VerticalList__Item selected" data-option-category="propulsion">
                        <input type="radio" id="prop-32-carbon" name="propulsion" value="32-folding" data-price="0" checked disabled>
                        <label for="prop-32-carbon">
                            <div class="option-content">
                                <h5>32" LCS Carbon 55 — 81 cm + LCS 55 Folding</h5>
                                <p>Mât carbone 32" (81 cm) avec hélice LCS 55 Folding. Inclus dans votre pack LIFTX — performance et efficacité maximales.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 7 : ACCESSOIRES -->
            <div class="contentMarker" data-marker-content="img-accessoires" id="last-step">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span>
                    </div>
                    <span class="progress-text">Étape 7 / 7</span>
                </div>
                <h3 class="section-title">Accessoires</h3>
                <ul class="VerticalList accessoires-options">
                    <li class="VerticalList__Item selected" data-option-category="accessoires">
                        <input type="checkbox" id="acc-housse" name="accessoires[]" value="housse-standard" data-price="0" checked disabled>
                        <label for="acc-housse">
                            <div class="option-content">
                                <h5>Housse Standard</h5>
                                <p>Housse de protection incluse dans votre pack LIFTX</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="accessoires">
                        <!-- MODIF 2026-07-22 : backpack LIFTX (value distincte -> vraie photo LIFTX) -->
                        <input type="checkbox" id="acc-backpack" name="accessoires[]" value="backpack-liftx" data-price="0">
                        <label for="acc-backpack">
                            <div class="option-content">
                                <h5>Battery Backpack</h5>
                                <p>Inclus dans le pack • Transport batterie</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item selected" data-option-category="accessoires">
                        <!-- MODIF 2026-07-22 : Fast Charger desormais INCLUS dans le pack (etait +1 541 EUR) -->
                        <input type="checkbox" id="acc-chargeur" name="accessoires[]" value="chargeur" data-price="0" checked disabled>
                        <label for="acc-chargeur">
                            <div class="option-content">
                                <h5>Fast Charger</h5>
                                <p>Inclus dans le pack • Charge ultra-rapide</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- MODALS AIDE FOIL (hors du flux de scroll) -->
    <div class="wing-aide-modal" id="aideModalFoil">
        <div class="modal-content modal-box-aide">
            <button class="modal-close" onclick="document.getElementById('aideModalFoil').classList.remove('open')">×</button>
            <h2>Choisir son aile avant</h2>
            <p class="modal-subtitle">Guide de sélection selon votre niveau et style de ride</p>
            <div class="modal-grid">
                <div class="modal-grid-title">Havoc LCS — Vitesse</div>
                <div class="modal-card"><h4>148 Havoc LCS</h4><p>Ultra-compact et réactif. Pour riders experts cherchant vitesse maximale et carving serré.</p></div>
                <div class="modal-grid-title">Camber Pro LCS — Polyvalence</div>
                <div class="modal-card"><h4>210 Camber Pro LCS</h4><p>Haute performance. Portance élevée, carving précis. Le choix des riders confirmés.</p></div>
                <div class="modal-card"><h4>270 Camber Pro LCS</h4><p>Grande surface, portance maximale, décrochage très bas. Glisse exceptionnelle pour intermédiaires.</p></div>
            </div>
        </div>
    </div>

    <div class="wing-aide-modal" id="aideStabModalFoil">
        <div class="modal-content modal-box-aide">
            <button class="modal-close" onclick="document.getElementById('aideStabModalFoil').classList.remove('open')">×</button>
            <h2>Choisir son aile arrière</h2>
            <p class="modal-subtitle">Guide de sélection selon votre style de ride</p>
            <div class="modal-grid">
                <div class="modal-grid-title">Glide Series — Vitesse & glisse</div>
                <div class="modal-card"><h4>25 Glide</h4><p>La plus petite et rapide. Vitesse pure. Incroyable pour le surf. Niveau expert.</p></div>
                <div class="modal-card"><h4>32 Glide</h4><p>Sportif et rapide. Meilleure glisse et vitesses plus élevées. Niveau avancé.</p></div>
                <div class="modal-card"><h4>36 Glide</h4><p>L'étalon-or. Grande capacité de virage, stable. Niveau intermédiaire.</p></div>
                <div class="modal-card"><h4>46 Glide</h4><p>Stabilité maximale, virages lents, ride détendu. Niveau débutant.</p></div>
                <div class="modal-grid-title">Surf V2 — Polyvalence surf</div>
                <div class="modal-card"><h4>38 Surf V2</h4><p>La plus polyvalente. S'accorde avec le 150 Surf et les grandes tailles.</p></div>
                <div class="modal-card"><h4>48 Surf V2</h4><p>La plus grande et stable. Parfaite pour les ailes 200 cm² et plus.</p></div>
                <div class="modal-grid-title">Carve Series — Virages serrés</div>
                <div class="modal-card"><h4>26 Carve</h4><p>La plus sportive. Pour les experts qui cherchent des virages toujours plus serrés.</p></div>
                <div class="modal-card"><h4>33 Carve</h4><p>Stabilité dans le virage, maniabilité fiable. Niveau avancé.</p></div>
                <div class="modal-grid-title">Flow Series — Traînée réduite</div>
                <div class="modal-card"><h4>21 Flow</h4><p>Petit stab sans sacrifier la stabilité. Pour riders avancés.</p></div>
                <div class="modal-card"><h4>31 Flow</h4><p>Fuselage long, traînée réduite, stabilité maximale. Pour riders avancés.</p></div>
            </div>
        </div>
    </div>

    <!-- FOOTER FIXE -->
    <div id="configurator-footer">
        <div class="footer-inner">
            <div class="footer-product">
                <h4 id="config-summary">LIFTX 4'3" — Off-White</h4>
                <div class="configuratorPrices">
                    <span class="configuratorPrice" id="total-price">11 580€</span>
                    <span class="currency-code">EUR</span>
                </div>
            </div>
            <div class="footer-actions">
                <button class="btn-quote" id="openQuoteModal">Demander un devis</button>
            </div>
        </div>
    </div>

</div>

<!-- MODAL FORMULAIRE DEVIS -->
<div id="quoteModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <button class="modal-close" id="closeModal">×</button>
        <h2>Demande de devis</h2>
        <p class="modal-subtitle">Recevez votre devis personnalisé sous 24h</p>
        <form id="quoteForm">
            <div class="form-group">
                <label for="client-nom">Nom complet *</label>
                <input type="text" id="client-nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="client-email">Email *</label>
                <input type="email" id="client-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="client-tel">Téléphone *</label>
                <input type="tel" id="client-tel" name="tel" required>
            </div>
            <div class="form-group">
                <label for="client-message">Message (optionnel)</label>
                <textarea id="client-message" name="message" rows="4" placeholder="Questions ou demandes spécifiques..."></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn-secondary" id="cancelQuote">Annuler</button>
                <button type="submit" class="btn-primary">Envoyer la demande</button>
            </div>
        </form>
        <div id="formSuccess" style="display: none;">
            <div class="success-message">
                <h3>Demande envoyée !</h3>
                <p>Nous vous recontactons sous 24h avec votre devis personnalisé.</p>
                <button class="btn-primary" id="closeSuccess">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
if (typeof LIFT_CONFIG !== 'undefined' && LIFT_CONFIG.images) {
    LIFT_CONFIG.images.basePath = '<?php echo get_stylesheet_directory_uri(); ?>/configurator/images/';
}
(function() {
    var el = document.getElementById('liftConfigurator');
    if (!el) return;
    var parent = el.parentElement;
    while (parent && parent !== document.documentElement) {
        parent.style.setProperty('background', 'transparent', 'important');
        parent.style.setProperty('background-color', 'transparent', 'important');
        parent.style.setProperty('overflow', 'visible', 'important');
        parent = parent.parentElement;
    }
    // Applique le clip APRES la boucle ci-dessus : sinon le "overflow: visible" force
    // sur <body> (necessaire pour le sticky desktop) ecrase le "overflow-x: clip" et
    // laisse la page defiler horizontalement.
    document.documentElement.style.setProperty('overflow-x', 'clip', 'important');
    document.body.style.setProperty('overflow-x', 'clip', 'important');
})();
</script>
