/**
 * CONFIGURATEUR LIFT - Logique JavaScript
 * Version 2025 avec slider 4 vues par couleur
 */

// Catégories repliables pour la section foil
function toggleWingCategory(id) {
    var el = document.getElementById(id);
    if (el) el.classList.toggle('collapsed');
}

// Fermer les modals aide aile en cliquant l'overlay
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.wing-aide-modal').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) overlay.classList.remove('open');
        });
    });
});

(function($) {
    'use strict';

    // ==========================================
    // 1. CONFIGURATION (importee depuis config.js)
    // ==========================================

    // Configuration centralisee - modifiable dans config.js
    const CONFIG = window.LIFT_CONFIG || {};

    // Etat actuel de la configuration (lu depuis le HTML au ready)
    let currentConfig = {
        modele: '',
        hull: '',
        batterie: '',
        foil: '',
        stab: '',           // MODIF 2026-07-22 : aile arriere (stab)
        controller: '',
        propulsion: '',
        accessoires: []
    };

    // Etat du slider
    let currentSliderView = 'ortho';
    const viewTypes = ['ortho', 'iso', 'tiltback', 'tiltfront'];

    // ==========================================
    // 2. INIT AU CHARGEMENT
    // ==========================================

    $(document).ready(function() {
        // Lire l'etat initial depuis les inputs checked dans le HTML
        currentConfig.modele     = $('input[name="modele"]:checked').val()     || 'lift-x-43';
        currentConfig.hull       = $('input[name="hull"]:checked').val()       || 'off-white';
        currentConfig.batterie   = $('input[name="batterie"]:checked').val()   || 'sport';
        currentConfig.foil       = $('input[name="foil"]:checked').val()       || '148-havoc';
        currentConfig.controller = $('input[name="controller"]:checked').val() || 'bluetooth';
        currentConfig.propulsion = $('input[name="propulsion"]:checked').val() || '28-alu';
        currentConfig.propulseur = $('input[name="propulseur"]:checked').val() || 'lcs-jet';
        currentConfig.stab       = $('input[name="stab"]:checked').val()       || '';

        // Accessoires coches au chargement (dont housse-standard incluse)
        currentConfig.accessoires = $('input[name="accessoires[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        // Appliquer le masquage des prix si configure
        console.log('showPrices:', CONFIG.showPrices);
        if (CONFIG.showPrices === false) {
            $('.lift-configurator').addClass('hide-prices');
            console.log('Prix masques');
        }


        // Filtrer les couleurs disponibles selon le modele initial
        updateAvailableColors(currentConfig.modele);

        // Verifier que les images initiales sont chargees
        verifyInitialImages();

        // GSAP ScrollTrigger — doit être initialisé EN PREMIER
        initScrollAnimations();

        // Utilise ScrollTrigger, donc APRÈS initScrollAnimations
        initQuoteButtonVisibility();

        initOptionHandlers();
        initSliderHandlers();
        initModalHandlers();
        // MODIF 2026-07-22 : synchroniser l'aile arriere par defaut avec l'aile avant initiale
        autoSelectStabForFoil(currentConfig.foil);
        updatePrice();
        updateSummary();
        preloadImages();
    });

    // ==========================================
    // 2B. VERIFICATION DES IMAGES INITIALES
    // ==========================================

    function verifyInitialImages() {
        console.log('Verification des images initiales...');
        console.log('basePath:', CONFIG.images?.basePath);

        // Verifier chaque image-slide
        $('.image-slide').each(function() {
            const $slide = $(this);
            const section = $slide.data('section') || $slide.attr('id');

            // Pour le slider, verifier les images du slider
            if ($slide.find('.hull-slider').length > 0) {
                $slide.find('.slider-image').each(function() {
                    const src = $(this).attr('src');
                    console.log('Slider image ' + $(this).data('view') + ':', src);
                });
            } else {
                const $img = $slide.find('img');
                const src = $img.attr('src');

                if (!src || src === '') {
                    console.error('Image manquante pour section:', section);
                    const defaultSrc = CONFIG.images?.basePath + 'accessoires/board-bag.png';
                    $img.attr('src', defaultSrc);
                } else {
                    console.log('Section ' + section + ':', src);
                }

                // Gerer les erreurs de chargement
                $img.on('error', function() {
                    const errorSrc = $(this).attr('src');
                    console.error('Erreur de chargement pour:', errorSrc);
                    const fallback = CONFIG.images?.basePath + 'accessoires/board-bag.png';
                    if (errorSrc !== fallback) {
                        $(this).attr('src', fallback);
                    }
                });
            }
        });
    }

    // ==========================================
    // 3. GSAP SCROLL PARALLAX
    // ==========================================

    function initScrollAnimations() {
        // Verifier que GSAP est charge
        if (typeof gsap === 'undefined') {
            console.warn('GSAP not loaded');
            return;
        }

        gsap.registerPlugin(ScrollTrigger);

        // Recuperer tous les marqueurs de contenu
        const contentMarkers = gsap.utils.toArray('.contentMarker');

        // PAS de pin GSAP — le CSS sticky gère tout seul
        // (le pin GSAP ajoutait un décalage de 100px)

        // Recuperer toutes les images pour pouvoir les masquer toutes d'un coup
        const allImageSlides = document.querySelectorAll('.image-slide');

        function showOnly(imageSlide) {
            allImageSlides.forEach(function(slide) {
                if (slide !== imageSlide) {
                    gsap.killTweensOf(slide);
                    gsap.set(slide, { opacity: 0, zIndex: 1 });
                    slide.classList.remove('visible');
                }
            });
            gsap.killTweensOf(imageSlide);
            gsap.set(imageSlide, { zIndex: 2 });
            gsap.to(imageSlide, {
                opacity: 1,
                duration: CONFIG.animations?.scrollTrigger?.fadeInDuration || 0.5,
                ease: 'power2.out',
                onStart: function() { imageSlide.classList.add('visible'); }
            });
        }

        // Creer un ScrollTrigger individuel pour chaque section
        contentMarkers.forEach((marker, index) => {
            const targetId = marker.dataset.markerContent;
            const imageSlide = document.querySelector('#' + targetId);

            if (!imageSlide) return;

            // Initialiser l'opacite (premiere image visible)
            if (index === 0) {
                gsap.set(imageSlide, { opacity: 1, zIndex: 2 });
                imageSlide.classList.add('visible');
            } else {
                gsap.set(imageSlide, { opacity: 0, zIndex: 1 });
            }

            ScrollTrigger.create({
                trigger: marker,
                start: 'top 60%',
                end: 'bottom 40%',
                onEnter: function() { showOnly(imageSlide); },
                onEnterBack: function() { showOnly(imageSlide); },
                markers: false
            });
        });
    }

    // ==========================================
    // 3B. SLIDER POUR LES 4 VUES PAR COULEUR
    // ==========================================

    function initSliderHandlers() {
        // Clic sur les dots de navigation (slider local)
        $(document).on('click', '.slider-dot', function() {
            var $slider = $(this).closest('.hull-slider');
            var view = $(this).data('view');
            slideToViewIn($slider, view);
        });

        // Boutons precedent/suivant (slider local)
        $(document).on('click', '.slider-prev', function() {
            var $slider = $(this).closest('.hull-slider');
            cycleSlider($slider, -1);
        });

        $(document).on('click', '.slider-next', function() {
            var $slider = $(this).closest('.hull-slider');
            cycleSlider($slider, 1);
        });

        // Swipe sur mobile (par slider)
        var touchStartX = 0;
        var touchTarget = null;

        $(document).on('touchstart', '.hull-slider', function(e) {
            touchStartX = e.originalEvent.changedTouches[0].screenX;
            touchTarget = $(this);
        });

        $(document).on('touchend', '.hull-slider', function(e) {
            if (!touchTarget) return;
            var touchEndX = e.originalEvent.changedTouches[0].screenX;
            var diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                cycleSlider(touchTarget, diff > 0 ? 1 : -1);
            }
            touchTarget = null;
        });
    }

    function slideToView(view) {
        // Ancien comportement : applique au slider hull (compat retrograde)
        slideToViewIn($('#img-hull .hull-slider'), view);
        // Met a jour la variable globale uniquement pour le slider hull
        currentSliderView = view;
    }

    function slideToViewIn($slider, view) {
        if (!$slider || !$slider.length) return;

        var $container = $slider.find('.slider-container');
        var $images = $container.find('.slider-image');
        var $currentImg = $images.filter('.active');
        var $nextImg = $images.filter('[data-view="' + view + '"]');

        if ($nextImg.length === 0 || $nextImg.is($currentImg)) return;

        var duration = CONFIG.animations?.slider?.duration || 0.3;
        var ease = CONFIG.animations?.slider?.ease || 'power2.out';

        gsap.to($currentImg, {
            opacity: 0,
            duration: duration,
            ease: ease,
            onComplete: function() { $currentImg.removeClass('active'); }
        });

        gsap.to($nextImg, {
            opacity: 1,
            duration: duration,
            ease: ease,
            onStart: function() { $nextImg.addClass('active'); }
        });

        $slider.find('.slider-dot').removeClass('active');
        $slider.find('.slider-dot[data-view="' + view + '"]').addClass('active');
    }

    function cycleSlider($slider, direction) {
        if (!$slider || !$slider.length) return;
        var $dots = $slider.find('.slider-dot');
        var views = $dots.map(function() { return $(this).data('view'); }).get();
        var $active = $dots.filter('.active');
        var currentView = $active.data('view') || views[0];
        var idx = views.indexOf(currentView);
        var nextIdx = (idx + direction + views.length) % views.length;
        slideToViewIn($slider, views[nextIdx]);
    }

    // ==========================================
    // 3C. PRECHARGEMENT & CHANGEMENT D'IMAGES
    // ==========================================

    function preloadImages() {
        if (!CONFIG.images) {
            console.warn('CONFIG.images non disponible');
            return;
        }

        var imagesToPreload = [];

        // Precharger les images hull (depuis hullColorImages — source unique)
        if (CONFIG.images.hullColorImages) {
            Object.values(CONFIG.images.hullColorImages).forEach(function(colorImages) {
                Object.values(colorImages).forEach(function(path) {
                    var fullPath = CONFIG.images.basePath + path;
                    if (imagesToPreload.indexOf(fullPath) === -1) {
                        imagesToPreload.push(fullPath);
                    }
                });
            });
        }

        // Precharger les images des modeles
        if (CONFIG.images.modeleImages) {
            Object.values(CONFIG.images.modeleImages).forEach(function(path) {
                var fullPath = CONFIG.images.basePath + path;
                if (imagesToPreload.indexOf(fullPath) === -1) {
                    imagesToPreload.push(fullPath);
                }
            });
        }

        // Precharger les images accessoires
        if (CONFIG.images.accessories) {
            Object.keys(CONFIG.images.accessories).forEach(function(section) {
                Object.values(CONFIG.images.accessories[section]).forEach(function(path) {
                    var fullPath = CONFIG.images.basePath + path;
                    if (imagesToPreload.indexOf(fullPath) === -1) {
                        imagesToPreload.push(fullPath);
                    }
                });
            });
        }

        // Precharger chaque image en arriere-plan
        imagesToPreload.forEach(function(src) {
            var img = new Image();
            img.src = src;
        });

        console.log('Prechargement de ' + imagesToPreload.length + ' images...');
    }

    /**
     * Auto-selectionne l'aile front recommandee selon la taille du modele LIFT5
     * 4'4 PRO -> 148 Havoc | 4'9 SPORT -> 210 Camber | 5'4 CRUISER -> 270 Camber
     */
    function autoSelectFoilForModel(modele) {
        var foilMap = {
            'lift-5-44': '148-havoc',
            'lift-5-49': '210-camber',
            'lift-5-54': '270-camber'
        };
        var targetFoil = foilMap[modele];
        if (!targetFoil) return;

        var $target = $('input[name="foil"][value="' + targetFoil + '"]');
        if (!$target.length || $target.is(':checked')) return;

        $target.prop('checked', true);
        currentConfig.foil = targetFoil;
        updateOptionUI('foil', targetFoil);
        updatePriceDifferences('foil');

        // Replier toutes les categories puis ouvrir celle de l'aile selectionnee
        var $cat = $target.closest('.wing-category');
        $('.wing-category').addClass('collapsed');
        $cat.removeClass('collapsed');

        // MODIF 2026-07-22 : enchainer sur l'aile arriere par defaut correspondante
        autoSelectStabForFoil(targetFoil);
    }

    /**
     * MODIF 2026-07-22
     * Auto-selectionne l'aile arriere (stab) recommandee selon l'aile avant choisie.
     * 270 Camber Pro -> 46 Glide | 210 Camber Pro -> 36 Glide | 148 Havoc -> 26 Flow
     * (map definie dans config.js -> LIFT_CONFIG.stabForFoil)
     */
    function autoSelectStabForFoil(foilValue) {
        var map = CONFIG.stabForFoil || {};
        var targetStab = map[foilValue];
        if (!targetStab) return;

        var $target = $('input[name="stab"][value="' + targetStab + '"]');
        // Aucune cible, ou stab verrouille (ex: LIFT5 F ou l'aile arriere est unique/incluse) -> ne rien forcer
        if (!$target.length || $target.is(':disabled')) return;

        if (!$target.is(':checked')) {
            $target.prop('checked', true);
            updateOptionUI('stab', targetStab);
        }
        currentConfig.stab = targetStab;

        // Ouvrir la categorie du stab selectionne, replier les autres categories de stab (memes parent)
        var $cat = $target.closest('.wing-category');
        $cat.parent().children('.wing-category').addClass('collapsed');
        $cat.removeClass('collapsed');
    }

    /**
     * Met a jour l'image du modele (quand on change de taille)
     */
    function updateModeleImage() {
        var modele = currentConfig.modele;

        var imageSlide = document.querySelector('#img-modele');
        if (!imageSlide) return;

        var imgElement = imageSlide.querySelector('img');
        if (!imgElement) return;

        // Obtenir le nouveau chemin via la fonction utilitaire
        var newSrc = CONFIG.getModeleImagePath(modele);

        // Comparer seulement le chemin relatif
        var currentPath = imgElement.src.split('/configurator/').pop();
        var newPath = newSrc.split('/configurator/').pop();
        if (currentPath === newPath) return;

        // Animation de transition
        var transitionDuration = CONFIG.animations?.imageTransition?.duration || 0.4;
        var transitionEase = CONFIG.animations?.imageTransition?.ease || 'power2.inOut';

        gsap.to(imgElement, {
            opacity: 0,
            duration: transitionDuration / 2,
            ease: transitionEase,
            onComplete: function() {
                imgElement.src = newSrc;
                gsap.to(imgElement, {
                    opacity: 1,
                    duration: transitionDuration / 2,
                    ease: transitionEase
                });
            }
        });

        // Mettre a jour la legende
        var caption = imageSlide.querySelector('.image-caption');
        if (caption) {
            caption.textContent = CONFIG.labels.modele[modele] || modele;
        }

        console.log('Modele image updated:', newSrc);
    }

    /**
     * Met a jour toutes les images du slider hull (4 vues)
     */
    function updateHullSliderImages() {
        var modele = currentConfig.modele;
        var color = currentConfig.hull;

        // Obtenir les 4 chemins d'images
        var images = CONFIG.getHullImages(modele, color);
        if (!images) {
            console.warn('Pas d\'images pour:', modele, color);
            return;
        }

        var $container = $('#img-hull .slider-container');
        if ($container.length === 0) return;

        var transitionDuration = CONFIG.animations?.imageTransition?.duration || 0.4;
        var transitionEase = CONFIG.animations?.imageTransition?.ease || 'power2.inOut';

        // Mettre a jour chaque image du slider
        $container.find('.slider-image').each(function() {
            var $img = $(this);
            var view = $img.data('view');
            var newSrc = images[view];

            if (newSrc && $img.attr('src') !== newSrc) {
                // Animation pour l'image active seulement
                if ($img.hasClass('active')) {
                    gsap.to($img, {
                        opacity: 0,
                        duration: transitionDuration / 2,
                        ease: transitionEase,
                        onComplete: function() {
                            $img.attr('src', newSrc);
                            gsap.to($img, {
                                opacity: 1,
                                duration: transitionDuration / 2,
                                ease: transitionEase
                            });
                        }
                    });
                } else {
                    // Charger les autres images silencieusement
                    $img.attr('src', newSrc);
                }
            }
        });

        console.log('Hull slider images updated for:', modele, color);
    }

    /**
     * Affiche/masque les couleurs selon le modele selectionne
     */
    function updateAvailableColors(modele) {
        // Determiner la famille du modele
        var modelFamily;
        if (modele.indexOf('lift-5f') === 0) {
            modelFamily = 'lift-5-f';
        } else if (modele.indexOf('lift-5') === 0) {
            modelFamily = 'lift-5';
        } else {
            modelFamily = 'lift-x';
        }

        // Mettre a jour le sous-titre
        var subtitle = document.getElementById('hull-subtitle');
        if (subtitle) {
            if (modelFamily === 'lift-x') subtitle.textContent = 'Couleurs LIFTX';
            else if (modelFamily === 'lift-5-f') subtitle.textContent = 'Couleurs LIFT5 F';
            else subtitle.textContent = 'Couleurs LIFT5';
        }

        // Afficher/masquer les options de couleur selon le modele
        $('[data-option-category="hull"]').each(function() {
            var itemModel = $(this).data('model');
            if (itemModel === modelFamily) {
                $(this).show();
            } else {
                $(this).hide();
                // Deselectionner si c'etait selectionne
                $(this).find('input[type="radio"]').prop('checked', false);
                $(this).removeClass('selected');
            }
        });

        // Selectionner automatiquement la premiere couleur disponible pour ce modele
        var defaultColors = CONFIG.images?.defaultColors || { 'lift-x': 'off-white', 'lift-5': 'steel-blue' };
        var defaultColor = defaultColors[modelFamily];

        // Cocher la couleur par defaut
        var $defaultInput = $('input[name="hull"][value="' + defaultColor + '"]').filter(':visible').first();
        if ($defaultInput.length === 0) {
            // Fallback: prendre le premier visible
            $defaultInput = $('[data-option-category="hull"]:visible').first().find('input[name="hull"]');
        }

        if ($defaultInput.length && !$defaultInput.is(':checked')) {
            $defaultInput.prop('checked', true);
            $('[data-option-category="hull"]').removeClass('selected');
            $defaultInput.closest('.VerticalList__Item').addClass('selected');
            currentConfig.hull = $defaultInput.val();
        }

        console.log('Colors updated for:', modelFamily, '- Default:', currentConfig.hull);
    }

    /**
     * Met a jour l'image d'une section accessoire (batterie, foil, etc.)
     */
    function updateSectionImage(section, value) {
        console.log('updateSectionImage:', section, value);

        // Verifier que c'est une section accessoire
        if (!CONFIG.images?.accessories?.[section]) {
            console.warn('Section "' + section + '" non trouvee dans CONFIG.images.accessories');
            return;
        }

        // Obtenir l'element image
        var imageSlide = document.querySelector('#img-' + section);
        if (!imageSlide) {
            console.warn('Element #img-' + section + ' non trouve');
            return;
        }

        var imgElement = imageSlide.querySelector('img');
        if (!imgElement) {
            console.warn('Pas d\'image dans #img-' + section);
            return;
        }

        // Obtenir le nouveau chemin via la fonction utilitaire
        var newSrc = CONFIG.getAccessoryImagePath(section, value);
        console.log('Nouveau chemin:', newSrc);

        // Comparer en utilisant seulement le nom du fichier
        var currentFile = imgElement.src.split('/').pop();
        var newFile = newSrc.split('/').pop();
        if (currentFile === newFile) {
            console.log('Meme fichier, pas de changement');
            return;
        }

        // Animation de transition
        var transitionDuration = CONFIG.animations?.imageTransition?.duration || 0.4;
        var transitionEase = CONFIG.animations?.imageTransition?.ease || 'power2.inOut';

        gsap.to(imgElement, {
            opacity: 0,
            duration: transitionDuration / 2,
            ease: transitionEase,
            onComplete: function() {
                imgElement.src = newSrc;
                gsap.to(imgElement, {
                    opacity: 1,
                    duration: transitionDuration / 2,
                    ease: transitionEase
                });
            }
        });

        console.log(section + ' image updated:', newSrc);
    }

    // ==========================================
    // 3D. VISIBILITE DU BOUTON DEVIS
    // ==========================================

    function initQuoteButtonVisibility() {
        // Le footer est desormais un bloc statique en fin de configurateur :
        // toujours visible, pas d'animation d'apparition liee au scroll.
        $('#configurator-footer').addClass('visible');
    }

    // (Barre de progression supprimée — affichée en dur dans le HTML)

    // ==========================================
    // 4. GESTION DES OPTIONS
    // ==========================================

    function initOptionHandlers() {
        // Radio buttons (choix unique)
        $('input[type="radio"]').on('change', function() {
            var name = $(this).attr('name');
            var value = $(this).val();

            // Mettre a jour l'etat
            currentConfig[name] = value;

            // Mettre a jour les images selon le type de section
            if (name === 'modele') {
                // Quand on change de modele, filtrer les couleurs disponibles
                updateAvailableColors(value);
                // Mettre a jour les images
                updateModeleImage();
                updateHullSliderImages();
                // Auto-selection des ailes recommandees selon la taille (LIFT5)
                autoSelectFoilForModel(value);
            } else if (name === 'hull') {
                // Quand on change de couleur
                updateHullSliderImages();
            } else if (CONFIG.images?.accessories?.[name]) {
                // Les autres sections utilisent les images accessoires
                updateSectionImage(name, value);
            }

            // MODIF 2026-07-22 : changer d'aile avant selectionne l'aile arriere recommandee
            if (name === 'foil') {
                autoSelectStabForFoil(value);
            }

            // Mettre a jour UI
            updateOptionUI(name, value);

            // Recalculer prix
            updatePrice();
            updateSummary();
            updatePriceDifferences(name);
        });

        // Checkboxes (accessoires multiples)
        $('input[type="checkbox"]').on('change', function() {
            var value = $(this).val();
            var isChecked = $(this).is(':checked');

            if (isChecked) {
                currentConfig.accessoires.push(value);
                // Mettre a jour l'image des accessoires avec le dernier selectionne
                updateSectionImage('accessoires', value);
            } else {
                currentConfig.accessoires = currentConfig.accessoires.filter(function(a) { return a !== value; });
                // Si plus d'accessoires selectionnes, afficher l'image par defaut
                if (currentConfig.accessoires.length > 0) {
                    updateSectionImage('accessoires', currentConfig.accessoires[currentConfig.accessoires.length - 1]);
                }
            }

            // Mettre a jour UI
            $(this).closest('.VerticalList__Item').toggleClass('selected', isChecked);

            updatePrice();
            updateSummary();
        });

        // Init prix differences au chargement
        if (CONFIG.prices) {
            Object.keys(CONFIG.prices).forEach(function(category) {
                if (category !== 'accessoires') {
                    updatePriceDifferences(category);
                }
            });
        }
    }

    function updateOptionUI(optionName, value) {
        // Retirer selected de tous les items de cette categorie
        $('input[name="' + optionName + '"]').closest('.VerticalList__Item').removeClass('selected');

        // Ajouter selected a l'item choisi
        $('input[name="' + optionName + '"][value="' + value + '"]').closest('.VerticalList__Item').addClass('selected');
    }

    function updatePriceDifferences(category) {
        if (!CONFIG.prices || !CONFIG.prices[category]) return;

        var selectedValue = currentConfig[category];
        var selectedPrice = CONFIG.prices[category][selectedValue] || 0;

        $('input[name="' + category + '"]').each(function() {
            var optionValue = $(this).val();
            var optionPrice = CONFIG.prices[category][optionValue] || 0;
            var diff = optionPrice - selectedPrice;

            var $priceDiff = $(this).closest('.VerticalList__Item').find('.price-diff');

            if ($(this).is(':checked')) {
                $priceDiff.text('Selectionne');
            } else if (diff > 0) {
                $priceDiff.text('+' + formatPrice(diff));
            } else if (diff < 0) {
                $priceDiff.text('-' + formatPrice(Math.abs(diff)));
            } else {
                $priceDiff.text('Meme prix');
            }
        });
    }

    // ==========================================
    // 5. CALCUL & AFFICHAGE PRIX
    // ==========================================

    function updatePrice() {
        // Le prix du modèle est le prix absolu du pack — les autres options sont des deltas
        var modelePrice = CONFIG.prices?.modele?.[currentConfig.modele] || 0;
        var total = modelePrice;

        // Ajouter prix de chaque option (sauf modele déjà compté)
        Object.keys(currentConfig).forEach(function(category) {
            if (category === 'modele') return;
            if (category === 'accessoires') {
                currentConfig.accessoires.forEach(function(acc) {
                    total += (CONFIG.prices?.accessoires?.[acc]) || 0;
                });
            } else {
                var value = currentConfig[category];
                if (CONFIG.prices?.[category]?.[value] !== undefined) {
                    total += CONFIG.prices[category][value];
                }
            }
        });

        // Afficher avec animation bump si le prix change
        var $priceEl = $('#total-price');
        var oldText = $priceEl.text();
        var newText = formatPrice(total);
        if (oldText !== newText) {
            $priceEl.text(newText);
            $priceEl.removeClass('price-bump');
            // Forcer reflow pour relancer l'animation
            void $priceEl[0].offsetWidth;
            $priceEl.addClass('price-bump');
        }
    }

    function updateSummary() {
        var modele = CONFIG.labels?.modele?.[currentConfig.modele] || 'Lift X';
        var hull = CONFIG.labels?.hull?.[currentConfig.hull] || 'Blanc';

        $('#config-summary').text(modele + ' - ' + hull);
    }

    function formatPrice(amount) {
        return amount.toLocaleString('fr-FR') + '\u20AC';
    }

    // ==========================================
    // 6. MODAL DEVIS
    // ==========================================

    function initModalHandlers() {
        // Ouvrir modal
        $('#openQuoteModal').on('click', function() {
            $('#quoteModal').fadeIn(300);
            $('body').css('overflow', 'hidden');
        });

        // Fermer modal
        $('#closeModal, #cancelQuote').on('click', function() {
            $('#quoteModal').fadeOut(300);
            $('body').css('overflow', '');
        });

        // Soumettre formulaire
        $('#quoteForm').on('submit', function(e) {
            e.preventDefault();
            submitQuote();
        });

        // Fermer message succes
        $('#closeSuccess').on('click', function() {
            $('#quoteModal').fadeOut(300);
            $('body').css('overflow', '');
            $('#formSuccess').hide();
            $('#quoteForm')[0].reset();
            $('#quoteForm').show();
        });
    }

    /* buildConfigRecap désactivé — recap sans prix
    function buildConfigRecap() {
        var html = '<h4>Votre configuration :</h4><ul>';
        html += '<li><strong>Modèle :</strong> ' + (CONFIG.labels?.modele?.[currentConfig.modele] || currentConfig.modele) + '</li>';
        html += '<li><strong>Couleur :</strong> ' + (CONFIG.labels?.hull?.[currentConfig.hull] || currentConfig.hull) + '</li>';
        html += '<li><strong>Batterie :</strong> ' + (CONFIG.labels?.batterie?.[currentConfig.batterie] || currentConfig.batterie) + '</li>';
        html += '<li><strong>Foil :</strong> ' + (CONFIG.labels?.foil?.[currentConfig.foil] || currentConfig.foil) + '</li>';
        html += '<li><strong>Controller :</strong> ' + (CONFIG.labels?.controller?.[currentConfig.controller] || currentConfig.controller) + '</li>';
        html += '<li><strong>Propulsion :</strong> ' + (CONFIG.labels?.propulsion?.[currentConfig.propulsion] || currentConfig.propulsion) + '</li>';
        if (currentConfig.accessoires.length > 0) {
            html += '<li><strong>Accessoires :</strong><ul style="margin-top:8px;">';
            currentConfig.accessoires.forEach(function(acc) {
                html += '<li style="border:none; padding:4px 0;">— ' + (CONFIG.labels?.accessoires?.[acc] || acc) + '</li>';
            });
            html += '</ul></li>';
        }
        html += '</ul>';
        $('#config-recap').html(html);
    }
    */

    /* calculateTotalPrice désactivé — prix non affichés
    function calculateTotalPrice() {
        var total = CONFIG.basePrice || 0;
        Object.keys(currentConfig).forEach(function(category) {
            if (category === 'accessoires') {
                currentConfig.accessoires.forEach(function(acc) {
                    total += (CONFIG.prices?.accessoires?.[acc]) || 0;
                });
            } else {
                var value = currentConfig[category];
                if (CONFIG.prices?.[category]?.[value] !== undefined) {
                    total += CONFIG.prices[category][value];
                }
            }
        });
        return total;
    }
    */

    function submitQuote() {
        var nom = $('#client-nom').val().trim();
        var email = $('#client-email').val().trim();
        var tel = $('#client-tel').val().trim();
        var message = $('#client-message').val().trim();

        // Validation
        if (!nom || !email || !tel) {
            alert('Veuillez remplir tous les champs obligatoires');
            return;
        }

        // Preparer les donnees
        var formData = {
            action: 'send_lift_quote',
            nonce: liftConfig.nonce,
            nom: nom,
            email: email,
            tel: tel,
            message: message,
            config: {
                modele_id: currentConfig.modele,
                modele: CONFIG.labels?.modele?.[currentConfig.modele] || currentConfig.modele,
                hull: CONFIG.labels?.hull?.[currentConfig.hull] || currentConfig.hull,
                batterie: CONFIG.labels?.batterie?.[currentConfig.batterie] || currentConfig.batterie,
                foil: CONFIG.labels?.foil?.[currentConfig.foil] || currentConfig.foil,
                stab: CONFIG.labels?.stab?.[currentConfig.stab] || currentConfig.stab,
                controller: CONFIG.labels?.controller?.[currentConfig.controller] || currentConfig.controller,
                propulsion: CONFIG.labels?.propulsion?.[currentConfig.propulsion] || currentConfig.propulsion,
                accessoires: currentConfig.accessoires.map(function(a) { return CONFIG.labels?.accessoires?.[a] || a; })
            }
        };

        // Desactiver le bouton
        var $submitBtn = $('#quoteForm button[type="submit"]');
        $submitBtn.prop('disabled', true).text('Envoi en cours...');

        // Envoyer via AJAX
        $.ajax({
            url: liftConfig.ajaxurl,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Afficher message de succes
                    $('#quoteForm').hide();
                    $('#formSuccess').fadeIn(300);
                } else {
                    alert(response.data?.message || 'Erreur lors de l\'envoi');
                    $submitBtn.prop('disabled', false).text('Envoyer la demande');
                }
            },
            error: function() {
                alert('Erreur de connexion. Veuillez reessayer.');
                $submitBtn.prop('disabled', false).text('Envoyer la demande');
            }
        });
    }

})(jQuery);
