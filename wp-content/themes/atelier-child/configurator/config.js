/**
 * CONFIGURATEUR LIFT - Configuration centralisée
 *
 * FICHIER DE CONFIGURATION FACILE A MODIFIER
 * Tous les prix, labels, chemins d'images et parametres sont ici.
 * Tu peux modifier ce fichier sans toucher au code principal !
 *
 * STRUCTURE DES IMAGES 2025:
 * - hull/     : Images par couleur (4 vues par couleur)
 * - modele/   : Images par taille de modele
 * - batterie/ : Images batteries
 * - foil/     : Images foils
 * - controller/ : Images controllers
 * - propulsion/ : Images propulsion
 * - accessoires/ : Images accessoires
 */

const LIFT_CONFIG = {
    // ===============================================================
    // PARAMETRES D'AFFICHAGE
    // ===============================================================

    // Afficher les prix dans le configurateur (true = oui, false = non)
    showPrices: false,

    // ===============================================================
    // PRIX
    // ===============================================================

    // Prix de base désactivé — chaque modèle a son prix absolu
    basePrice: 0,

    // Prix des options (en euros HT - Prix 2026 EMEA)
    prices: {
        modele: {
            'lift-x-43': 12000,    // LIFTX 4'3 (prix pack)
            'lift-x-48': 12200,    // LIFTX 4'8
            'lift-x-52': 12400,    // LIFTX 5'2
            'lift-5-44': 13300,    // LIFT5 4'4 PRO (prix pack)
            'lift-5-49': 13500,    // LIFT5 4'9 SPORT
            'lift-5-54': 13700,    // LIFT5 5'4 CRUISER
            'lift-5f-49': 9166,    // LIFT5 F 4'9 SPORT (prix pack)
            'lift-5f-54': 9366     // LIFT5 F 5'4 CRUISER
        },
        hull: {
            // LIFTX colors (3)
            'off-white': 0,
            'spark-blue': 0,
            'dawn-patrol': 0,
            // LIFT5 colors (4)
            'steel-blue': 0,
            'sunkissed': 0,
            'carbon-black': 0,
            'redrock': 0,
            // LIFT5 F colors (2)
            'tide-pool-blue': 0,
            'matcha-green': 0
        },
        batterie: {
            'sport': 0,
            'explore': 800,
            'ultra': 1500,
            'full-range': 0
        },
        foil: {
            '148-havoc': 0,
            '210-camber': 0,
            '270-camber': 50
        },
        controller: {
            'bluetooth': 0,
            'elite': 0     // MODIF 2026-07-22 : Elite inclus dans le pack LIFT5
        },
        propulsion: {
            '28-alu': -1590,    // downgrade depuis le 32-carbon inclus dans le pack
            '28-carbon': -60,   // downgrade léger depuis le 32-carbon
            '32-carbon': 0,     // inclus dans le pack de base
            '32-folding': 1220  // upgrade optionnel
        },
        accessoires: {
            'chargeur': 0,          // MODIF 2026-07-22 : Fast Charger desormais INCLUS dans le pack (etait 1541)
            'chargeur-rapide': 350,
            'backpack': 0,          // inclus (LIFT5)
            'backpack-liftx': 0,    // inclus (LIFTX)
            'backpack-sup': 100,    // MODIF 2026-07-22 : en supplement sur LIFT5 F (120 EUR TTC ~ 100 EUR HT)
            'ocho-blowfish': 758,
            'housse-standard': 0
        }
    },

    // ===============================================================
    // LABELS (Textes affiches)
    // ===============================================================

    labels: {
        modele: {
            'lift-x-43': 'LIFTX 4\'3"',
            'lift-x-48': 'LIFTX 4\'8"',
            'lift-x-52': 'LIFTX 5\'2"',
            'lift-5-44': 'LIFT5 4\'4" PRO',
            'lift-5-49': 'LIFT5 4\'9" SPORT',
            'lift-5-54': 'LIFT5 5\'4" CRUISER',
            'lift-5f-49': 'LIFT5 F 4\'9" SPORT',
            'lift-5f-54': 'LIFT5 F 5\'4" CRUISER'
        },
        hull: {
            // LIFTX colors (3)
            'off-white': 'Off-White',
            'spark-blue': 'Spark Blue',
            'dawn-patrol': 'Dawn Patrol',
            // LIFT5 colors (4) - off-white partage avec LIFTX
            'steel-blue': 'Steel Blue',
            'sunkissed': 'Sun Kissed',
            'carbon-black': 'Carbon Black',
            'redrock': 'Red Rock',
            // LIFT5 F colors (2)
            'tide-pool-blue': 'Tide Pool Blue',
            'matcha-green': 'Matcha Green'
        },
        batterie: {
            'sport': 'LIFTX Battery (45min)',
            'explore': 'Explore Battery (120min)',
            'ultra': 'Ultra Battery (180min)',
            'full-range': 'Gen5 Full Range Battery'
        },
        foil: {
            '148-havoc': '148 Havoc LCS',
            '210-camber': '210 Camber Pro LCS',
            '270-camber': '270 Camber Pro LCS'
        },
        controller: {
            'bluetooth': 'Standard Bluetooth Controller',
            'elite': 'Elite Hand Controller'   // MODIF 2026-07-22
        },
        propulsion: {
            '28-alu': '28" LCS Aluminum 68 — 71 cm',
            '28-carbon': '28" LCS Carbon 68 — 71 cm',
            '32-carbon': '32" LCS Carbon 68 — 81 cm',
            '32-folding': '32" LCS Carbon 55 — 81 cm + LCS 55 Folding',
            '28-alu-68': '28" LCS Aluminum 68 — 71 cm'
        },
        accessoires: {
            'sac': 'Board Bag with Beach Wheels',
            'chargeur': 'Fast Charger',
            'chargeur-rapide': 'Rapid Charger',
            'leash': 'Safety Leash',
            'backpack': 'Battery Backpack',
            'backpack-liftx': 'Battery Backpack',  // MODIF 2026-07-22 (LIFTX)
            'backpack-sup': 'Battery Backpack',    // MODIF 2026-07-22 (LIFT5 F, en supplement)
            'ocho-blowfish': 'Ocho Blowfish Board'
        },
        // MODIF 2026-07-22 : labels des ailes arriere (stab) — pour recap devis + auto-selection
        stab: {
            '25-glide': '25 Glide',
            '32-glide': '32 Glide',
            '36-glide': '36 Glide',
            '46-glide': '46 Glide',
            '38-surf': '38 Surf V2',
            '48-surf': '48 Surf V2',
            '26-carve': '26 Carve',
            '33-carve': '33 Carve',
            '21-flow': '21 Flow',
            '26-flow': '26 Flow',
            '31-flow': '31 Flow',
            '38-surf-inclus': '38 Surf',
            '48-surf-inclus': '48 Surf'
        }
    },

    // ===============================================================
    // MODIF 2026-07-22 : AILE ARRIERE (STAB) PAR DEFAUT SELON L'AILE AVANT
    // 270 Camber Pro -> 46 Glide | 210 Camber Pro -> 36 Glide | 148 Havoc -> 26 Flow
    // ===============================================================
    stabForFoil: {
        '270-camber': '46-glide',
        '210-camber': '36-glide',
        '148-havoc': '26-flow'
    },

    // ===============================================================
    // DESCRIPTIONS DES MODELES & PACKS INCLUS
    // ===============================================================

    modelDescriptions: {
        'lift-x-43': {
            title: 'LIFTX 4\'3"',
            subtitle: 'Advanced Performance',
            description: 'Compact and designed for max agility for advanced riders, the 4\'3 is built to disappear beneath your feet. It\'s for riders chasing seamless transitions between powered and unassisted foiling, unlocking new possibilities.',
            included: [
                '32" LCS Carbon 55 Propulsion',
                '148 Havoc LCS Front Wing',
                '26 Flow Back Wing',
                'LCS 55 Folding Propeller',
                'LIFTX Battery',
                'Standard Bluetooth Controller'
            ]
        },
        'lift-x-48': {
            title: 'LIFTX 4\'8"',
            subtitle: 'Crossover',
            description: 'This is the crossover board for those who want it all. Balanced and responsive, the 4\'8 blends surf-style agility with effortless efficiency, making it just as comfortable carving on power as it is linking waves on pure glide.',
            included: [
                '32" LCS Carbon 55 Propulsion',
                '148 Havoc LCS Front Wing',
                '26 Flow Back Wing',
                'LCS 55 Folding Propeller',
                'LIFTX Battery',
                'Standard Bluetooth Controller'
            ]
        },
        'lift-x-52': {
            title: 'LIFTX 5\'2"',
            subtitle: 'Progression',
            description: 'Smooth, stable, and built for progression, the 5\'2 delivers just the right lift to move from powered cruising to downwinding and open-water exploration. Confidence, control, and freedom to push your limits.',
            included: [
                '32" LCS Carbon 55 Propulsion',
                '148 Havoc LCS Front Wing',
                '31 Flow Back Wing',
                'LCS 55 Folding Propeller',
                'LIFTX Battery',
                'Standard Bluetooth Controller'
            ]
        },
        'lift-5-44': {
            title: 'LIFT5 4\'4"',
            subtitle: 'PRO',
            description: 'A compact, responsive eFoil built for precision and control. Ideal for riders seeking tight carving, high-performance maneuverability, and a surf-like feel.',
            included: [
                '32" LCS Carbon 68 Propulsion',
                '148 Havoc LCS Front Wing',
                '36 Glide Back Wing',
                'LCS Jet',
                'Gen5 Full Range Battery',
                'Standard Bluetooth Controller'
            ]
        },
        'lift-5-49': {
            title: 'LIFT5 4\'9"',
            subtitle: 'SPORT',
            description: 'The perfect balance of stability and agility, tuned for progression. Designed for riders who want a versatile eFoil that carves smoothly while still offering a forgiving ride.',
            included: [
                '32" LCS Carbon 68 Propulsion',
                '210 Camber Pro LCS Front Wing',
                '36 Glide Back Wing',
                'LCS Jet',
                'Gen5 Full Range Battery',
                'Standard Bluetooth Controller'
            ]
        },
        'lift-5-54': {
            title: 'LIFT5 5\'4"',
            subtitle: 'CRUISER',
            description: 'The smoothest, most approachable ride in the lineup. Built for effortless lift, relaxed cruising, and easy takeoffs-perfect for those who want a stress-free ride.',
            included: [
                '32" LCS Carbon 68 Propulsion',
                '270 Camber Pro LCS Front Wing',
                '46 Glide Back Wing',
                'LCS Jet',
                'Gen5 Full Range Battery',
                'Standard Bluetooth Controller'
            ]
        },
        'lift-5f-49': {
            title: 'LIFT5 F 4\'9"',
            subtitle: 'SPORT',
            description: 'Performance accessible dans un format polyvalent. Le LIFT5 F allie la fluidité du surf foil à la technologie eFoil Lift, avec un pack complet clé-en-main.',
            included: [
                '28" LCS Aluminum 68 + Lift Jet',
                '200 Surf V2 Front Wing',
                '38 Surf Back Wing',
                'Gen5 Full Range Battery',
                'Standard Bluetooth Controller',
                'Lift Charger'
            ]
        },
        'lift-5f-54': {
            title: 'LIFT5 F 5\'4"',
            subtitle: 'CRUISER',
            description: 'Le plus grand et le plus stable du LIFT5 F. Volume maximal pour des sessions longues et confortables, idéal pour progresser sans stress.',
            included: [
                '28" LCS Aluminum 68 + Lift Jet',
                '200 Surf V2 Front Wing',
                '48 Surf Back Wing',
                'Gen5 Full Range Battery',
                'Standard Bluetooth Controller',
                'Lift Charger'
            ]
        }
    },

    // ===============================================================
    // COULEURS DISPONIBLES PAR MODELE
    // ===============================================================

    modelColors: {
        'lift-x': ['off-white', 'spark-blue', 'dawn-patrol'],
        'lift-5': ['steel-blue', 'off-white', 'sunkissed', 'carbon-black', 'redrock'],
        'lift-5-f': ['tide-pool-blue', 'matcha-green']
    },

    // ===============================================================
    // SYSTEME D'IMAGES - STRUCTURE 2025
    // ===============================================================
    //
    // hull/lift-x/LIFTX {taille}/{Couleur}/ -> 4 images par couleur
    // hull/lift-5/LIFT5 {taille} {Type}/Core Colorways/{Couleur}/ -> 4 images par couleur
    // modele/ -> images par taille

    images: {
        // Chemin de base (sera complete par WordPress)
        basePath: '/wp-content/themes/atelier-child/configurator/images/',

        // Couleur par defaut pour chaque famille de modele
        defaultColors: {
            'lift-x': 'off-white',
            'lift-5': 'steel-blue',
            'lift-5-f': 'tide-pool-blue'
        },

        // ===============================================================
        // IMAGES DES MODELES (par taille) - dossier modele/
        // ===============================================================
        modeleImages: {
            'lift-x-43': 'modele/2025_LIFTX_43.png',
            'lift-x-48': 'modele/2025_LIFTX_48.png',
            'lift-x-52': 'modele/2025_LIFTX_52.png',
            'lift-5-44': 'modele/2025_LIFT5_44.png',
            'lift-5-49': 'modele/2025_LIFT5_49.png',
            'lift-5-54': 'modele/2025_LIFT5_54.png',
            'lift-5f-49': 'modele/2026_LIFT5F_5_4_TidePoolBlue_Ortho_Shadow_3000x3000.png',
            'lift-5f-54': 'modele/2026_LIFT5F_5_4_MatchGreen_Ortho_3000x3000.png'
        },

        // ===============================================================
        // IMAGES DES COULEURS (HULL) - dossier hull/
        // Chaque couleur a 4 vues: ortho, iso, tiltback, tiltfront
        // ===============================================================

        // Types de vues disponibles (pour le slider)
        viewTypes: ['ortho', 'iso', 'tiltback', 'tiltfront'],

        // Labels des vues pour l'interface
        viewLabels: {
            'ortho': 'Vue dessus',
            'iso': 'Vue isometrique',
            'tiltback': 'Vue arriere',
            'tiltfront': 'Vue avant'
        },

        // Mapping des images hull par modele et couleur
        // Chaque entree contient les 4 vues
        // Images hull par couleur — memes images pour toutes les tailles de la meme famille
        hullColorImages: {
            // LIFTX colors (fichiers de la 4'3 utilises pour toutes les tailles)
            'off-white': {
                ortho: "hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Ortho_2000x2000.png",
                iso: "hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Package_Iso_Shadow_2000x2000.png",
                tiltback: "hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Package_TiltBack_Shadow_2000x2000.png",
                tiltfront: "hull/lift-x/LIFTX 4'3/Off-White/2025_LIFTX_4'3_OFFWHITE_Package_TiltFront_Shadow_2000x2000.png"
            },
            'spark-blue': {
                ortho: "hull/lift-x/LIFTX 4'3/Spark Blue/2025_LIFTX_4'3_SPARKBLUE_Ortho_2000x2000.png",
                iso: "hull/lift-x/LIFTX 4'3/Spark Blue/2025_LIFTX_4'3_SPARKBLUE_Package_Iso_Shadow_2000x2000.png",
                tiltback: "hull/lift-x/LIFTX 4'3/Spark Blue/2025_LIFTX_4'3_SPARKBLUE_Package_TiltBack_Shadow_2000x2000.png",
                tiltfront: "hull/lift-x/LIFTX 4'3/Spark Blue/2025_LIFTX_4'3_SPARKBLUE_Package_TiltFront_Shadow_2000x2000.png"
            },
            'dawn-patrol': {
                ortho: "hull/lift-x/LIFTX 4'3/Dawn Patrol/2025_LIFTX_4'3_DAWNPATROL_Ortho_2000x2000.png",
                iso: "hull/lift-x/LIFTX 4'3/Dawn Patrol/2025_LIFTX_4'3_DAWNPATROL_Package_Iso_Shadow_2000x2000.png",
                tiltback: "hull/lift-x/LIFTX 4'3/Dawn Patrol/2025_LIFTX_4'3_DAWNPATROL_Package_TiltBack_Shadow_2000x2000.png",
                tiltfront: "hull/lift-x/LIFTX 4'3/Dawn Patrol/2025_LIFTX_4'3_DAWNPATROL_Package_TiltFront_Shadow_2000x2000.png"
            },
            // LIFT5 colors (fichiers de la 4'4 utilises pour toutes les tailles)
            'steel-blue': {
                ortho: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Ortho_2000x2000.png",
                iso: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Package_Iso_Shadow_2000x2000.png",
                tiltback: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Package_TiltBack_Shadow_2000x2000.png",
                tiltfront: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Steel Blue/2025_LIFT5_4'4_STEELBLUE_Package_TiltFront_Shadow_2000x2000.png"
            },
            'off-white-lift5': {
                ortho: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Off-White/2025_LIFT5_4'4_OFFWHITE_Ortho_2000x2000.png",
                iso: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Off-White/2025_LIFT5_4'4_OFFWHITE_Package_Iso_Shadow_2000x2000.png",
                tiltback: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Off-White/2025_LIFT5_4'4_OFFWHITE_Package_TiltBack_Shadow_2000x2000.png",
                tiltfront: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Off-White/2025_LIFT5_4'4_OFFWHITE_Package_TiltFront_Shadow_2000x2000.png"
            },
            'sunkissed': {
                ortho: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Sun Kissed/2025_LIFT5_4'4_SUNKISSED_Ortho_2000x2000.png",
                iso: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Sun Kissed/2025_LIFT5_4'4_SUNKISSED_Package_Iso_Shadow_2000x2000.png",
                tiltback: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Sun Kissed/2025_LIFT5_4'4_SUNKISSED_Package_TiltBack_Shadow_2000x2000.png",
                tiltfront: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Sun Kissed/2025_LIFT5_4'4_SUNKISSED_Package_TiltFront_Shadow_2000x2000.png"
            },
            'carbon-black': {
                ortho: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Carbon Black/2025_LIFT5_4'4_CARBONBLACK_Ortho_2000x2000.png",
                iso: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Carbon Black/2025_LIFT5_4'4_CARBONBLACK_Package_Iso_Shadow_2000x2000.png",
                tiltback: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Carbon Black/2025_LIFT5_4'4_CARBONBLACK_Package_TiltBack_Shadow_2000x2000.png",
                tiltfront: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/Carbon Black/2025_LIFT5_4'4_CARBONBLACK_Package_TiltFront_Shadow_2000x2000.png"
            },
            'redrock': {
                ortho: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/red rock/2025_LIFT5_4'4_REDROCK_Ortho_Shadow_3000x3000.png",
                iso: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/red rock/2025_LIFT5_4'4_REDROCK_Package_Iso_Shadow_3000x3000.png",
                tiltback: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/red rock/2025_LIFT5_4'4_REDROCK_Package_TiltBack_Shadow_3000x3000.png",
                tiltfront: "hull/lift-5/LIFT5 4'4 Pro/Core Colorways/red rock/2025_LIFT5_4'4_REDROCK_Package_TiltFront_Shadow_3000x3000.png"
            },
            // LIFT5 F colors — 10 vues par couleur (meme dossier 5'4 pour les 2 tailles)
            'tide-pool-blue': {
                ortho:       "hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_Ortho_Shadow_3000x3000.png",
                iso:         "hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_Iso_Shadow_3000x3000.png",
                tiltback:    "hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_TiltBack_Shadow_3000x3000.png",
                tiltfront:   "hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_TiltFront_Shadow_3000x3000.png",
                bottom:      "hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_Bottom_Shadow_3000x3000.png",
                profile:     "hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_Profile_Shadow_3000x3000.png",
                top:         "hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_Top_Shadow_3000x3000.png",
                explodediso1:"hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_ExplodedIso1_3000x3000.png",
                explodediso2:"hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_ExplodedIso2_3000x3000.png",
                explodedvert:"hull/lift-5f/5f-2026/tide-pool-blue/images/2026_LIFT5F_5_4_TidePoolBlue_ExplodedVertical_3000x3000.png"
            },
            'matcha-green': {
                ortho:       "hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_Ortho_3000x3000.png",
                iso:         "hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_Iso_Shadow_3000x3000.png",
                tiltback:    "hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_TiltBack_Shadow_3000x3000.png",
                tiltfront:   "hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_TiltFront_3000x3000.png",
                bottom:      "hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_Bottom_3000x3000.png",
                profile:     "hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_Profile_3000x3000.png",
                top:         "hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_Top_3000x3000.png",
                explodediso1:"hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_ExplodedIso1_3000x3000.png",
                explodediso2:"hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_ExplodedIso2_3000x3000.png",
                explodedvert:"hull/lift-5f/5f-2026/matcha-green/images/2026_LIFT5F_5_4_MatchGreen_ExplodedVertical_3000x3000.png"
            }
        },

        // hullImages: proxy vers hullColorImages — toutes les tailles partagent les memes images par couleur
        hullImages: {
            'lift-x-43': null, // resolu dynamiquement via hullColorImages
            'lift-x-48': null,
            'lift-x-52': null,
            'lift-5-44': null,
            'lift-5-49': null,
            'lift-5-54': null,
            'lift-5f-49': null,
            'lift-5f-54': null
        },

        // ===============================================================
        // IMAGES ACCESSOIRES (batteries, foils, etc.)
        // ===============================================================
        accessories: {
            // MODIF 2026-07-22 : vraies photos batteries (images officielles liftfoils.com)
            //  - sport/explore/ultra = LIFTX battery (texture rainuree)   -> liftx-battery-real.png
            //  - full-range          = GEN5 Full Range (texture diamant)  -> gen5-fullrange-real.png
            // Anciennes images battery-liftx.jpg (= en fait une GEN5) et battery-gen5.png (= en fait une GEN4) abandonnees.
            batterie: {
                'sport': 'batterie/liftx-battery-real.png',
                'explore': 'batterie/liftx-battery-real.png',
                'ultra': 'batterie/liftx-battery-real.png',
                'full-range': 'batterie/gen5-fullrange-real.png'
            },
            foil: {
                '148-havoc': 'foil/wing-210-camber.png',
                '210-camber': 'foil/wing-210-camber.png',
                '270-camber': 'foil/wing-46-glide.png'
            },
            controller: {
                'bluetooth': 'controller/Controller_standard.png',
                // MODIF 2026-07-22 : Elite Hand Controller (inclus pack LIFT5)
                'elite': 'controller/elite-handcontroller.png'
            },
            propulsion: {
                // MODIF 2026-07-22 : vraie photo du mât ALUMINIUM (croppee de la vue eclatee LIFT5 F)
                '28-alu':    'mats/mast-alu-lift5f.png',
                '28-carbon': 'mats/2025_32_LCSCarbon68Propulsion_Side_2000x2000.png',
                '32-carbon': 'mats/2025_32_LCSCarbon68Propulsion_Side_2000x2000.png',
                '32-folding':'mats/2025_32_LCSCarbon55GliderLow_Side_3000x3000.png',
                '28-alu-68': 'mats/mast-alu-lift5f.png'
            },
            propulseur: {
                'lcs-jet': 'propulsion/lcs jet kit.png',
                'lcs-folding': 'propulsion/lcs_folding_propeller.png',
                'lcs-fixed': 'propulsion/lcs fixed propeller.png',
                'lift-jet': 'propulsion/lcs jet kit.png'
            },
            accessoires: {
                'chargeur': 'accessoires/charger-1200w.png',
                'chargeur-rapide': 'accessoires/charger-1200w.png',
                // MODIF 2026-07-22 : vraies photos backpack officielles liftfoils.com (distinctes par modele)
                'backpack': 'batterie/backpack-lift5-gen5.png',   // LIFT5 (batterie Gen5)
                'backpack-liftx': 'batterie/backpack-liftx.png',  // LIFTX (batterie LIFTX)
                'backpack-sup': 'batterie/backpack-lift5-gen5.png', // LIFT5 F (batterie Gen5) — en supplement
                'ocho-blowfish': 'accessoires/blowfish-board.png',
                'housse-standard': 'accessoires/housse_standard.png'
            }
        }
    },

    // ===============================================================
    // TIMINGS D'ANIMATIONS
    // ===============================================================

    animations: {
        scrollTrigger: {
            scrub: 0.3,
            fadeInDuration: 0.5,
            fadeOutDuration: 0.3
        },
        imageTransition: {
            duration: 0.4,
            ease: 'power2.inOut'
        },
        slider: {
            duration: 0.3,
            ease: 'power2.out'
        }
    },

    // ===============================================================
    // COULEURS DU THEME
    // ===============================================================

    theme: {
        primary: '#1DC6C8',
        primaryDark: '#17a8aa',
        textDark: '#1a1a1a',
        textLight: '#666',
        border: '#e0e0e0',
        background: '#f8f8f8'
    }
};

// ===============================================================
// FONCTIONS UTILITAIRES D'IMAGES
// ===============================================================

/**
 * Obtient le chemin de l'image du modele (par taille)
 * @param {string} modele - Ex: 'lift-x-43'
 * @returns {string} Chemin complet de l'image
 */
LIFT_CONFIG.getModeleImagePath = function(modele) {
    const imagePath = this.images.modeleImages[modele];
    if (!imagePath) {
        console.warn('Image modele non trouvee:', modele);
        return this.images.basePath + 'modele/2025_LIFTX_43.png';
    }
    return this.images.basePath + imagePath;
};

/**
 * Obtient toutes les images d'une couleur (4 vues pour le slider)
 * @param {string} modele - Ex: 'lift-x-43'
 * @param {string} color - Ex: 'off-white'
 * @returns {object} Objet avec les 4 chemins: {ortho, iso, tiltback, tiltfront}
 */
LIFT_CONFIG.getHullImages = function(modele, color) {
    const modelFamily = modele.startsWith('lift-5f') ? 'lift-5-f' : (modele.startsWith('lift-5') ? 'lift-5' : 'lift-x');

    // Pour LIFT5, off-white utilise une cle distincte pour eviter le conflit avec LIFTX
    let colorKey = color;
    if (modelFamily === 'lift-5' && color === 'off-white') {
        colorKey = 'off-white-lift5';
    }

    let colorImages = this.images.hullColorImages[colorKey];

    if (!colorImages) {
        const defaultColor = this.images.defaultColors[modelFamily];
        const defaultKey = (modelFamily === 'lift-5' && defaultColor === 'off-white') ? 'off-white-lift5' : defaultColor;
        colorImages = this.images.hullColorImages[defaultKey];
        console.warn('Couleur "' + color + '" non disponible pour ' + modele + ', utilisation de ' + defaultColor);
    }

    if (!colorImages) return null;

    var basePath = this.images.basePath;
    var result = {};
    Object.keys(colorImages).forEach(function(key) {
        result[key] = basePath + colorImages[key];
    });
    return result;
};

/**
 * Obtient le chemin de l'image principale du board (vue ortho par defaut)
 * Compatible avec l'ancien systeme
 * @param {string} modele - Ex: 'lift-x-43'
 * @param {string} color - Ex: 'off-white'
 * @returns {string} Chemin complet de l'image ortho
 */
LIFT_CONFIG.getBoardImagePath = function(modele, color) {
    const images = this.getHullImages(modele, color);
    if (!images) {
        return this.images.basePath + 'modele/2025_LIFTX_43.png';
    }
    return images.ortho;
};

/**
 * Obtient le chemin d'une image accessoire
 * @param {string} section - Ex: 'batterie', 'foil'
 * @param {string} option - Ex: 'sport', '210-camber'
 * @returns {string} Chemin complet de l'image
 */
LIFT_CONFIG.getAccessoryImagePath = function(section, option) {
    const sectionImages = this.images.accessories[section];
    if (!sectionImages) {
        console.warn('Section accessoire non trouvee:', section);
        return this.images.basePath + 'accessoires/board-bag.png';
    }

    const imagePath = sectionImages[option] || sectionImages[Object.keys(sectionImages)[0]];
    return this.images.basePath + imagePath;
};

// Alias pour compatibilite
LIFT_CONFIG.getCommonImagePath = LIFT_CONFIG.getAccessoryImagePath;

// ===============================================================
// EXPORT GLOBAL
// ===============================================================

window.LIFT_CONFIG = LIFT_CONFIG;
