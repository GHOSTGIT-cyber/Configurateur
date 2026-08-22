<?php
/**
 * Template HTML du configurateur Lift - LIFT5 F
 * v1.0
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
                <img src="<?php echo $img; ?>modele/2026_LIFT5F_5_4_TidePoolBlue_Ortho_Shadow_3000x3000.png" alt="LIFT5 F 4'9">
                <div class="image-caption">LIFT5 F 4'9" SPORT</div>
            </div>

            <div id="img-hull" class="image-slide" data-section="hull">
                <div class="hull-slider">
                    <div class="slider-container">
                        <?php $lift5f_base = $img . "hull/lift-5f/5f-2026/tide-pool-blue/images/"; ?>
                        <img class="slider-image active" data-view="ortho"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_Ortho_Shadow_3000x3000.png"
                             alt="Vue dessus">
                        <img class="slider-image" data-view="iso"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_Iso_Shadow_3000x3000.png"
                             alt="Vue isometrique">
                        <img class="slider-image" data-view="tiltback"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_TiltBack_Shadow_3000x3000.png"
                             alt="Vue arriere">
                        <img class="slider-image" data-view="tiltfront"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_TiltFront_Shadow_3000x3000.png"
                             alt="Vue avant">
                        <img class="slider-image" data-view="profile"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_Profile_Shadow_3000x3000.png"
                             alt="Vue profil">
                        <img class="slider-image" data-view="top"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_Top_Shadow_3000x3000.png"
                             alt="Vue du dessus">
                        <img class="slider-image" data-view="bottom"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_Bottom_Shadow_3000x3000.png"
                             alt="Vue dessous">
                        <img class="slider-image" data-view="explodediso1"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_ExplodedIso1_3000x3000.png"
                             alt="Vue éclatée 1">
                        <img class="slider-image" data-view="explodediso2"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_ExplodedIso2_3000x3000.png"
                             alt="Vue éclatée 2">
                        <img class="slider-image" data-view="explodedvert"
                             src="<?php echo $lift5f_base; ?>2026_LIFT5F_5_4_TidePoolBlue_ExplodedVertical_3000x3000.png"
                             alt="Vue éclatée verticale">
                    </div>
                    <div class="slider-nav">
                        <button class="slider-dot active" data-view="ortho" title="Vue dessus"></button>
                        <button class="slider-dot" data-view="iso" title="Vue isometrique"></button>
                        <button class="slider-dot" data-view="tiltback" title="Vue arriere"></button>
                        <button class="slider-dot" data-view="tiltfront" title="Vue avant"></button>
                        <button class="slider-dot" data-view="profile" title="Vue profil"></button>
                        <button class="slider-dot" data-view="top" title="Vue du dessus"></button>
                        <button class="slider-dot" data-view="bottom" title="Vue dessous"></button>
                        <button class="slider-dot" data-view="explodediso1" title="Vue éclatée 1"></button>
                        <button class="slider-dot" data-view="explodediso2" title="Vue éclatée 2"></button>
                        <button class="slider-dot" data-view="explodedvert" title="Vue éclatée verticale"></button>
                    </div>
                    <button class="slider-arrow slider-prev" aria-label="Image precedente">&lt;</button>
                    <button class="slider-arrow slider-next" aria-label="Image suivante">&gt;</button>
                </div>
                <div class="image-caption">Couleurs</div>
            </div>

            <div id="img-batterie" class="image-slide" data-section="batterie">
                <!-- MODIF 2026-07-22 : vraies photos GEN5 Full Range (etaient battery-gen5.png/liftx-* = GEN4 + LIFTX) -->
                <div class="hull-slider">
                    <div class="slider-container">
                        <img class="slider-image active" data-view="front" src="<?php echo $img; ?>batterie/gen5-fullrange-real.png" alt="Gen5 Full Range Battery - Fermée">
                        <img class="slider-image" data-view="open" src="<?php echo $img; ?>batterie/gen5-fullrange-open.png" alt="Gen5 Full Range Battery - Ouverte">
                    </div>
                    <div class="slider-nav">
                        <button class="slider-dot active" data-view="front" title="Fermée"></button>
                        <button class="slider-dot" data-view="open" title="Ouverte"></button>
                    </div>
                    <button class="slider-arrow slider-prev" aria-label="Image precedente">&lt;</button>
                    <button class="slider-arrow slider-next" aria-label="Image suivante">&gt;</button>
                </div>
                <div class="image-caption">Batterie</div>
            </div>

            <div id="img-foil" class="image-slide" data-section="foil">
                <img src="<?php echo $img; ?>foil/wing-210-camber.png" alt="Front Wing 200 Surf V2">
                <div class="image-caption">Front Wing</div>
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
                <!-- MODIF 2026-07-22 : vraie photo du mât ALUMINIUM LIFT5 F (etait un mât carbone mal nomme) -->
                <img src="<?php echo $img; ?>mats/mast-alu-lift5f.png" alt="28&quot; LCS Aluminum 68">
                <div class="image-caption">Mât</div>
            </div>

            <div id="img-propulseur-f" class="image-slide" data-section="propulseur-f">
                <img src="<?php echo $img; ?>propulsion/lcs jet kit.png" alt="Lift Jet">
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
                <p class="section-subtitle">LIFT5 F — Performance accessible, matériaux premium</p>
                <ul class="VerticalList modele-options">
                    <li class="VerticalList__Item selected" data-option-category="modele">
                        <input type="radio" id="modele-lift-5f-49" name="modele" value="lift-5f-49" data-price="0" checked>
                        <label for="modele-lift-5f-49">
                            <div class="option-content">
                                <h5>LIFT5 F 4'9" SPORT</h5>
                                <p>Taille intermédiaire idéale pour progresser rapidement. Maniabilité et équilibre parfaits pour les riders en développement.</p>
                            </div>
                            <span class="price-diff">Sélectionné</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="modele">
                        <input type="radio" id="modele-lift-5f-54" name="modele" value="lift-5f-54" data-price="200">
                        <label for="modele-lift-5f-54">
                            <div class="option-content">
                                <h5>LIFT5 F 5'4" CRUISER</h5>
                                <p>Volume maximal pour des sessions longues et confortables. Stabilité optimale pour débuter ou progresser sereinement.</p>
                            </div>
                            <span class="price-diff">+200€</span>
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
                <p class="section-subtitle">Coloris exclusifs LIFT5 F</p>
                <ul class="VerticalList hull-options">
                    <li class="VerticalList__Item selected" data-option-category="hull" data-model="lift-5-f">
                        <input type="radio" id="hull-tide-pool-blue" name="hull" value="tide-pool-blue" data-price="0" checked>
                        <label for="hull-tide-pool-blue">
                            <div class="option-content">
                                <div class="color-preview" style="background: #4A9B9E;"></div>
                                <h5>Tide Pool Blue</h5>
                            </div>
                            <span class="price-diff">Sélectionné</span>
                        </label>
                    </li>
                    <li class="VerticalList__Item" data-option-category="hull" data-model="lift-5-f">
                        <input type="radio" id="hull-matcha-green" name="hull" value="matcha-green" data-price="0">
                        <label for="hull-matcha-green">
                            <div class="option-content">
                                <div class="color-preview" style="background: #7DAE7D;"></div>
                                <h5>Matcha Green</h5>
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
                <p class="section-subtitle">Batterie incluse dans votre pack LIFT5 F</p>
                <ul class="VerticalList batterie-options">
                    <li class="VerticalList__Item selected" data-option-category="batterie">
                        <input type="radio" id="batterie-full-range" name="batterie" value="full-range" data-price="0" checked disabled>
                        <label for="batterie-full-range">
                            <div class="option-content">
                                <h5>Gen5 Full Range Battery</h5>
                                <p>Batterie nouvelle génération. Autonomie maximale pour des sessions prolongées. Incluse dans votre pack LIFT5 F.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 4 : FRONT WING -->
            <div class="contentMarker" data-marker-content="img-foil">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 4 / 8</span>
                </div>
                <h3 class="section-title">Front Wing & Stab</h3>
                <p class="section-subtitle">Ailes incluses dans votre pack LIFT5 F</p>
                <ul class="VerticalList foil-options">
                    <li class="VerticalList__Item selected" data-option-category="foil">
                        <input type="radio" id="foil-200-surf-v2" name="foil" value="200-surf-v2" data-price="0" checked disabled>
                        <label for="foil-200-surf-v2">
                            <div class="option-content">
                                <h5>200 Surf V2 — Front Wing</h5>
                                <p>Aile surf polyvalente de 200 cm². Portance progressive, décrochage maîtrisé. Parfaite pour progresser sur vagues et eaux calmes.</p>
                                <div class="option-meta">
                                    <span class="option-tag tag-intermediaire">Intermédiaire</span>
                                    <span class="option-tag">200 cm²</span>
                                    <span class="option-tag tag-inclus">Inclus LIFT5 F</span>
                                </div>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
                <div class="stab-section">
                    <div class="stab-title">Aile arrière (Stab) — Incluse</div>
                    <ul class="VerticalList stab-options">
                        <li class="VerticalList__Item selected" data-option-category="stab">
                            <input type="radio" id="stab-surf-inclus" name="stab" value="stab-surf-inclus" data-price="0" checked disabled>
                            <label for="stab-surf-inclus">
                                <div class="option-content">
                                    <h5>38 Surf (4'9) / 48 Surf (5'4)</h5>
                                    <p>Aile arrière adaptée à votre modèle. 38 Surf pour le 4'9 Sport, 48 Surf pour le 5'4 Cruiser — incluse dans votre pack.</p>
                                    <div class="option-meta">
                                        <span class="option-tag tag-inclus">Inclus LIFT5 F</span>
                                    </div>
                                </div>
                                <span class="price-diff">Inclus</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- SECTION 5 : CONTROLLER -->
            <div class="contentMarker" data-marker-content="img-controller">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 5 / 8</span>
                </div>
                <h3 class="section-title">Bluetooth Controller</h3>
                <p class="section-subtitle">Télécommande incluse dans votre pack LIFT5 F</p>
                <ul class="VerticalList controller-options">
                    <li class="VerticalList__Item selected" data-option-category="controller">
                        <input type="radio" id="controller-bluetooth" name="controller" value="bluetooth" data-price="0" checked disabled>
                        <label for="controller-bluetooth">
                            <div class="option-content">
                                <h5>Bluetooth Controller</h5>
                                <p>Télécommande sans fil fiable et intuitive. Inclus dans votre pack LIFT5 F, livré dans sa boîte.</p>
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
                <p class="section-subtitle">Mât inclus dans votre pack LIFT5 F</p>
                <ul class="VerticalList propulsion-options">
                    <li class="VerticalList__Item selected" data-option-category="propulsion">
                        <input type="radio" id="prop-28-alu-68" name="propulsion" value="28-alu-68" data-price="0" checked disabled>
                        <label for="prop-28-alu-68">
                            <div class="option-content">
                                <h5>28" LCS Aluminum 68 — 71 cm</h5>
                                <p>Mât aluminium 28" (71 cm) robuste et léger. Inclus dans votre pack LIFT5 F — efficacité et accessibilité.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- SECTION 7 : PROPULSEUR -->
            <div class="contentMarker" data-marker-content="img-propulseur-f">
                <div class="step-progress">
                    <div class="progress-dots">
                        <span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot done"></span><span class="dot active"></span><span class="dot"></span>
                    </div>
                    <span class="progress-text">Étape 7 / 8</span>
                </div>
                <h3 class="section-title">Propulseur</h3>
                <p class="section-subtitle">Propulseur inclus dans votre pack LIFT5 F</p>
                <ul class="VerticalList propulsion-options">
                    <li class="VerticalList__Item selected" data-option-category="propulseur">
                        <input type="radio" id="prop-lift-jet" name="propulseur" value="lift-jet" data-price="0" checked disabled>
                        <label for="prop-lift-jet">
                            <div class="option-content">
                                <h5>Lift Jet</h5>
                                <p>Propulseur Lift Jet 68 mm. Inclus dans votre pack LIFT5 F — silencieux, efficace et fiable.</p>
                            </div>
                            <span class="price-diff">Inclus</span>
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
                                <p>Housse de protection incluse dans votre pack LIFT5 F</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                    <!-- MODIF 2026-07-22 : Fast Charger INCLUS dans le pack LIFT5 F -->
                    <li class="VerticalList__Item selected" data-option-category="accessoires">
                        <input type="checkbox" id="acc-chargeur" name="accessoires[]" value="chargeur" data-price="0" checked disabled>
                        <label for="acc-chargeur">
                            <div class="option-content">
                                <h5>Fast Charger</h5>
                                <p>Inclus dans le pack • Charge ultra-rapide</p>
                            </div>
                            <span class="price-diff">Inclus</span>
                        </label>
                    </li>
                    <!-- MODIF 2026-07-22 : Battery Backpack EN SUPPLEMENT sur LIFT5 F (contrairement a LIFT5/LIFTX ou il est inclus) -->
                    <li class="VerticalList__Item" data-option-category="accessoires">
                        <input type="checkbox" id="acc-backpack" name="accessoires[]" value="backpack-sup" data-price="100">
                        <label for="acc-backpack">
                            <div class="option-content">
                                <h5>Battery Backpack</h5>
                                <p>En option • Transport confortable de la batterie</p>
                            </div>
                            <span class="price-diff">En supplément</span>
                        </label>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- FOOTER FIXE -->
    <div id="configurator-footer">
        <div class="footer-inner">
            <div class="footer-product">
                <h4 id="config-summary">LIFT5 F 4'9" SPORT — Tide Pool Blue</h4>
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
