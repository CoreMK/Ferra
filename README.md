# Ferreta
WordPress + WooCommerce premium-outdoor store. Install WordPress 6.4+/PHP 8.2, copy `wp-content`, activate **Ferreta** and **Ferreta Core**, install WooCommerce, import `data/ferreta-13.csv`, then configure pages/permalinks. The real-media importer used in local acceptance is `tools/import-ferreta.php`; run it only in a controlled WP runtime after copying `media-source`.

Run test fixture: `node tools/generate-5000.mjs`. Never import fixture into production.
