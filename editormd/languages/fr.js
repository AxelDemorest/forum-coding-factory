(function () {
    var factory = function (exports) {
        var lang = {
            name: "fr",
            description: "Editeur Markdown open source en ligne.",
            tocTitle: "Table des matières",
            toolbar: {
                undo: "Annuler (Ctrl+Z)",
                redo: "Refaire (Ctrl+Y)",
                bold: "Gras",
                del: "Barré",
                italic: "Italique",
                quote: "Citation",
                ucwords: "Première lettre en majuscule",
                uppercase: "Texte sélectionné en majuscules",
                lowercase: "Texte sélectionné en minuscules",
                h1: "En-tête 1",
                h2: "En-tête 2",
                h3: "En-tête 3",
                h4: "En-tête 4",
                h5: "En-tête 5",
                h6: "En-tête 6",
                "list-ul": "Liste à puces",
                "list-ol": "Liste ordonnée",
                hr: "Séparateur horizontal",
                link: "Lien",
                "reference-link": "Lien de référence",
                image: "Image",
                code: "Code inline",
                "preformatted-text": "Texte préformatté / Bloc de code (indentation tab)",
                "code-block": "Bloc de code (Multi-langages)",
                table: "Tableau",
                datetime: "Date & heure",
                emoji: "Emoji",
                "html-entities": "Symboles",
                pagebreak: "Saut de page",
                watch: "Désactiver l'aperçu",
                unwatch: "Activer l'aperçu",
                preview: "Aperçu (Maj + ESC pour sortir)",
                fullscreen: "Plein écran (ESC pour sortir)",
                clear: "Effacer",
                search: "Rechercher",
                help: "Aide",
                info: "A propos " + exports.title
            },
            buttons: {
                enter: "Valider",
                cancel: "Annuler",
                close: "Fermer"
            },
            dialog: {
                link: {
                    title: "Lien",
                    url: "URL",
                    urlTitle: "Texte à afficher",
                    urlEmpty: "Erreur : Veuillez saisir l'URL de votre lien"
                },
                referenceLink: {
                    title: "Lien de référence",
                    name: "Nom",
                    url: "Adresse",
                    urlId: "ID",
                    urlTitle: "Titre",
                    nameEmpty: "Erreur : Le nom de la référence ne peut pas être vide",
                    idEmpty: "Erreur : Veuillez remplir l'ID de la référence",
                    urlEmpty: "Erreur : Veuillez remplir l'URL de la référence"
                },
                image: {
                    title: "Image",
                    url: "URL",
                    link: "Lien de redirection (optionnel)",
                    alt: "Texte à afficher",
                    uploadButton: "Téléverser",
                    imageURLEmpty: "Erreur : L'URL de l'image ne peut pas être vide",
                    uploadFileEmpty: "Erreur : Veuillez ajouter une image à téléverser",
                    formatNotAllowed: "Erreur : Seules les images aux formats suivants sont autorisées :"
                },
                preformattedText: {
                    title: "Texte préformatté / Codes",
                    emptyAlert: "Erreur : Veuillez insérer votre texte préformatté ou votre code",
                    placeholder: "Votre message..."
                },
                codeBlock: {
                    title: "Bloc de code",
                    selectLabel: "Langages : ",
                    selectDefaultText: "Sélectionner un langage de code...",
                    otherLanguage: "Autres langages",
                    unselectedLanguageAlert: "Erreur : Veuillez sélectionner le langage du code",
                    codeEmptyAlert: "Erreur : Veuillez saisir votre contenu (code)",
                    placeholder: "Votre code...."
                },
                htmlEntities: {
                    title: "Symboles"
                },
                help: {
                    title: "Aide"
                },
                emoji: {
                    title: 'Emoji'
                }
            }
        };

        exports.defaults.lang = lang;
    };

    // CommonJS/Node.js
    if (typeof require === "function" && typeof exports === "object" && typeof module === "object") {
        module.exports = factory;
    }
    else if (typeof define === "function")  // AMD/CMD/Sea.js
    {
        if (define.amd) { // for Require.js

            define(["editormd"], function (editormd) {
                factory(editormd);
            });

        } else { // for Sea.js
            define(function (require) {
                var editormd = require("../editormd");
                factory(editormd);
            });
        }
    }
    else {
        factory(window.editormd);
    }

})();