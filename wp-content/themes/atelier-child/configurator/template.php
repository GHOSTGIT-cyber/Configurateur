<?php
/**
 * Template HTML du configurateur Lift - LIFT5
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
                <img src="<?php echo $img; ?>modele/2025_LIFT5_44.png" alt="LIFT5 4'4">
                <div class="image-caption">LIFT5 4'4" PRO</div>
            </div>

            <div id="img-hull" class="image-slide" data-section="hull">
                <div class="hull-slider">
                    <div class="slider-container">
                        <img class="slider-image active" data-view="ortho"
                             src="<?php echo $img; ?>hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Ortho_2000x2000.png"
                             alt="Vue dessus">
                        <img class="slider-image" data-view="iso"
                             src="<?php echo $img; ?>hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Package_Iso_Shadow_2000x2000.png"
                             alt="Vue isometrique">
                        <img class="slider-image" data-view="tiltback"
                             src="<?php echo $img; ?>hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Package_TiltBack_Shadow_2000x2000.png"
                             alt="Vue arriere">
                        <img class="slider-image" data-view="tiltfront"
                             src="<?php echo $img; ?>hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Package_TiltFront_Shadow_2000x2000.png"
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
                <!-- MODIF 2026-07-22 : vraie photo GEN5 Full Range (etait battery-gen5.png = en fait une GEN4) -->
                <img src="<?php echo $img; ?>batterie/gen5-fullrange-real.png" alt="Gen5 Full Range Battery">
                <div class="image-caption">Batteries</div>
            </div>

            <div id="img-foil" class="image-slide" data-section="foil">
                <img src="<?php echo $img; ?>foil/wing-210-camber.png" alt="Front Wing">
                <div class="image-caption">Front Wings</div>
            </div>

            <div id="img-controller" class="image-slide" data-section="controller">
                <!-- MODIF 2026-07-22 : Elite Hand Controller (remplace le controller standard, pack LIFT5) -->
                <div class="hull-slider">
                    <div class="slider-container">
                        <img class="slider-image active" data-view="ctrl-main" src="<?php echo $img; ?>controller/elite-handcontroller.png" alt="Elite Hand Controller">
                        <img class="slider-image" data-view="ctrl-front" src="<?php echo $img; ?>controller/elite-handcontroller-front.png" alt="Elite Hand Controller - Face">
                    </div>
                    <div class="slider-nav">
                        <button class="slider-dot active" data-view="ctrl-main" title="Vue principale"></button>
                        <button class="slider-dot" data-view="ctrl-front" title="Face"></button>
                    </div>
                    <button class="slider-arrow slider-prev" aria-label="Image precedente">&lt;</button>
                    <button class="slider-arrow slider-next" aria-label="Image suivante">&gt;</button>
                </div>
                <div class="image-caption">Elite Hand Controller</div>
            </div>

            <div id="img-propulsion" class="image-slide" data-section="propulsion">
                <img src="<?php echo $img; ?>mats/2025_32_LCSCarbon68Propulsion_Side_2000x2000.png" alt="Mât LCS Carbon 68">
                <div class="image-caption">Mât</div>
            </div>

            <div id="img-propulseur" class="image-slide" data-section="propulseur">
                <img src="<?php echo $img; ?>propulsion/lcs jet kit.png" alt="LCS Jet">
                <div class="image-caption">Propulseur</div>
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
                        <span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 1 / 8</span>
                </div>
                <h3 class="section-title">Choisir le modèle & taille</h3>
                <p class="section-subtitle">LIFT5 — The most refined eFoil in the game</p>
                <ul class="VerticalList modele-options">
                    <li class="VerticalList__Item selected" data-option-category="modele">
                        <input type="radio" id="modele-lift-5-44" name="modele" value="lift-5-44" data-price="0" checked>
                        <label for="modele-lift-5-44">
                            <div class="option-content">
                                <h5>LIFT5 4'4" PRO</h5>
                                <p>Le plus petit et le plus agile — taille expert pour un carving serré et des sensations surf uniques.</p>
                            </div>
                            <span class="price-diff">Sélectionné</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="modele">
                        <input type="radio" id="modele-lift-5-49" name="modele" value="lift-5-49" data-price="200">
                        <label for="modele-lift-5-49">
                            <div class="option-content">
                                <h5>LIFT5 4'9" SPORT</h5>
                                <p>Le meilleur équilibre entre maniabilité et stabilité. Idéal pour progresser rapidement.</p>
                            </div>
                            <span class="price-diff">+200€</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="modele">
                        <input type="radio" id="modele-lift-5-54" name="modele" value="lift-5-54" data-price="400">
                        <label for="modele-lift-5-54">
                            <div class="option-content">
                                <h5>LIFT5 5'4" CRUISER</h5>
                                <p>Volume et stabilité maximaux pour des sessions longues et confortables. Parfait pour débuter.</p>
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
                        <span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 2 / 8</span>
                </div>
                <h3 class="section-title">Couleur</h3>
                <p class="section-subtitle" id="hull-subtitle">Couleurs LIFT5</p>
                <ul class="VerticalList hull-options">
                    <li class="VerticalList__Item selected" data-option-category="hull" data-model="lift-5">
                        <input type="radio" id="hull-steel-blue" name="hull" value="steel-blue" data-price="0" checked>
                        <label for="hull-steel-blue">
                            <div class="option-content">
                                <div class="color-preview" style="background: #6B9BC3;"></div>
                                <h5>Steel Blue</h5>
                            </div>
                            <span class="price-diff">Sélectionné</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="hull" data-model="lift-5">
                        <input type="radio" id="hull-off-white-5" name="hull" value="off-white" data-price="0">
                        <label for="hull-off-white-5">
                            <div class="option-content">
                                <div class="color-preview" style="background: #F5F5F0; border: 1px solid #ddd;"></div>
                                <h5>Off-White</h5>
                            </div>
                            <span class="price-diff">Même prix</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="hull" data-model="lift-5">
                        <input type="radio" id="hull-sunkissed" name="hull" value="sunkissed" data-price="0">
                        <label for="hull-sunkissed">
                            <div class="option-content">
                                <div class="color-preview" style="background: #F4C430;"></div>
                                <h5>Sun Kissed</h5>
                            </div>
                            <span class="price-diff">Même prix</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="hull" data-model="lift-5">
                        <input type="radio" id="hull-carbon-black" name="hull" value="carbon-black" data-price="0">
                        <label for="hull-carbon-black">
                            <div class="option-content">
                                <div class="color-preview" style="background: #1a1a1a;"></div>
                                <h5>Carbon Black</h5>
                            </div>
                            <span class="price-diff">Même prix</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="hull" data-model="lift-5">
                        <input type="radio" id="hull-redrock" name="hull" value="redrock" data-price="0">
                        <label for="hull-redrock">
                            <div class="option-content">
                                <div class="color-preview" style="background: #a13a2a;"></div>
                                <h5>Red Rock</h5>
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
                        <span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 3 / 8</span>
                </div>
                <h3 class="section-title">Batterie</h3>
                <ul class="VerticalList batterie-options">
                    <li class="VerticalList__Item selected" data-option-category="batterie">
                        <input type="radio" id="batterie-full-range" name="batterie" value="full-range" data-price="0" checked disabled>
                        <label for="batterie-full-range">
                            <div class="option-content">
                                <h5>Gen5 Full Range — 2.2 kWh</h5>
                                <p>Batterie nouvelle génération. Autonomie maximale jusqu'à 90 minutes, charge à 80% en 1 heure. Incluse dans votre pack LIFT5.</p>
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
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 4 / 8</span>
                </div>
                <h3 class="section-title">Front Wing & Stab</h3>
                <p class="section-subtitle">Ailes LCS (Lift Connect System) — choisissez votre aile avant et arrière</p>

                <button class="aide-btn" onclick="document.getElementById('aideModalFoil5').classList.add('open')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                    Aide pour choisir son aile avant
                </button>

                <!-- Catégorie : Camber Pro LCS -->
                <div class="wing-category" id="lift5-cat-camber">
                    <div class="wing-category-header" onclick="toggleWingCategory('lift5-cat-camber')">
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
                                            <span class="option-tag tag-inclus">Inclus LIFT5 4'9 SPORT</span>
                                        </div>
                                    </div>
                                    <span class="price-diff">Inclus</span>
                                </label>
                            </li>
                            <li class="VerticalList__Item" data-option-category="foil">
                                <input type="radio" id="foil-270-camber" name="foil" value="270-camber" data-price="0">
                                <label for="foil-270-camber">
                                    <div class="option-content">
                                        <h5>270 Camber Pro LCS</h5>
                                        <p>Grande surface pour une portance maximale. Vitesse de décrochage très faible. Glisse exceptionnelle.</p>
                                        <div class="option-meta">
                                            <span class="option-tag tag-intermediaire">Intermédiaire</span>
                                            <span class="option-tag">270 cm²</span>
                                            <span class="option-tag tag-inclus">Inclus LIFT5 5'4 CRUISER</span>
                                        </div>
                                    </div>
                                    <span class="price-diff">Inclus</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="wing-category-divider"></div>

                <!-- Catégorie : Havoc LCS -->
                <div class="wing-category" id="lift5-cat-havoc">
                    <div class="wing-category-header" onclick="toggleWingCategory('lift5-cat-havoc')">
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
                                            <span class="option-tag tag-inclus">Inclus LIFT5 4'4 PRO</span>
                                        </div>
                                    </div>
                                    <span class="price-diff">Inclus</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- STAB (aile arrière) -->
                <div class="stab-section">
                    <div class="stab-title">Aile arrière (Stab)</div>

                    <button class="aide-btn" onclick="document.getElementById('aideStabModalFoil5').classList.add('open')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                        Aide pour choisir son aile arrière
                    </button>

                    <!-- Glide Series -->
                    <div class="wing-category" id="lift5-cat-stab-glide">
                        <div class="wing-category-header" onclick="toggleWingCategory('lift5-cat-stab-glide')">
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
                                                <span class="option-tag tag-inclus">Inclus LIFT5</span>
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
                                                <span class="option-tag tag-inclus">Inclus LIFT5 Cruiser</span>
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
                    <div class="wing-category collapsed" id="lift5-cat-stab-surf">
                        <div class="wing-category-header" onclick="toggleWingCategory('lift5-cat-stab-surf')">
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
                    <div class="wing-category collapsed" id="lift5-cat-stab-carve">
                        <div class="wing-category-header" onclick="toggleWingCategory('lift5-cat-stab-carve')">
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
                    <div class="wing-category collapsed" id="lift5-cat-stab-flow">
                        <div class="wing-category-header" onclick="toggleWingCategory('lift5-cat-stab-flow')">
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
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 5 / 8</span>
                </div>
                <h3 class="section-title">Elite Hand Controller</h3>
                <ul class="VerticalList controller-options">
                    <li class="VerticalList__Item selected" data-option-category="controller">
                        <!-- MODIF 2026-07-22 : Elite Hand Controller (etait Bluetooth Controller standard) -->
                        <input type="radio" id="controller-elite" name="controller" value="elite" data-price="0" checked disabled>
                        <label for="controller-elite">
                            <div class="option-content">
                                <h5>Elite Hand Controller</h5>
                                <p>Télécommande premium : coque carbone, écran couleur GPS (vitesse & distance) et gâchette réglable. Incluse dans votre pack LIFT5, livrée dans sa boîte.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 6 : MÂT -->
            <div class="contentMarker" data-marker-content="img-propulsion">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 6 / 8</span>
                </div>
                <h3 class="section-title">Mât</h3>
                <p class="section-subtitle">Choisissez la longueur et le matériau de votre mât LCS</p>
                <ul class="VerticalList propulsion-options">
                    <li class="VerticalList__Item selected" data-option-category="propulsion">
                        <input type="radio" id="prop-32-carbon" name="propulsion" value="32-carbon" data-price="0" checked>
                        <label for="prop-32-carbon">
                            <div class="option-content">
                                <h5>32" LCS Carbon 68 — 81 cm</h5>
                                <p>Inclus dans votre pack LIFT5. Mât carbone 32" (81 cm) — la référence performance pour les LIFT5 4'4 Pro et 4'9 Sport.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="propulsion">
                        <input type="radio" id="prop-28-carbon" name="propulsion" value="28-carbon" data-price="-60">
                        <label for="prop-28-carbon">
                            <div class="option-content">
                                <h5>28" LCS Carbon 68 — 71 cm</h5>
                                <p>Version 28" (71 cm) du mât carbone LCS. Remontée réduite, plus de maniabilité — idéal pour les vagues et les petits spots.</p>
                            </div>
                            <span class="price-diff">-60€</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="propulsion">
                        <input type="radio" id="prop-28-alu" name="propulsion" value="28-alu" data-price="-1590">
                        <label for="prop-28-alu">
                            <div class="option-content">
                                <h5>28" LCS Aluminum 68 — 71 cm</h5>
                                <p>Mât aluminium 28" (71 cm) robuste et accessible. Option entrée de gamme, idéale pour découvrir le eFoil.</p>
                            </div>
                            <span class="price-diff">-1 590€</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 7 : PROPULSEUR -->
            <div class="contentMarker" data-marker-content="img-propulseur">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 7 / 8</span>
                </div>
                <h3 class="section-title">Propulseur</h3>
                <p class="section-subtitle">Choisissez votre propulseur LCS</p>
                <ul class="VerticalList propulsion-options">
                    <li class="VerticalList__Item selected" data-option-category="propulseur">
                        <input type="radio" id="prop-lcs-jet" name="propulseur" value="lcs-jet" data-price="0" checked>
                        <label for="prop-lcs-jet">
                            <div class="option-content">
                                <h5>LCS Jet</h5>
                                <p>Inclus dans votre pack LIFT5. Propulseur standard haute performance, efficace et silencieux.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="propulseur">
                        <input type="radio" id="prop-lcs-folding" name="propulseur" value="lcs-folding" data-price="0">
                        <label for="prop-lcs-folding">
                            <div class="option-content">
                                <h5>LCS Folding Propeller</h5>
                                <p>Hélice pliable — se replie automatiquement hors de l'eau pour réduire la traînée lors du surf sans moteur.</p>
                            </div>
                            <span class="price-diff">Même prix</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="propulseur">
                        <input type="radio" id="prop-lcs-fixed" name="propulseur" value="lcs-fixed" data-price="0">
                        <label for="prop-lcs-fixed">
                            <div class="option-content">
                                <h5>LCS Fixed Propeller</h5>
                                <p>Hélice fixe robuste — grip maximal, idéale pour les sessions eFoil intensives et les grandes vitesses.</p>
                            </div>
                            <span class="price-diff">Même prix</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 8 : ACCESSOIRES -->
            <div class="contentMarker" data-marker-content="img-accessoires" id="last-step">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span>
                    </div>
                    <span class="progress-text">Étape 8 / 8</span>
                </div>
                <h3 class="section-title">Accessoires</h3>
                <ul class="VerticalList accessoires-options">
                    <li class="VerticalList__Item selected" data-option-category="accessoires">
                        <input type="checkbox" id="acc-housse" name="accessoires[]" value="housse-standard" data-price="0" checked disabled>
                        <label for="acc-housse">
                            <div class="option-content">
                                <h5>Housse Standard</h5>
                                <p>Housse de protection incluse dans votre pack LIFT5</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="accessoires">
                        <input type="checkbox" id="acc-backpack" name="accessoires[]" value="backpack" data-price="0">
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
                    <li class="VerticalList__Item" data-option-category="accessoires">
                        <input type="checkbox" id="acc-ocho" name="accessoires[]" value="ocho-blowfish" data-price="758">
                        <label for="acc-ocho">
                            <div class="option-content">
                                <h5>Ocho Blowfish Board</h5>
                                <p>Board supplémentaire • Compact et agile</p>
                            </div>
                            <span class="price-diff">+758€</span>
                        </label>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- MODALS AIDE FOIL (hors du flux de scroll) -->
    <div class="wing-aide-modal" id="aideModalFoil5">
        <div class="modal-content modal-box-aide">
            <button class="modal-close" onclick="document.getElementById('aideModalFoil5').classList.remove('open')">×</button>
            <h2>Choisir son aile avant</h2>
            <p class="modal-subtitle">Guide de sélection selon votre niveau et style de ride</p>
            <div class="modal-grid">
                <div class="modal-grid-title">Camber Pro LCS — Polyvalence</div>
                <div class="modal-card"><h4>210 Camber Pro LCS</h4><p>Haute performance. Portance élevée, carving précis. Le choix des riders confirmés.</p></div>
                <div class="modal-card"><h4>270 Camber Pro LCS</h4><p>Grande surface, portance maximale, décrochage très bas. Glisse exceptionnelle pour intermédiaires.</p></div>
                <div class="modal-grid-title">Havoc LCS — Vitesse</div>
                <div class="modal-card"><h4>148 Havoc LCS</h4><p>Ultra-compact et réactif. Pour riders experts cherchant vitesse maximale et carving serré.</p></div>
            </div>
        </div>
    </div>

    <div class="wing-aide-modal" id="aideStabModalFoil5">
        <div class="modal-content modal-box-aide">
            <button class="modal-close" onclick="document.getElementById('aideStabModalFoil5').classList.remove('open')">×</button>
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
                <h4 id="config-summary">LIFT5 4'4" PRO — Steel Blue</h4>
                <div class="configuratorPrices">
                    <span class="configuratorPrice" id="total-price">14 080€</span>
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
