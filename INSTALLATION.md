# Guide d'Installation Détaillé

## Prérequis

- WordPress 6.0 ou supérieur
- PHP 7.4 ou supérieur
- Un thème WordPress compatible avec les blocs
- Accès FTP ou SSH à votre serveur

## Étapes d'Installation

### 1. Télécharger le template

#### Option A : Via Git
```bash
cd /wp-content/themes/your-theme/
git clone https://github.com/chfortune/wp-portfolio-template.git
```

#### Option B : Téléchargement manuel
1. Allez sur https://github.com/chfortune/wp-portfolio-template
2. Cliquez sur "Code" > "Download ZIP"
3. Extrayez le fichier ZIP

### 2. Copier les fichiers

Copiez les fichiers suivants dans votre dossier thème (`/wp-content/themes/your-theme/`) :

```
portfolio-template.php
portfolio-one-pager.css
portfolio-functions.js
theme.json
```

### 3. Intégrer les fonctions

Ouvrez le fichier `functions.php` de votre thème et ajoutez le contenu du fichier `functions.php` du template :

```php
// Enqueue les styles et scripts
function portfolio_enqueue_assets() {
	wp_enqueue_style(
		'portfolio-styles',
		get_template_directory_uri() . '/portfolio-one-pager.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_script(
		'portfolio-scripts',
		get_template_directory_uri() . '/portfolio-functions.js',
		array(),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_assets' );
```

### 4. Vérifier l'installation

1. Connectez-vous à WordPress
2. Allez à **Pages** > **Ajouter une nouvelle**
3. Vérifiez que le template **Portfolio One-Pager** apparaît dans le sélecteur de templates

## Utilisation

### Créer une page portfolio

1. **Pages** > **Ajouter une nouvelle**
2. **Titre** : Entrez le titre de votre portfolio
3. **Template** : Sélectionnez **Portfolio One-Pager**
4. **Contenu** : Utilisez les blocs WordPress pour créer votre contenu

### Blocs recommandés

#### Hero Section (Haut de page)
```
Cover Block
├── Background Image
├── Heading (Titre principal)
└── Button (CTA)
```

#### Portfolio Projects
```
Columns
├── Column 1: Image Block
├── Column 2: Image Block
└── Column 3: Image Block
```

#### About Section
```
Group
├── Heading (Titre)
├── Paragraph (Texte)
└── Button (Appel à l'action)
```

#### Contact Section
```
Group
├── Heading (Titre)
├── Paragraph (Texte)
└── Button (Contact)
```

## Personnalisation

### Modifier les couleurs

Éditez `theme.json` et modifiez la palette de couleurs :

```json
"palette": [
	{
		"color": "#YOUR_COLOR",
		"name": "Color Name",
		"slug": "color-slug"
	}
]
```

### Modifier les polices

Éditez `theme.json` et modifiez les `fontFamilies` :

```json
"fontFamilies": [
	{
		"fontFamily": "Your Font Family",
		"name": "Font Name",
		"slug": "font-slug"
	}
]
```

### Modifier le CSS

Éditez `portfolio-one-pager.css` pour ajuster les styles.

## Dépannage

### Le template n'apparaît pas

1. Vérifiez que `portfolio-template.php` est dans le dossier du thème
2. Assurez-vous que le header du fichier est correct :
   ```php
   /**
    * Template Name: Portfolio One-Pager
    * Template Post Type: page
    */
   ```
3. Videz le cache WordPress (si applicable)

### Les styles ne s'affichent pas

1. Vérifiez que `wp_enqueue_style` est correctement appelée
2. Assurez-vous que `portfolio-one-pager.css` existe
3. Vérifiez les permissions du fichier (644)

### Les scripts ne fonctionnent pas

1. Vérifiez que `wp_enqueue_script` est correctement appelée
2. Ouvrez la console du navigateur (F12) pour chercher les erreurs
3. Vérifiez que `portfolio-functions.js` existe

## Performance

### Optimiser les images

1. Utilisez le plugin Smush ou ShortPixel
2. Compressez vos images avant de les télécharger
3. Utilisez le format WebP si possible

### Optimiser le CSS/JS

1. Utilisez un plugin de minification (Autoptimize, etc.)
2. Activez la mise en cache du navigateur
3. Utilisez un CDN pour les ressources statiques

### Vérifier les performances

1. Utilisez Google PageSpeed Insights
2. Utilisez GTmetrix
3. Consultez les rapports Lighthouse de Chrome

## Mise à jour

Pour mettre à jour le template :

```bash
cd /wp-content/themes/your-theme/wp-portfolio-template/
git pull origin main
```

## Support

En cas de problème :
1. Consultez la documentation complète dans le README.md
2. Ouvrez une issue sur GitHub
3. Vérifiez les logs WordPress (`wp-content/debug.log`)

## Ressources

- [WordPress Block Editor](https://wordpress.org/support/article/wordpress-editor/)
- [Block Development Documentation](https://developer.wordpress.org/block-editor/)
- [Theme JSON Documentation](https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json/)

---

**Besoin d'aide ?** Ouvrez une issue sur [GitHub](https://github.com/chfortune/wp-portfolio-template/issues)